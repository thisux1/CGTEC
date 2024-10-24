<?php
session_start();
include('connectDB.php');

if (!isset($_SESSION['IDusuario'])) {
    echo json_encode(['selections' => []]);
    exit;
}

$IDusuario = $_SESSION['IDusuario'];

// Verificar se a conexão com o banco de dados foi bem-sucedida
if ($connectDB->connect_error) {
    die("Erro na conexão com o banco de dados: " . $connectDB->connect_error);
}

$query = "SELECT checkbox FROM usuario_biologia_selecoes WHERE IDusuario = ?";
$stmt = $connectDB->prepare($query);
$stmt->bind_param('i', $IDusuario);
$stmt->execute();
$result = $stmt->get_result();

$selections = [];
while ($row = $result->fetch_assoc()) {
    $selections[] = $row['checkbox'];
}

echo json_encode(['selections' => $selections]);
?>
