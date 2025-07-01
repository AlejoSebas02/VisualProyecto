<?php
    class MvcController {
        public function enlacesPaginaController() {
            if ($_GET["action"] == "index" || 
                $_GET["action"] == "about" || 
                $_GET["action"] == "contact") {
                $controller = $_GET["action"];
            } else {
                $controller = "index.php";
            }
            $respuesta=
        }
?>