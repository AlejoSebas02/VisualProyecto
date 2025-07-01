<?php
$host = getenv('DB_HOST') ?: 'metro.proxy.rlwy.net';
$port = getenv('DB_PORT') ?: 18806;
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'YSXhNtkPSbhqwZsCyOktwOhFStWkGKbb';
$dbname = getenv('DB_NAME') ?: 'railway';

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die(json_encode(['errorMsg' => 'Error de conexión: ' . $conn->connect_error]));
}
?>
