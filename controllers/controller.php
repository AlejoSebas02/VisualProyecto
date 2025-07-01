<?php
// Include the necessary files
include_once "models/model.php";
class MvcController {
 
    public function enlacesPaginasController(){
        //get post
        if(isset($_GET["action"])){
            $enlacesController = $_GET["action"];
        } else {
            $enlacesController = "inicio.php";
        }
        $respuesta= EnlacesPaguinas::enlacesPaginasModel($enlacesController);
        // Mostrar por consola el valor de $respuesta
        include $respuesta;
        //Demostracion de uso de la variable $respuesta
        
    }
}
?>