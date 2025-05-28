<?php 

$url_base="http://localhost/restaurant/admin";
include("../../user/templates/header.php");
include("../../admin/bd.php");


if($_POST){
    $menu_ID = (isset($_POST['menu_id'])) ? $_POST['menu_id'] : "";
    $usuario_ID = $_SESSION['id'];
    $existe = $conexion->prepare("SELECT * FROM tbl_favoritos WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
    $existe->bindParam(':menu_id', $menu_ID);
    $existe->bindParam(':usuario_id', $usuario_ID);
    $existe->execute();
  

        $sentencia = $conexion->prepare("DELETE FROM tbl_favoritos WHERE menu_id = :menu_id AND usuario_id = :usuario_id");
        $sentencia->bindParam(':menu_id', $menu_ID);
        $sentencia->bindParam(':usuario_id', $usuario_ID);
        $sentencia->execute();
        echo '<script>alert("El platillo ha sido eliminado de tus favoritos");</script>';

 
    
    echo '<script>window.location = "index.php";</script>';
    exit;
}