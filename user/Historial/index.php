<?php 

include("../../user/templates/header.php");
include("../../admin/bd.php");

//Traer todos los registros
$sentencia = $conexion->prepare("SELECT * FROM (tbl_transaccion as T INNER JOIN tbl_menu as M ON T.transaccion_Menu_ID=M.ID) WHERE transaccion_usuario_ID = :transaccion_usuario_ID ORDER BY transaccion_Fecha DESC");
$sentencia->bindParam(':transaccion_usuario_ID', $_SESSION['id']);
$sentencia->execute();
$lista_transacciones = $sentencia->fetchall(PDO::FETCH_ASSOC);



//Borrar por txtID
if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM tbl_transacciones WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    echo '<script>window.location = "index.php";</script>';
    exit;
}


?>

<br/>


<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
 
                    <th scope="col">Item</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($lista_transacciones as $key => $value){
                    if($value['transaccion_Usuario_ID'] == $_SESSION['id']){
                        
                ?>
                <tr class="">
                    <td scope="row"><?php echo $value['nombre']; ?></td>
                    <td><?php echo $value['transaccion_Cantidad']; ?></td>
                    <td><?php echo $value['transaccion_Fecha']; ?></td>
                    <td><?php echo $value['precio']; ?></td>
                    <td><?php $total = $value['transaccion_Cantidad'] * $value['precio']; echo $total; ?></td>

                    
                </tr>
                <?php } }?> 
           </tbody>
        </table>
       </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>



<?php include("../../user/templates/footer.php"); ?>
