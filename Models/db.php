<?php
$host = 'localhost';
$port = 3306;
$user = 'root';
$pass = ''; 
$dbname = 'cuarto';
try{
$conn = new mysqli($host, $user, $pass, $dbname, $port);
}catch(Exception $e){  
    echo json_encode(['errorMsg' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
    exit;
}
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
