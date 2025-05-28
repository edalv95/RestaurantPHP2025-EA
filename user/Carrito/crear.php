<?php 

$url_base="http://localhost/restaurant/admin";
include("../../user/templates/header.php");

print_r($_SESSION);
if($_POST){
    $menu_ID = (isset($_POST['menu_id'])) ? $_POST['menu_id'] : "";
    $usuario_ID = $_SESSION['id'];
    $existe = $conexion->prepare("SELECT * FROM tbl_carrito WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
    $existe->bindParam(':menu_id', $menu_ID);
    $existe->bindParam(':usuario_id', $usuario_ID);
    $existe->execute();
    if($existe->rowCount() > 0) {
        $sentencia = $conexion->prepare("UPDATE tbl_carrito SET cantidad = cantidad + 1 WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
        $sentencia->bindParam(':menu_id', $menu_ID);
        $sentencia->bindParam(':usuario_id', $usuario_ID);
        $sentencia->execute();
    } else {
        $sentencia = $conexion->prepare("INSERT INTO tbl_carrito (menu_id, usuario_id,cantidad) VALUES (:menu_id, :usuario_id,1);"); 
        $sentencia->bindParam(':menu_id', $menu_ID);
        $sentencia->bindParam(':usuario_id', $usuario_ID);
        $sentencia->execute();
        echo '<script>alert("El platillo ha sido agregado a tu carrito");</script>';

    }

    
    echo '<script>window.location = "index.php";</script>';
    exit;
}
