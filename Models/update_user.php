<?php
header('Content-Type: application/json');
require 'db.php';

$cedulaVieja = $_GET['cedulaVieja'] ?? null;
$cedula = $_POST['cedula'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';

if (!$cedulaVieja) {
    echo json_encode(['errorMsg' => 'Cedula de usuario no proporcionado']);
    exit;
}

$stmt = $conn->prepare("UPDATE estudiantes SET cedula = ?, nombre = ?, apellido = ?, telefono = ?, direccion = ? WHERE cedula = ?");
$stmt->bind_param("ssssss", $cedula, $nombre, $apellido, $telefono, $direccion,$cedulaVieja);

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
