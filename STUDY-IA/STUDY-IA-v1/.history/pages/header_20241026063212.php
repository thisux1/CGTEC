<?php
include_once("");
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
    <?php
$cssFile = __DIR__ . '/style_header.css';
if (file_exists($cssFile)) {
    error_log("CSS file exists at: " . $cssFile);
} else {
    error_log("CSS file not found at: " . $cssFile);
}
error_log("Verificando: " . realpath(__DIR__ . '/' . $imagemPerfil));

?>
<body>
    <header>
        <div class="header-content">
            <div class="content">
                <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/perfil.php">
                <?php
if (isset($imagemPerfil) && !empty($imagemPerfil)) {
    // Verifica o caminho original
    if (file_exists(__DIR__ . '/' . $imagemPerfil)) {
        echo '<img class="imagem1" src="' . htmlspecialchars($imagemPerfil . '?t=' . time()) . '" alt="perfil">';
    } 
    // Se não encontrar, tenta buscar na pasta acima
    else if (file_exists(__DIR__ . '/../images/' . $imagemPerfil)) { // Usando ../ para subir uma pasta
        echo '<img class="imagem1" src="' . htmlspecialchars('../images/' . $imagemPerfil . '?t=' . time()) . '" alt="perfil">';
    } 
    // Se ainda assim não encontrar, tenta buscar na pasta duas acima
    else if (file_exists(__DIR__ . '/../../images/' . $imagemPerfil)) { // Usando ../../ para subir duas pastas
        echo '<img class="imagem1" src="' . htmlspecialchars('../../images/' . $imagemPerfil . '?t=' . time()) . '" alt="perfil">';
    } 
    // Se ainda assim não encontrar, usa a imagem padrão
    else {
        echo '<img class="imagem1" src="../../images/fotoPerfil.png" alt="perfil">'; // Usando caminho correto para imagem padrão
    }
} else {
    // Caso a variável $imagemPerfil esteja vazia
    echo '<img class="imagem1" src="../../images/fotoPerfil.png" alt="perfil">'; // Usando caminho correto para imagem padrão
}
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