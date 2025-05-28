<?php 

include("../../templates/header.php");
include("../../bd.php");


if($_POST){

    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
    $ingredientes = (isset($_POST['ingredientes'])) ? $_POST['ingredientes'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";
    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
    $fecha_foto = new DateTime();
    $fecha_foto->setTimezone(new DateTimeZone("America/Mexico_City"));
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmpFoto = $_FILES['foto']['tmp_name'];

if($tmpFoto != "") {
        move_uploaded_file($tmpFoto, "../../../images/Food/".$nombre_foto);

}

    $sentencia = $conexion->prepare("INSERT INTO tbl_menu (nombre, ingredientes, precio, descripcion, foto) VALUES (:nombre, :ingredientes, :precio, :descripcion, :foto);");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':ingredientes', $ingredientes);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':foto', $nombre_foto);
    $sentencia->execute();
    
    header("Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Plato</strong></div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Nombre del Plato"
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
                />
                
            </div>

            <button type="submit" class="btn btn-success">Crear</button>
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