<?php


if (empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtnumero"])) {
    header('Location: registrarNumeroC.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$nombre = $_POST["txtNombre"];
$numero = $_POST["txtnumero"];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_producto, prod.nombre ,prod.descripcion , prod.precio 
  FROM promociones pro 
  INNER JOIN producto prod ON prod.id = pro.id_producto
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://whapi.io/api/send';
    $data = [
        "app" => [
            "id" => '51959662373',
            "time" => '7103866897',
            "data" => [
                "recipient" => [
                    "id" => '51'.$numero
                ],
                "message" => [[
                    "time" => '1654728819',
                    "type" => 'text',
                    "value" => 'Estimado(a) *'.strtoupper($nombre).' '.'* No se pierda *'.strtoupper($producto->promocion).'* valido solo *'.$producto->duracion.'*'.'* en el producto *'.$producto->nombre.'*'
                ]]
            ]
        ]
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    
?>