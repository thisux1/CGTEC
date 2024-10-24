<?php
// deleteReminder.php
include_once('connectDB.php');

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $idLembrete = $_GET['id'];

    // Excluir o lembrete com o ID fornecido
    $sql = "DELETE FROM agenda WHERE IDlembrete = '$idLembrete'";

    if (mysqli_query($connectDB, $sql)) {
        // Após excluir, redireciona para a página de lembretes
        header("Location: agendaFrame2.php");
    } else {
        echo "Erro ao excluir lembrete: " . mysqli_error($connectDB);
    }
} else {
    echo "ID do lembrete não encontrado.";
}
?>
