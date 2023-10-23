<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from clientes");
    $cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);
    $id_producto = $_GET["codigo"];
    //print_r($cliente);
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                    Elegir cliente
            </div>
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Celular</th>
                                <th scope="col" colspan="1">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                                foreach($cliente as $dato){ 
                            ?>

                            <tr>
                                <td scope="row"><?php echo $dato->id; ?></td>
                                <td><?php echo $dato->nombre_cliente; ?></td>
                                <td><?php echo $dato->numero_telefono; ?></td>
                                <td><a class="text-primary" href="agregarPromocion.php?codigo=<?php echo $dato->id; ?>&producto=<?php echo  $id_producto; ?>"><i class="bi bi-cursor"></i></a></td>                            </tr>
                            <?php 
                                }
                            ?>

                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'template/footer.php' ?>