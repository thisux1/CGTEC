<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../login.php");
    exit;
}

require_once __DIR__ . '/PathResolver.php';

$imagemPerfil = isset($_SESSION['imagemPerfil']) ? $_SESSION['imagemPerfil'] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Seus estilos do header aqui */
    </style>
</head>
<body>
    <header>
        <div class="profile">
            <?php echo StudyIAPathResolver::resolveImagePath($imagemPerfil); ?>
            <div class="infoUser">
                <h4><?php echo $_SESSION["nome"]; ?></h4>
                <h5><?php echo $_SESSION["user_type"]; ?></h5>
            </div>
        </div>
        <!-- Resto do seu header aqui -->
    </header>
</body>
</html>