<?php 

include("../../user/templates/header.php");

$sentencia = $conexion->prepare("SELECT * FROM tbl_transaccion as T INNER JOIN tbl_menu as M ON T.transaccion_Menu_ID=M.ID WHERE T.transaccion_Usuario_ID = :transaccion_usuario_ID ORDER BY T.transaccion_Fecha DESC");
$sentencia->bindParam(':transaccion_usuario_ID', $_SESSION['id']);
$sentencia->execute();
$lista_transacciones = $sentencia->fetchall(PDO::FETCH_ASSOC);

$transacciones_por_fecha = [];
foreach ($lista_transacciones as $transaccion) {
    $fecha_hora = date('Y-m-d H:i:s', strtotime($transaccion['transaccion_Fecha']));
    if (!isset($transacciones_por_fecha[$fecha_hora])) {
        $transacciones_por_fecha[$fecha_hora] = [];
    }
    $transacciones_por_fecha[$fecha_hora][] = $transaccion;
}


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
<div class="container">
  <div class="row justify-content-center">
    <?php foreach($transacciones_por_fecha as $fecha_hora => $transacciones) { $total_carrito = 0; ?>
    <div class="col-12 col-md-8 col-lg-6 mb-4 d-flex align-items-stretch">
      <div class="card shadow w-100">
          <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Fecha y hora: <?php echo $fecha_hora; ?></h5>
          </div>
          <div class="card-body">
             <div class="table-responsive-sm">
              <table class="table">
                  <thead>
                      <tr>
                          <th scope="col">Item</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach($transacciones as $key => $value){ ?>
                      <tr class="">
                          <td scope="row"><?php echo $value['nombre']; ?></td>
                          <td><?php echo $value['transaccion_Cantidad']; ?></td>
                          <td><?php echo $value['precio']; ?></td>
                          <td><?php $total = $value['transaccion_Cantidad'] * $value['precio']; echo $total; 
                          $total_carrito = $total_carrito + $total;
                          ?></td>
                      </tr>
                      <?php } ?> 

                 </tbody>
              </table>
             </div>
          </div>
          <div class="card-footer fw-bold text-end">
        Total Compra: <?php echo $total_carrito; ?>
      </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<?php include("../../user/templates/footer.php"); ?>
