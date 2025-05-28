<?php 

include("../../user/templates/header.php");
include("../../admin/bd.php");

//Traer todos los registros
$sentencia = $conexion->prepare("SELECT tbl_carrito.ID AS carrito_id, tbl_carrito.*, M.* FROM tbl_carrito JOIN tbl_menu AS M ON menu_ID = M.ID");
$sentencia->execute();
$lista_carrito = $sentencia->fetchall(PDO::FETCH_ASSOC);
$total = 0;
$lista_carrito_usuario = array();

//Borrar por txtID
if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM tbl_carrito WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    echo '<script>window.location = "index.php";</script>';
    exit;
}


?>
<main class="flex-grow-1">
<br/>


<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
   
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Ingredientes</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_carrito as $key => $value){
                    if($value['usuario_ID'] == $_SESSION['id']){
                        $lista_carrito_usuario[] = $value;
                ?>
                <tr class="">

                    <td><?php echo $value['nombre']; ?></td>
                    <td>
                        <?php if (!empty($value['foto'])): ?>
                            <img src="../../images/Food/<?php echo $value['foto']; ?>" alt="Foto de <?php echo $value['nombre']; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                        <?php else: ?>
                            <span class="text-muted">Sin foto</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $value['descripcion']; ?></td>
                    <td><?php echo $value['ingredientes']; ?></td>
                    <td><?php echo $value['cantidad']; ?></td>
                    <td><?php echo $value['precio']; 

                    ?></td>
                    <td>
                        <?php 
                            $total_producto = $value['precio'] * $value['cantidad'];
                            echo $total_producto;
                            $total += $total_producto;
                        ?>
                    <td>         
                        <a class="btn btn-danger" href="index.php?txtID=<?php echo $value['carrito_id']; ?>" role="button">Borrar</a>
                    </td>
                    
                </tr>
                <?php } }?> 
           </tbody>
        </table>
        <div class="d-flex justify-content-end align-items-center gap-3">
            <div class="lg-3 fs-3 fw-bold">
                <strong>Total Carrito:</strong> $<?php echo $total; ?>
            </div>
            <form action="../Historial/compra.php" method="post" class="d-inline">
                <input type="hidden" name="txtID" value="<?php echo $value['carrito_id']; ?>">
                <input type="hidden" name="carrito_usuario" value='<?php echo json_encode($lista_carrito_usuario, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
                <button type="submit" class="btn btn-primary btn-lg">Finalizar compra</button>
            </form>
        </div>
       </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>


</main>
<?php include("../../user/templates/footer.php"); ?>

