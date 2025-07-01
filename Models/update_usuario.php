<?php
header('Content-Type: application/json');
require 'db.php';

$idviejo = $_GET['idviejo'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';
$rol = $_POST['rol'] ?? '';

if (!$idviejo) {
    echo json_encode(['errorMsg' => 'ID de usuario no proporcionado']);
    exit;
}

$stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, contraseña = ?, rol = ? WHERE id = ?");
$stmt->bind_param("ssss", $nombre, $contraseña, $rol, $idviejo);

try {
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
} catch (Exception $e) {
    echo json_encode(['errorMsg' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
    exit;
}

$stmt->close();
$conn->close();
?>
