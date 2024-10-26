<?php

session_start();

if(isset($_POST["submit"])) 
{

    include_once('connectDB.php');

$_SESSION['nomeUsuario'] = $_POST['nomeUsuario'];
$_SESSION['senhaUsuario'] = $_POST['senhaUsuario'];

$procurarUsuario = "SELECT IDusuario, nomeUsuario, senhaUsuario FROM usuarios WHERE nomeUsuario = ? AND senhaUsuario = ?";

$stmt = $connectDB->prepare($procurarUsuario);

$stmt->bind_param("ss", $_SESSION['nomeUsuario'], $_SESSION['senhaUsuario']);

$stmt->execute();

$resultadoUsuario = $stmt->get_result();

    if($resultadoUsuario->num_rows > 0) 
        {

            $usuario = $resultadoUsuario->fetch_assoc();

            $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];
            $_SESSION['senhaUsuario'] = $usuario['senhaUsuario'];
            $_SESSION['IDusuario'] = $usuario['IDusuario'];

            header('Location: perfil.php');

            
        } 
        else 
        {
            echo "Este usuário não existe";
        }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>STUDY IA | Login</title>
</head>
<body>

<!--Parte superior-->
            <?php
            include'header.php';
            ?>

<!--Título e subtítulo-->
    <div class="titulo-e-subTitulo"> 

        <img src="images/logo4.png" class="imagem2">
        <span class="titulo"><b>STUDY IA</b></span>
        <br>
        <span class="subTitulo">Seu site de estudos com inteligência  artificial</span>

    </div>

<!--Topo do formulário-->
    

<!--Formulário de cadastro-->
    <div class="boxLogin">

    <form action="login.php" method="post">

        <label for="nomeUsuario" id="label">Nome de usuário</label>
        <br>
        <input type="text" name="nomeUsuario" id="campos">
        <br><br>
        <label for="senhaUsuario" id="label">Senha</label>
        <br>
        <input type="password" name="senhaUsuario" id="campos">
        <br><br>
        <center><input type="submit" name="submit" id="submit" value="Enviar"></center>

    </form>

    </div>

</body>
</html>