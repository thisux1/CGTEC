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

    // Debug do valor inicial da imagem
    if (isset($imagemPerfil)) {
        error_log("Valor de imagemPerfil do banco: " . $imagemPerfil);
        error_log("Arquivo existe? " . (file_exists(__DIR__ . '/' . $imagemPerfil) ? "Sim" : "Não"));
        error_log("Caminho completo: " . __DIR__ . '/' . $imagemPerfil);
    }
} else {
    echo "Nenhum dado encontrado na sessão.";
    exit();
}

// Processa o upload da imagem de perfil se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagemPerfil'])) {
    // Diretório onde as imagens de perfil serão salvas
    $diretorioDestino = __DIR__ . '/uploads/perfil/';
    
    // Log para debug
    error_log("Tentando fazer upload de imagem");
    error_log("Diretório destino: " . $diretorioDestino);
    
    // Verifica se houve erro no upload
    if ($_FILES['imagemPerfil']['error'] !== UPLOAD_ERR_OK) {
        error_log("Erro no upload: " . $_FILES['imagemPerfil']['error']);
        die("Erro no upload do arquivo");
    }
    
    // Cria o diretório se ele não existir
    if (!is_dir($diretorioDestino)) {
        if (!mkdir($diretorioDestino, 0755, true)) {
            error_log("Falha ao criar diretório: " . $diretorioDestino);
            die("Falha ao criar diretório de upload");
        }
        error_log("Diretório criado com sucesso");
    }

    // Define o nome do arquivo como o ID do usuário + extensão
    $extensao = strtolower(pathinfo($_FILES['imagemPerfil']['name'], PATHINFO_EXTENSION));
    $imagemNome = $IDusuario . '.' . $extensao;
    $caminhoImagem = $diretorioDestino . $imagemNome;
    $caminhoRelativo = 'uploads/perfil/' . $imagemNome; // Caminho para salvar no banco

    error_log("Tentando mover arquivo para: " . $caminhoImagem);
    
    // Verifica se uma imagem anterior existe e a remove
    if (isset($imagemPerfil) && file_exists($imagemPerfil)) {
        unlink($imagemPerfil);
        error_log("Imagem anterior removida: " . $imagemPerfil);
    }

    // Faz o upload da nova imagem para o servidor
    if (move_uploaded_file($_FILES['imagemPerfil']['tmp_name'], $caminhoImagem)) {
        error_log("Arquivo movido com sucesso");
        
        // Atualiza o banco de dados com o caminho RELATIVO da nova imagem
        $sql = "UPDATE usuarios SET imagemPerfil = ? WHERE IDusuario = ?";
        $stmt = $connectDB->prepare($sql);
        $stmt->bind_param("si", $caminhoRelativo, $IDusuario);
        if ($stmt->execute()) {
            error_log("Banco de dados atualizado com sucesso");
            $imagemPerfil = $caminhoRelativo; 
        } else {
            error_log("Erro ao atualizar banco de dados: " . $stmt->error);
        }
        $stmt->close();
    } else {
        error_log("Falha ao mover arquivo: " . error_get_last()['message']);
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
            font-family: "FonteNormal", sans-serif;
        }
    </style>
</head>
<body>
    
            <?php
            include'header.php';
            ?>

    <center>
    <div class="boxMeio"> <!-- Parte do meio -->
        <br><br><br>
        <?php
        if (isset($imagemPerfil) && !empty($imagemPerfil) && file_exists(__DIR__ . '/' . $imagemPerfil)) {
            $imagemComCacheBuster = $imagemPerfil . "?t=" . time();
            error_log("Tentando exibir imagem: " . $imagemComCacheBuster);
            echo '<center><img src="' . htmlspecialchars($imagemComCacheBuster) . '" class="imagem2" onerror="this.src=\'images/perfil2.png\'"></center>';
        } else {
            echo '<center><img src="images/perfil2.png" class="imagem2"></center>';
        }
        ?>

        <span class="nomeUsuario"><b><?php echo htmlspecialchars($nomeUsuario); ?></b></span>

        <span><a id="links3" href="agenda.php"><b>Agenda</b></a></span>
        <span><a id="links3" href="progressos.php"><b>Progressos</b></a></span>
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