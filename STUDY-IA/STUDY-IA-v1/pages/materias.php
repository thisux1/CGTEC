<?php

session_start();

if (isset($_SESSION['IDusuario']))
{
    $IDusuario = $_SESSION['IDusuario'];    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="materias.css">
    <title>STUDY IA | Disciplinas</title>
</head>
<body>

    <div class="boxSuperior"> <!--Parte superior-->

        <a href="perfil.php"><img src="images/perfil2.png" class="imagem1"></a>
        <span><a class="links1" href="materias.php" id="link-selecionado">Disciplinas</a></span>
        <span><a class="links1" href="http://localhost/CGTEC/chatbot-openai/chatbot.html">Peça ajuda a IA</a></span>
        <span><a class="links1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/sobreSTUDYIA.php">Sobre o STUDY IA</a></span>
        <span><a class="links1" href="login.php">Sair</a></span>

    </div>

    <h1>Disciplinas</h1>

    <div class="boxDisciplinas">

    <div class="icons"> <a href="fisica.php"><img src="images/icons/19-removebg-preview-removebg-preview.png" id="iconFisica"></a> <br> <a href="fisica.php">Física</a> </div>
    <div class="icons"> <a href="quimica.php"><img src="images/icons/20-removebg-preview.png" id="iconFisica"></a> <br> <a href="quimica.php">Química</a> </div>
    <div class="icons"> <a href="biologia.php"><img src="images/icons/21-removebg-preview.png" id="iconFisica"></a> <br> <a href="biologia.php">Biologia</a> </div>
    <div class="icons"> <a href="matematica.php"><img src="images/icons/22-removebg-preview.png" id="iconFisica"></a> <br> <a href="matematica.php">Matemática</a> </div>
    <div class="icons"> <a href="historia.php"><img src="images/icons/23-removebg-preview.png" id="iconFisica"></a> <br> <a href="historia.php">História</a> </div>
    <div class="icons"> <a href="geografia.php"><img src="images/icons/24-removebg-preview.png" id="iconFisica"></a> <br> <a href="geografia.php">Geografia</a> </div>
    <div class="icons"> <a href="filosofia.php"><img src="images/icons/25-removebg-preview.png" id="iconFisica"></a> <br> <a href="filosofia.php">Filosofia</a> </div>
    <div class="icons"> <a href="sociologia.php"><img src="images/icons/26-removebg-preview.png" id="iconFisica"></a> <br> <a href="sociologia.php">Sociologia</a> </div>
    <div class="icons"> <a href="literatura.php"><img src="images/icons/27-removebg-preview.png" id="iconFisica"></a> <br> <a href="literatura.php">Literatura</a> </div>
    <div class="icons"> <a href="linguaPortuguesa.php"><img src="images/icons/28-removebg-preview.png" id="iconFisica"></a> <br> <a href="linguaPortuguesa.php">Língua portuguesa</a> </div>
    <div class="icons"> <a href="educacaoFisica.php"><img src="images/icons/31-removebg-preview.png" id="iconFisica"></a> <br> <a href="redacao.php">Redação</a> </div>
    <div class="icons"> <a href="artes.php"><img src="images/icons/32-removebg-preview.png" id="iconFisica"></a> <br> <a href="ingles.php">Inglês</a> </div>
    
    
    

    </div>

</body>
</html>