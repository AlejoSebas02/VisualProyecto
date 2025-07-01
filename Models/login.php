<?php
session_start();
require_once 'db.php';

if (isset($_POST["Entrar"])) {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $_POST['password'];

    $sql = "SELECT nombre, contraseña, rol FROM usuarios WHERE nombre = '$usuario' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row['contraseña'] === $password) {
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];
            header('Location: ../Views/Login.php?success=1');
            exit;
        }
    }
    header('Location: ../Views/Login.php?error=1');
    exit;
} else {
    header('Location: ../Views/Login.php');
    exit;
}
?>
