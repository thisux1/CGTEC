<?php
include_once("config.php");
require_once __DIR__ . '/PathResolver.php';

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

    // Debug do valor da imagem
    if (isset($imagemPerfil)) {
        error_log("Header - Valor de imagemPerfil do banco: " . $imagemPerfil);
        error_log("Header - Arquivo existe? " . (file_exists(__DIR__ . '/' . $imagemPerfil) ? "Sim" : "Não"));
        error_log("Header - Caminho completo: " . __DIR__ . '/' . $imagemPerfil);
    }
} else {
    echo "Nenhum dado encontrado na sessão.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_header.css">
    <link rel="stylesheet" href="../../style_header.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>Study IA</title>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="content">
                <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/perfil.php">
                    <?php
                    function getImagePath($imageName, $defaultImage = 'fotoPerfil.png') {
                        // Array com possíveis locais da imagem (do mais específico para o mais geral)
                        $possiblePaths = [
                            __DIR__ . '/perfil/' . $imageName,
                            __DIR__ . '/../images/' . $imageName,
                        ];
                        
                        // Procura a imagem nos caminhos possíveis
                        foreach ($possiblePaths as $path) {
                            if (file_exists($path)) {
                                // Converte o caminho do sistema em URL relativa
                                return htmlspecialchars(str_replace($_SERVER['DOCUMENT_ROOT'], '', $path) . '?t=' . time());
                            }
                        }
                        
                        // Retorna a imagem padrão se nenhuma for encontrada
                        return htmlspecialchars('../images/' . $defaultImage);
                    }

                    // Exemplo de uso no seu cabeçalho
                    function renderProfileImage($imagemPerfil = null) {
                        $imagePath = !empty($imagemPerfil) ? getImagePath($imagemPerfil) : getImagePath('fotoPerfil.png');
                        echo '<img class="imagem1" src="' . $imagePath . '" alt="perfil">';
                    }

                    renderProfileImage($imagemPerfil);
                    ?>
                </a>
            </div>
            <div class="logo-img">
                <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/home.php"><img class="logo" src="images/logo2.png" alt="Study IA"></a>
                <a class="h1" href="home.php">Study IA</a>
            </div>

            <div class="botton-area">
                <input type="checkbox" role="button" aria-label="Display the menu" class="menu">
            </div>
        </div>
    </header>
    <div id="overlay" class="overlay"></div>
    <div id="sidebar" class="sidebar">
        <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/materias.php"><h2>Conteúdos</h2></a>
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
            <li><a href="sobreSTUDYIA.php">Sobre o Study IA</a></li>
            <li><a href="agenda.php">Agenda</a></li>
            <li><a href="login.php">Progresso</a></li>
            <li><a href="progressos.php">Sair</a></li>
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
        overlay.classList.remove('active');
        sidebar.style.transform = 'translateX(100%)';
    });
    </script>
</body>
</html>
