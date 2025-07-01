<?php
session_start();
session_destroy();
header('Location: /Cuarto/index.php');
exit;
?>
