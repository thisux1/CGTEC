<?php

if(isset($_POST["submit"]))
{
    include_once('connectDB.php');

    $nomeUsuario = $_POST['nomeUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];
    $numeroCaracteres = 10;

    if(strlen($nomeUsuario) > $numeroCaracteres)
    {
        $cadastroConcluido = 'Seu nome não pode ter mais de 10 caracteres!';
        echo "$cadastroConcluido";
    }

    else if(strlen($senhaUsuario) > $numeroCaracteres)
    {
        $cadastroConcluido = 'Sua senha não pode ter mais de 10 caracteres!';
        echo "$cadastroConcluido";
    }
    else
    {
        $checarCadastro = "SELECT * FROM usuarios WHERE nomeUsuario = '$nomeUsuario' and senhaUsuario = '$senhaUsuario'";

    $resultado = $connectDB->query($checarCadastro);

    if(mysqli_num_rows($resultado) <= 0)
    {
        $result = mysqli_query($connectDB, "INSERT INTO usuarios(nomeUsuario, senhaUsuario)
    VALUES ('$nomeUsuario', '$senhaUsuario')");

    $cadastroConcluido = 'Cadastro concluído';
       echo "$cadastroConcluido";
    }
    else
    {
        $cadastroConcluido = 'Cadastro já existe';
       echo "$cadastroConcluido";
    }
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>STUDY IA | Cadastro</title>
</head>
<body>

<!--Parte superior-->
    <div class="superior"> 

        <img src="images/logo2.png" class="imagem">
        <span class="link"><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/home.html">Início</a></span>
        <span class="link"><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/login.php">Entrar</a></span>
        <span class="link"><a href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/cadastro.php" id="link-selecionado">Cadastrar</a></span>

    </div>

<!--Título e subtítulo-->
    <div class="titulo-e-subTitulo"> 

        <img src="images/logo4.png" class="imagem2">
        <span class="titulo"><b>STUDY IA</b></span>
        <br>
        <span class="subTitulo">Seu site de estudos com inteligência  artificial</span>

    </div>

<!--Topo do formulário-->
    

<!--Formulário de cadastro-->
    <div class="boxCadastro">

    <form action="cadastro.php" method="post">

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