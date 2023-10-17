<?php
//print_r($_POST);
if (empty($_POST["txtPromocion"]) || empty($_POST["txtDuracion"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$promocion = $_POST["txtPromocion"];
$duracion = $_POST["txtDuracion"];
$codigo = $_POST["codigo"];
$cliente = $_POST["cliente"];

$sentencia = $bd->prepare("INSERT INTO promociones(promocion,duracion,id_cliente,id_producto) VALUES (?,?,?,?);");
$resultado = $sentencia->execute([$promocion,$duracion,$cliente,$codigo]);

if ($resultado === TRUE) {
    header('Location: agregarPromocion.php?codigo='. $cliente . '&producto=' . $codigo);
} 