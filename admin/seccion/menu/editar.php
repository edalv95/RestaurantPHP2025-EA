<?php 

include("../../templates/header.php");
include("../../bd.php");


if(isset($_GET['txtID'])) {
    $txtID =(isset($_GET['txtID']))? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_menu WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    $menu = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $menu['nombre'];
    $ingredientes = $menu['ingredientes'];
    $precio = $menu['precio'];
    $descripcion = $menu['descripcion'];
    $foto = $menu['foto'];
    $old_foto;
    if(isset($menu["foto"]) && $menu["foto"] != "") {
        if(file_exists("../../../images/Food/".$menu["foto"])) {
            $old_foto = $menu["foto"];
        }
    }

} else {
    header("Location:index.php");
}


if($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $ingredientes = (isset($_POST['ingredientes'])) ? $_POST['ingredientes'] : "";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
    $fecha_foto = new DateTime();
    $fecha_foto->setTimezone(new DateTimeZone("America/Mexico_City"));
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmpFoto = $_FILES['foto']['tmp_name'];

    if(file_exists("../../../images/Food/".$old_foto)) {
        unlink("../../../images/Food/".$old_foto);
      }


if($tmpFoto != "") {
        move_uploaded_file($tmpFoto, "../../../images/Food/".$nombre_foto);

}

    $sentencia = $conexion->prepare("UPDATE tbl_menu SET nombre = :nombre, ingredientes = :ingredientes, precio = :precio, descripcion = :descripcion, foto = :foto WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':ingredientes', $ingredientes);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':foto', $nombre_foto);
    $sentencia->execute();
    header(header: "Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Plato</strong></div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input
                    type="text"
                    class="form-control"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="ID del Plato"
                    value ="<?php echo $txtID; ?>"
                    readonly
                />
                
            </div>
        
        
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Nombre del Plato"
                    value="<?php echo $nombre; ?>"
                />
                
            </div>

            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes:</label>
                <input
                    type="text"
                    class="form-control"
                    name="ingredientes"
                    id="ingredientes"
                    aria-describedby="helpId"
                    placeholder="Ingredientes del Plato"
                    value="<?php echo $ingredientes; ?>"
                />
                
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input
                    type="text"
                    class="form-control"
                    name="descripcion"
                    id="descripcion"
                    aria-describedby="helpId"
                    placeholder="Descripcion del Plato"
                    value="<?php echo $descripcion; ?>"
                />
                
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input
                    type="text"
                    class="form-control"
                    name="precio"
                    id="precio"
                    aria-describedby="helpId"
                    placeholder="Precio del Plato"
                    value="<?php echo $precio; ?>"
                />


            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input
                    type="file"
                    class="form-control"
                    name="foto"
                    id="foto"
                    aria-describedby="helpId"
                    placeholder="Foto del Plato"
                    value="<?php echo $foto; ?>"
                />
                
            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a
                name=""
                id=""
                class="btn btn-danger"
                href="index.php"
                role="button"
                >Cancelar</a
            >
            
            
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>