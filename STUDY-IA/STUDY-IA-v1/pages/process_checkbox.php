<?php
session_start();
include('connectDB.php');

if (!isset($_SESSION['IDusuario'])) {
    echo json_encode(['message' => 'Usuário não logado']);
    exit;
}

$IDusuario = $_SESSION['IDusuario'];
$checkbox = $_POST['checkbox'];
$checked = $_POST['checked'] === 'true';

// Verificar se a conexão com o banco de dados foi bem-sucedida
if ($connectDB->connect_error) {
    die("Erro na conexão com o banco de dados: " . $connectDB->connect_error);
}

if ($checked) {
    // Inserir no banco de dados se a checkbox foi marcada
    $query = "INSERT INTO usuario_fisica_selecoes (IDusuario, checkbox) VALUES (?, ?)";
    $stmt = $connectDB->prepare($query);
    $stmt->bind_param('is', $IDusuario, $checkbox);
    $stmt->execute();
} else {
    // Remover do banco de dados se a checkbox foi desmarcada
    $query = "DELETE FROM usuario_fisica_selecoes WHERE IDusuario = ? AND checkbox = ?";
    $stmt = $connectDB->prepare($query);
    $stmt->bind_param('is', $IDusuario, $checkbox);
    $stmt->execute();
}

echo json_encode(['message' => 'Operação realizada com sucesso']);
?>
