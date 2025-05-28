<?php 

include("../../templates/header.php");
include("../../bd.php");


if($_POST){
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $boton = (isset($_POST['boton'])) ? $_POST['boton'] : "";
    $link = (isset($_POST['link'])) ? $_POST['link'] : "";
    $activo = (isset($_POST['activo'])) ? $_POST['activo'] : 0;
    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
    $fecha_foto = new DateTime();
    $fecha_foto->setTimezone(new DateTimeZone("America/Mexico_City"));
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmpFoto = $_FILES['foto']['tmp_name'];

if($tmpFoto != "") {
        move_uploaded_file($tmpFoto, "../../../images/banners/".$nombre_foto);

}

    $sentencia = $conexion->prepare("INSERT INTO tbl_banners (titulo, descripcion, boton, link, foto, activo) VALUES (:titulo, :descripcion, :boton, :link, :foto, :activo);");
    $sentencia->bindParam(':titulo', $titulo);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':boton', $boton);
    $sentencia->bindParam(':link', $link);
    $sentencia->bindParam(':activo', $activo);
    $sentencia->bindParam(':foto', $nombre_foto);
    $sentencia->execute();
    
    header("Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Banner</strong></div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input
                    type="text"
                    class="form-control"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Titulo del banner"
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
                    placeholder="Descripcion del banner"
                />
                
            </div>

            <div class="mb-3">
                <label for="boton" class="form-label">Boton:</label>
                <input
                    type="text"
                    class="form-control"
                    name="boton"
                    id="boton"
                    aria-describedby="helpId"
                    placeholder="Boton del banner"
                />
                
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input
                    type="text"
                    class="form-control"
                    name="link"
                    id="link"
                    aria-describedby="helpId"
                    placeholder="Link del banner"
                />
                
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <input
                    type="file"
                    class="form-control"
                    name="foto"
                    id="foto"
                    aria-describedby="helpId"
                    placeholder="Foto del banner"
                />
                
            </div>
            <div class="mb-3">
                <label for="activo" class="form-label">Activo:</label>
                <input
                    type="text"
                    class="form-control"
                    name="activo"
                    id="activo"
                    aria-describedby="helpId"
                    placeholder="Banner activo"
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