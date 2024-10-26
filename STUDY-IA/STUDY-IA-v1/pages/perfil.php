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
        unlink($imagemPerfil);
    }

    // Verifica se o arquivo enviado é uma imagem
    if (getimagesize($_FILES['imagemPerfil']['tmp_name'])) {
        if (move_uploaded_file($_FILES['imagemPerfil']['tmp_name'], $caminhoImagem)) {
            $sql = "UPDATE usuarios SET imagemPerfil = ? WHERE IDusuario = ?";
            $stmt = $connectDB->prepare($sql);
            $stmt->bind_param("si", $caminhoImagem, $IDusuario);
            if ($stmt->execute()) {
                $imagemPerfil = $caminhoImagem; 
                $mensagem = "Imagem carregada com sucesso!";
            }
            $stmt->close();
        }
    } else {
        $mensagem = "Arquivo não é uma imagem.";
    }
}

// Define a imagem com cache buster
$imagemComCacheBuster = isset($imagemPerfil) && file_exists($imagemPerfil) ? $imagemPerfil . "?t=" . time() : 'images/perfil2.png';
// Armazena o caminho da imagem na sessão
$_SESSION['imagemPerfil'] = $imagemComCacheBuster; // ou $caminhoImagem se preferir

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
    <?php include 'header.php'; ?>
    <center>
    <div class="boxMeio">
        <br><br><br>
        <center><img src="<?php echo $imagemComCacheBuster; ?>" class="imagem2"></center>

        <span class="nomeUsuario"><b><?php echo "$nomeUsuario" ?></b></span>

        <span><a id="links3" href="agenda.php"><b>Agenda</b></a></span>
        <span><a id="links3" href="progressos.php"><b>Progressos</b></a></span>
        <br>
        
        <?php if (isset($mensagem)): ?>
            <p><?php echo $mensagem; ?></p>
        <?php endif; ?>
        
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
