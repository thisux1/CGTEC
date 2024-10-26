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

     <?php             include'header.php';                          ?>

    <h1>Disciplinas</h1>

    <div class="boxDisciplinas">

    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpfisica.php"><img src="images/icons/19-removebg-preview-removebg-preview.png" id="iconFisica"></a> <br> <a href="fisica.php">Física</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpquimica.php"><img src="images/icons/20-removebg-preview.png" id="iconFisica"></a> <br> <a href="quimica.php">Química</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpbiologia.php"><img src="images/icons/21-removebg-preview.png" id="iconFisica"></a> <br> <a href="biologia.php">Biologia</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpmatematica.php"><img src="images/icons/22-removebg-preview.png" id="iconFisica"></a> <br> <a href="matematica.php">Matemática</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phphistoria.php"><img src="images/icons/23-removebg-preview.png" id="iconFisica"></a> <br> <a href="historia.php">História</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpgeografia.php"><img src="images/icons/24-removebg-preview.png" id="iconFisica"></a> <br> <a href="geografia.php">Geografia</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpfilosofia.php"><img src="images/icons/25-removebg-preview.png" id="iconFisica"></a> <br> <a href="filosofia.php">Filosofia</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpsociologia.php"><img src="images/icons/26-removebg-preview.png" id="iconFisica"></a> <br> <a href="sociologia.php">Sociologia</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpliteratura.php"><img src="images/icons/27-removebg-preview.png" id="iconFisica"></a> <br> <a href="literatura.php">Literatura</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phplinguaPortuguesa.php"><img src="images/icons/28-removebg-preview.png" id="iconFisica"></a> <br> <a href="linguaPortuguesa.php">Língua portuguesa</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpeducacaoFisica.php"><img src="images/icons/31-removebg-preview.png" id="iconFisica"></a> <br> <a href="redacao.php">Redação</a> </div>
    <div class="icons"> <a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/historia.phpartes.php"><img src="images/icons/32-removebg-preview.png" id="iconFisica"></a> <br> <a href="ingles.php">Inglês</a> </div>
    
    
    

    </div>

</body>
</html>