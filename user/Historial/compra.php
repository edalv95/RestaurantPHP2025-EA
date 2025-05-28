<?php 

$url_base="http://localhost/restaurant/admin";
include("../../user/templates/header.php");
include("../../admin/bd.php");

print_r($_SESSION);
if($_POST){
    $txtID =(isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $carrito_usuario = isset($_POST['carrito_usuario']) ? json_decode($_POST['carrito_usuario'], true) : [];
    foreach($carrito_usuario as $key => $value){

        $transaccion_Usuario_ID = $value['usuario_ID'];
        $transaccion_Menu_ID = $value['menu_ID'];
        $transaccion_Cantidad = $value['cantidad'];
        $transaccion_Fecha = date('Y-m-d H:i:s');
        $sentencia = $conexion->prepare("INSERT INTO");
        $sentencia = $conexion->prepare("INSERT INTO tbl_transaccion (transaccion_usuario_ID, transaccion_menu_ID, transaccion_cantidad, transaccion_fecha) VALUES (:transaccion_usuario_ID, :transaccion_menu_ID, :transaccion_cantidad, :transaccion_fecha);");
        $sentencia->bindParam(':transaccion_usuario_ID', $transaccion_Usuario_ID);
        $sentencia->bindParam(':transaccion_menu_ID', $transaccion_Menu_ID);
        $sentencia->bindParam(':transaccion_cantidad', $transaccion_Cantidad);
        $sentencia->bindParam(':transaccion_fecha', $transaccion_Fecha);
        $sentencia->execute();
        $sentencia = $conexion->prepare('DELETE FROM tbl_carrito WHERE usuario_id = :usuario_id');
        $sentencia->bindParam(':usuario_id', $transaccion_Usuario_ID);
        $sentencia->execute();
    }
   
    echo '<script>window.location = "../Carrito/index.php?txtID=' . $txtID . '";</script>';
    exit;
}
