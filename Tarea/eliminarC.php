<?php 
    if(!isset($_GET['codigo'])){
        header('Location: registrarNumeroC.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';
    $codigo = $_GET['codigo'];
    
    $sentencia = $bd->prepare("DELETE FROM clientes where id = ?;");
    $resultado = $sentencia->execute([$codigo]);

    $sentencia2 = $bd->prepare("DELETE FROM promociones where id_cliente = ?;");
    $resultado2 = $sentencia2->execute([$codigo]);
    
    if ($resultado === TRUE){
        header('Location: registrarNumeroC.php?mensaje=eliminado');
    } else {
        header('Location: registrarNumeroC.php?mensaje=error');
    }
?>