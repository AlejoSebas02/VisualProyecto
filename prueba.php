<?php
echo gettype("Hola, mundo!");
echo "<br>";
print_r(gettype(123));
echo "<br>";
print_r(gettype(True));
$colores = array("rojo", "azul");
echo "<br>";
//ciclo for
for ($i = 0; $i < count($colores); $i++) {
    echo $colores[$i] . "<br>";
}
//ciclo foreach
foreach ($colores as $color) {
    echo $color . "<br>";
}
//array con propiedades
echo "<br>";
$persona = array(
    "nombre" => "Juan",
    "edad" => 30,
    "ciudad" => "Madrid"
);
// Imprimir propiedades del array
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor<br>";
}
//Imprimir las propiedades del array usando for
for ($i = 0; $i < count($persona); $i++) {
    $clave = array_keys($persona)[$i];
    echo "$clave: " . $persona[$clave] . "<br>";
}
// Imprimir el array completo
print_r($persona);
$frutas = (object) [
    "nombre" => "Manzana",
    "color" => "Rojo",
    "peso" => 150
];
echo "<br>";
// Imprimir una propiedad del objeto
echo ($frutas->nombre);
function saludar($nombre)
{
    return "Hola, " . $nombre . "!";
}
echo "<br>";
echo saludar("Carlos");
echo "<br>";
//Uso de condicionales
if (6 > 8) {
    echo "6 es mayor que 8";
} else {
    echo "6 no es mayor que 8";
}
echo "<br>";

switch (date("D")) {
    case "Mon":
        echo "Hoy se trabaja";
        break;
    case "Tue":
        echo "Hoy se trabaja";
        break;
    case "Wed":
        echo "Hoy se trabaja";
        break;
    case "Thu":
        echo "Hoy se trabaja";
        break;
    case "Fri":
        echo "Hoy se trabaja";
        break;
    case "Sat":
        echo "Hoy es fin de semana";
        break;
    case "Sun":
        echo "Hoy es fin de semana";
}
echo "<br>";
//Uso de while
$contador = 0;
while ($contador < 5) {
    echo "Contador: $contador<br>";
    $contador++;
}


//Imprimir por consola
echo "<script>console.log('Hola, mundo desde PHP');</script>";
//funcion para imprimir objetos automoviles
$automovil = (object) [
    "marca" => "Toyota",
    "modelo" => "Corolla",
    "año" => 2020
];
function imprimirAutomovil($automovil)
{
    echo "Marca: " . $automovil->marca . "<br>";
    echo "Modelo: " . $automovil->modelo . "<br>";
    echo "Año: " . $automovil->año . "<br>";
}
// Crear un objeto automovil

imprimirAutomovil($automovil);
//Imprimir por consola
echo "<br>";
//Uso de clases y objetos
class Automovil
{
    public $marca;
    public $modelo;
    public $año;

    public function __construct($marca, $modelo, $año)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año = $año;
    }

    public function imprimir()
    {
        echo "Marca: " . $this->marca . "<br>";
        echo "Modelo: " . $this->modelo . "<br>";
        echo "Año: " . $this->año . "<br>";
    }
}
$miAutomovil = new Automovil("Honda", "Civic", 2021);
$miAutomovil->imprimir();
echo "<br>";
//imprimir version de PHP
echo "Versión de PHP: " . phpversion() . "<br>";
//Imprimir fecha y hora actual
echo "Fecha y hora actual: " . date("Y-m-d H:i:s") . "<br>";
//imprimir "
?>