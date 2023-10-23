<?php
if (empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtCelular"])) {
    header('Location: registrarNumeroC.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombre = $_POST["txtNombre"];
$telefono = $_POST["txtCelular"];



$sentencia = $bd->prepare("INSERT INTO clientes(nombre_cliente,numero_telefono) VALUES (?,?);");
$resultado = $sentencia->execute([$nombre, $telefono]);

if ($resultado === TRUE) {
    header('Location: registrarNumeroC.php?mensaje=registrado');
} else {
    header('Location: registrarNumeroC.php?mensaje=error');
    exit();
}
?>