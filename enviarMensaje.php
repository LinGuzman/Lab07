
<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();

}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion, cl.numero_telefono, cl.nombre_cliente, pr.nombre, pro.id_producto, pro.id_cliente
FROM promociones pro
INNER JOIN clientes cl ON cl.id = pro.id_cliente
INNER JOIN producto pr ON pr.id = pro.id_producto
WHERE pro.id = ?;");

$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

$url = 'https://api.green-api.com/waInstance7103866897/SendMessage/e85e430ec63b431593450442d2ab7f698b171ac3a7464ff0be';
$data = [
    "chatId" => "51".$persona->numero_telefono."@c.us",
    "message" =>  'Estimado(a) *'.strtoupper($persona->nombre_cliente).' * No se pierda *'.strtoupper($persona->promocion).'* en *'.strtoupper($persona->nombre).'* valido solo por *'.$persona->duracion.'*'
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
header('Location: agregarPromocion.php?codigo='.$persona->id_cliente.'&producto='.$persona->id_producto);
?>