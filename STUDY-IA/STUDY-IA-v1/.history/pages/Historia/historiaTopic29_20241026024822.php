<?php
$message = ""; // Variável para armazenar a mensagem

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn1'])) {
        $message = 'conteudoHistoria/topico29.html'; // Define o caminho do arquivo HTML
    } elseif (isset($_POST['btn2'])) {
        $message = ""; // URL do vídeo do YouTube
    } elseif (isset($_POST['btn3'])) {
        $message = 'conteudosHistoria/exercicios29.html'; // Exemplo de mensagem simples
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="paginasMaterias.css">
    <title>STUDY IA | História</title>
</head>
<body>

    <div class="boxSuperior"> <!--Parte superior-->
        <a href="perfil.php"><img src="images/perfil2.png" class="imagem1"></a>
        <span><a class="links1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/materias.php">Disciplinas</a></span>
        <span><a class="links1" href="http://localhost/CGTEC/chatbot-openai/chatbot.html">Peça ajuda a IA</a></span>
        <span><a class="links1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/sobreSTUDYIA.php">Sobre o STUDY IA</a></span>
        <span><a class="links1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/login.php">Sair</a></span>
    </div>

    <div class="boxTitulo">
        <h1>História</h1>
        <img src="images/icons/23-removebg-preview.png" id="imagemTitulo">
    </div>

    <div class="boxMeio">

        <div class="escolherConteudo">

        <span class="titulo">10. Movimentos Sociais e Direitos Humanos</span>
        <br>
        <span class="topico">Movimentos abolicionistas, feministas, operários e ambientais no Brasil e no mundo.</span>

        <br><br>

        <form method="post">
        <button name="btn1">Conteúdo escrito</button>
        <br><br>
        <button name="btn2">Videoaula</button>
        <br><br>
        <button name="btn3">Exercícios</button>
        </form>

        </div>

    </div>

    <iframe width="100%" height="420px" src="<?php echo htmlspecialchars($message); ?>" frameborder="0" allowfullscreen></iframe>

</body>
</html>
