<?php
session_start();
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
    // Diretório onde as imagens de perfil serão salvas
    $diretorioDestino = 'uploads/perfil/';
    
    // Cria o diretório se ele não existir
    if (!is_dir($diretorioDestino)) {
        mkdir($diretorioDestino, 0755, true);
    }

    // Define o nome do arquivo como o ID do usuário + extensão
    $extensao = pathinfo($_FILES['imagemPerfil']['name'], PATHINFO_EXTENSION);
    $imagemNome = $IDusuario . '.' . $extensao;
    $caminhoImagem = $diretorioDestino . $imagemNome;

    // Verifica se uma imagem anterior existe e a remove
    if (isset($imagemPerfil) && file_exists($imagemPerfil)) {
        unlink($imagemPerfil); // Remove a imagem antiga
    }

    // Faz o upload da nova imagem para o servidor
    if (move_uploaded_file($_FILES['imagemPerfil']['tmp_name'], $caminhoImagem)) {
        // Atualiza o banco de dados com o caminho da nova imagem
        $sql = "UPDATE usuarios SET imagemPerfil = ? WHERE IDusuario = ?";
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("si", $caminhoImagem, $IDusuario);
        if ($stmt->execute()) {
            // Atualiza a variável $imagemPerfil para usar a nova imagem
            $imagemPerfil = $caminhoImagem; 
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="perfil.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>STUDY IA | Perfil</title>
    <style>
        /* Estilos da imagem de perfil */
        .imagem2 {
            width: 250px; /* Ajuste para o tamanho desejado */
            height: 250px; /* Ajuste para o tamanho desejado */
            object-fit: cover; /* Mantém a proporção e cobre a área */
            border-radius: 50%; /* Para imagens circulares */
            display: inline-block; 
            vertical-align: middle;
            border: 5px solid #23108c;
        }

        /* Estilo para ocultar o texto padrão do input de arquivo */
        input[type="file"] {
            display: none; /* Esconde o input de arquivo padrão */
        }

        /* Estilo do botão customizado */
        .botao-upload {
            padding: 10px 20px;
            background-image: linear-gradient(to right, #2328bd, #2c1e42);
            color: white; /* Cor do texto */
            border: none; /* Sem borda */
            border-radius: 5px; /* Borda arredondada */
            cursor: pointer; /* Muda o cursor para indicar que é clicável */
            font-family: "FonteNormal", sans-serif  ;
        }
    </style>
</head>
<body>
    <div class="boxSuperior"> <!-- Parte superior -->
        <a href="perfil.php"><img src="images/fotoPerfil.png" class="imagem1"></a>
        <span><a id="links1" href="materias.php">Disciplinas</a></span>
        <span><a id="links1" href="http://localhost/CGTEC/chatbot-openai/chatbot.html">Peça ajuda a IA</a></span>
        <span><a id="links1" href="http://localhost/CGTEC/STUDY-IA/STUDY-IA-v1/pages/sobreSTUDYIA.php">Sobre o STUDY IA</a></span>
        <span><a id="links1" href="login.php">Sair</a></span>
    </div>

    <center>
    <div class="boxMeio"> <!-- Parte do meio -->
        <br><br><br>
        <?php
        // Verifica se o usuário já enviou uma imagem de perfil
        if (isset($imagemPerfil) && !empty($imagemPerfil) && file_exists($imagemPerfil)) {
            // Adiciona um parâmetro de tempo para evitar cache
            $imagemComCacheBuster = $imagemPerfil . "?t=" . time();
            echo '<center><img src="' . $imagemComCacheBuster . '" class="imagem2"></center>';
        } else {
            // Se a imagem não existir ou não for válida, exibe a imagem padrão
            echo '<center><img src="images/perfil2.png" class="imagem2"></center>';
        }
        ?>

        <span class="nomeUsuario"><b><?php echo "$nomeUsuario" ?></b></span>

        <span><a id="links3" href="agenda.php"><b>Agenda</b></a></span>
        <span><a id="links3" href=""><b>Progressos</b></a></span>
        <br>
        <!-- Formulário para o upload da imagem de perfil -->
        <form action="perfil.php" method="POST" enctype="multipart/form-data">
            <label for="file-upload" class="botao-upload">Selecionar Foto de Perfil</label>
            <input id="file-upload" type="file" name="imagemPerfil" accept="image/*" />
            <br><br>
            <button type="submit" class="botao-upload">Salvar Foto de Perfil</button>
        </form>

    </div>
    </center>
</body>
</html>
