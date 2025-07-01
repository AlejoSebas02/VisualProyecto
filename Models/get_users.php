<?php
header('Content-Type: application/json');

require 'db.php';

$sql = "SELECT id, cedula, nombre, apellido, telefono, direccion FROM estudiantes";
$result = $conn->query($sql);

$rows = [];
while($row = $result->fetch_assoc()){
    $rows[] = $row;
}

echo json_encode([
    'total' => count($rows),
    'rows' => $rows
]);

$conn->close();
?>
