<?php
$message = ""; // Variável para armazenar a mensagem

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['btn1'])) {
        $message = 'conteudosFisica/topico5.html'; // Define o caminho do arquivo HTML
    } elseif (isset($_POST['btn2'])) {
        $message = "https://www.youtube.com/embed/1IeDW71IqcY?si=UuQumzEyXIkTOaGP"; // URL do vídeo do YouTube
    } elseif (isset($_POST['btn3'])) {
        $message = 'conteudosFisica/exercicios5.html'; // Exemplo de mensagem simples
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
    <title>STUDY IA | Física</title>
</head>
<body>

    <?php
            include'header.php';
            ?>

    <div class="boxTitulo">
        <h1>Física</h1>
        <img src="images/icons/19-removebg-preview-removebg-preview.png" id="imagemTitulo">
    </div>

    <div class="boxMeio">

        <div class="escolherConteudo">

        <span class="titulo">2. Dinâmica</span>
        <br>
        <span class="topico">Força de Atrito</span>

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
