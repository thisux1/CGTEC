<?php
// agendaFrame2.php

session_start();
include_once('connectDB.php');

// Exibe os lembretes do usuário
$IDusuario = $_SESSION['IDusuario']; // A variável pode ser dinâmica, dependendo de como o usuário se identifica (exemplo: $_SESSION['IDusuario'])
$query = "SELECT * FROM agenda WHERE IDusuario = '$IDusuario'"; 

$result = mysqli_query($connectDB, $query);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agendaFrame2.css">
    <title>Agenda de Lembretes</title>
</head>
<body>
    <div class="quadrados">
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Loop pelos lembretes
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='lembrete'>
                        <span>Data: " . $row['dataLembrete'] . "</span><br>
                        <span>Descrição: " . $row['descricaoLembrete'] . "</span><br>
                        <a href='deletarLembretes.php?id=" . $row['IDlembrete'] . "' class='excluir'>Excluir</a>
                      </div>";
            }
        } else {
            echo "<p>Nenhum lembrete encontrado.</p>";
        }
        ?>
    </div>
</body>
</html>
