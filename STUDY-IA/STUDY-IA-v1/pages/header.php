    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    
    include 'connectDB.php'; // Arquivo que contém a conexão com o banco de dados.

    // Verifica se o usuário está logado
    if (isset($_SESSION['nomeUsuario']) && isset($_SESSION['IDusuario'])) {
        $nomeUsuario = $_SESSION['nomeUsuario'];
        $IDusuario = $_SESSION['IDusuario'];

        // Busca o caminho da imagem do perfil do usuário no banco de dados
        $sql = "SELECT imagemPerfil FROM usuarios WHERE IDusuario = ?"; 
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("i", $IDusuario);
        $stmt->execute();
        $stmt->bind_result($imagemPerfil);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Nenhum dado encontrado na sessão.";
        exit();
    }

    // Processa o upload da imagem de perfil se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagemPerfil'])) {
        $diretorioDestino = 'uploads/perfil/';
        
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
        }

        $extensao = pathinfo($_FILES['imagemPerfil']['name'], PATHINFO_EXTENSION);
        $imagemNome = $IDusuario . '.' . $extensao;
        $caminhoImagem = $diretorioDestino . $imagemNome;

        if (isset($imagemPerfil) && file_exists($imagemPerfil)) {
            unlink($imagemPerfil);
        }

        if (move_uploaded_file($_FILES['imagemPerfil']['tmp_name'], $caminhoImagem)) {
            $sql = "UPDATE usuarios SET imagemPerfil = ? WHERE IDusuario = ?";
            $stmt = $connectDB->prepare($sql);
            $stmt->bind_param("si", $caminhoImagem, $IDusuario);
            if ($stmt->execute()) {
                $imagemPerfil = $caminhoImagem;
            }
            $stmt->close();
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style_header.css">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <title>Study IA</title>
    </head>

    <body>
        <header>
            <div class="header-content">
                <div class="content">
                    <a href="perfil.php"><img class="imagem1"
                            src="<?php echo isset($imagemPerfil) && !empty($imagemPerfil) ? $imagemPerfil . '?t=' . time() : 'images/fotoPerfil.png'; ?>"
                            alt="perfil"></a>
                </div>
                <div class="logo-img">
                    <a href="http://localhost//CGTEC/STUDY-IA/STUDY-IA-v1/pages/header.php"><img class="logo"
                            src="images/logo2.png" alt="Study IA"></a>
                    <a class="h1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/home.html">Study IA</a>
                </div>

                <div class="botton-area">
                    <input type="checkbox" role="button" aria-label="Display the menu" class="menu">
                </div>
            </div>
        </header>
        <div id="overlay" class="overlay"></div>
        <div id="sidebar" class="sidebar">
            <h2>Conteúdos</h2>
            <div class="divider"></div>
            <ul class="number">
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/fisica.php">Física</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/quimica.php">Química</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/biologia.php">Biologia</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/matematica.php">Matemática</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.php">História</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/geografia.php">Geografia</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/filosofia.php">Filosofia</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/sociologia.php">Sociologia</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/literatura.php">Literatura</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/linguaPortuguesa.php">Língua Portuguesa</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/redacao.php">Redação</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/ingles.php">Inglês</a></li>
            </ul>
            <br>
            <h2>Outros</h2>
            <div class="divider"></div>
            <ul>
                <li><a href="http://localhost/CGTEC/chatbot-openai/chatbot.html">Peça ajuda a IA</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/sobreSTUDYIA.php">Sobre o Study IA</a></li>
                <li><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/login.php">Sair</a></li>
            </ul>

        </div>

        <script>
        const toggle = document.querySelector('.menu');
        const overlay = document.getElementById('overlay');
        const sidebar = document.getElementById('sidebar');

        toggle.addEventListener('change', () => {
            if (toggle.checked) {
                overlay.classList.add('active');
                sidebar.style.transform = 'translateX(0)';
            } else {
                overlay.classList.remove('active');
                sidebar.style.transform = 'translateX(100%)';
            }
        });

        // Para fechar o sidebar ao clicar no overlay
        overlay.addEventListener('click', () => {
            toggle.checked = false;
            overlay.classList.remove('active'); // Remove a classe active
            sidebar.style.transform = 'translateX(100%)';
        });
        </script>
    </body>

    </html>