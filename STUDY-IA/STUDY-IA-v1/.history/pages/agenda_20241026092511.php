<?php

session_start();

if (isset($_SESSION['nomeUsuario']) && isset($_SESSION['senhaUsuario']) && isset($_SESSION['IDusuario']))
{
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $senhaUsuario = $_SESSION['senhaUsuario'];
    $IDusuario = $_SESSION['IDusuario'];

    if (isset($_POST["submit"])) 
    {
        include_once('connectDB.php');

        // Recebe os dados do formulário
        $dataLembrete = mysqli_real_escape_string($connectDB, $_POST['dataLembrete']);
        $descricaoLembrete = mysqli_real_escape_string($connectDB, $_POST['textarea']);

        // Insere os dados no banco de dados
        $inserirLembretes = mysqli_query($connectDB, "INSERT INTO agenda(IDusuario, dataLembrete, descricaoLembrete)
        VALUES ('$IDusuario', '$dataLembrete', '$descricaoLembrete')");

    if ($inserirLembretes)
    {
    header("Location: agenda.php");
    exit();
    }

    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agenda.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>STUDY IA | Agenda</title>
</head>
<body>
<?php
            include'header.php';
            ?>

    <div class="boxMeio">

        <h1><?php echo "Agenda de $nomeUsuario"; ?></h1>

        <div class="formulario">

        <form action="agenda.php" method="post">

        <label for="data">Escolher data</label>
        <br>
        <input type="date" name="dataLembrete" id="data" required>
        <br><br>
        <label for="textarea">Descrição</label>
        <br>
        <textarea name="textarea" id="textarea" maxlength="45" required>Estudar para...</textarea>
        <br><br>
        <center><input type="submit" name="submit" id="submit" value="Enviar"></center>

        </form>

        </div>

        </div>

        <iframe src="agendaFrame2.php" frameborder="1"></iframe>
</body>
</html>