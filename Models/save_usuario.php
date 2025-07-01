<?php
header('Content-Type: application/json');
require 'db.php';

$nombre = $_POST['nombre'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';
$rol = $_POST['rol'] ?? '';

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, contraseña, rol) VALUES (?, ?, ?)");
$stmt->bind_param("sss",$nombre, $contraseña, $rol);

try {
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => 'usuario registrado correctamente']);
} catch (Exception $e) {
    echo json_encode(['errorMsg' => 'Error al registrar el usuario: ' . $e->getMessage()]);
    exit;
}

$stmt->close();
$conn->close();
?>