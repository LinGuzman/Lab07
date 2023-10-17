<?php


include 'model/conexion.php';
$codigo = "1";

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion, cl.numero_telefono, cl.nombre_cliente, pr.nombre
FROM promociones pro
INNER JOIN clientes cl ON cl.id = pro.id_cliente
INNER JOIN producto pr ON pr.id = pro.id_producto
WHERE pro.id = ?;");

$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

if ($persona) {
    echo "ID del Cliente: " . $persona->id_cliente . "<br>";
    echo "ID del Producto: " . $persona->id_producto . "<br>";
    echo "Promoción: " . $persona->promocion . "<br>";
    echo "Duración: " . $persona->duracion . "<br>";
    echo "Número de Teléfono: " . $persona->numero_telefono . "<br>";
    echo "Nombre del Cliente: " . $persona->nombre_cliente . "<br>";
    echo "Nombre del Producto: " . $persona->nombre . "<br>";
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}
?>