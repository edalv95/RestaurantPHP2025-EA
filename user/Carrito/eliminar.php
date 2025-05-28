<?php 

$url_base="http://localhost/restaurant/admin";
include("../../user/templates/header.php");


if($_POST){
    $menu_ID = (isset($_POST['menu_id'])) ? $_POST['menu_id'] : "";
    $usuario_ID = $_SESSION['id'];
    $existe = $conexion->prepare("SELECT * FROM tbl_carrito WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
    $existe->bindParam(':menu_id', $menu_ID);
    $existe->bindParam(':usuario_id', $usuario_ID);
    $existe->execute();
    $carrito = $existe->fetch(PDO::FETCH_LAZY);
  
    if($existe->rowCount() > 0) {
        if($carrito["cantidad"] > 1) {
            $sentencia = $conexion->prepare("UPDATE tbl_carrito SET cantidad = cantidad - 1 WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
            $sentencia->bindParam(':menu_id', $menu_ID);
            $sentencia->bindParam(':usuario_id', $usuario_ID);
            $sentencia->execute();
        } else {
            $sentencia = $conexion->prepare("DELETE FROM tbl_carrito WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
            $sentencia->bindParam(':menu_id', $menu_ID);
            $sentencia->bindParam(':usuario_id', $usuario_ID);
            $sentencia->execute();
            echo '<script>alert("El platillo ha sido eliminado de tu carrito");</script>';
        }
    } else {
        echo '<script>alert("El platillo no está en tu carrito");</script>';
    }
 
    
    echo '<script>window.location = "index.php";</script>';
    exit;
}