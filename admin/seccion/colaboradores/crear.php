<?php 

include("../../templates/header.php");
include("../../bd.php");


if($_POST){
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $linkFacebook = (isset($_POST['linkFacebook'])) ? $_POST['linkFacebook'] : "";
    $linkInstagram = (isset($_POST["linkInstagram"])) ? $_POST['linkInstagram'] : "";
    $linkLinkedin = (isset($_POST['linkLinkedin'])) ? $_POST['linkLinkedin'] : "";
    $foto = (isset($_FILES['foto']['name'])) ? $_FILES['foto']['name'] : "";
    $fecha_foto = new DateTime();
    $fecha_foto->setTimezone(new DateTimeZone("America/Mexico_City"));
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmpFoto = $_FILES['foto']['tmp_name'];

if($tmpFoto != "") {
        move_uploaded_file($tmpFoto, "../../../images/chefs/".$nombre_foto);

}

    $sentencia = $conexion->prepare("INSERT INTO tbl_colaboradores (titulo, descripcion, linkFacebook, linkInstagram, linkLinkedin, foto) VALUES (:titulo, :descripcion, :linkFacebook, :linkInstagram, :linkLinkedin, :foto);");
    $sentencia->bindParam(':titulo', $titulo);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':linkFacebook', $linkFacebook);
    $sentencia->bindParam(':linkInstagram', $linkInstagram);
    $sentencia->bindParam(':linkLinkedin', $linkLinkedin);
    $sentencia->bindParam(':foto', $nombre_foto);
    $sentencia->execute();
    
    header("Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Colaborador</strong></div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Nombre del Colaborador"
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
                    placeholder="Descripcion del colaborador"
                />
                
            </div>

            <div class="mb-3">
                <label for="linkFacebook" class="form-label">Link de Facebook:</label>
                <input
                    type="text"
                    class="form-control"
                    name="linkFacebook"
                    id="linkFacebook"
                    aria-describedby="helpId"
                    placeholder="Link de Facebook del colaborador"
                />
                
            </div>

            <div class="mb-3">
                <label for="linkInstagram" class="form-label">Link de Instagram:</label>
                <input
                    type="text"
                    class="form-control"
                    name="linkInstagram"
                    id="linkInstagram"
                    aria-describedby="helpId"
                    placeholder="Link de Instagram del colaborador"
                />
                
            </div>

            <div class="mb-3">
                <label for="linkLinkedin" class="form-label">Link de Linkedin:</label>
                <input
                    type="text"
                    class="form-control"
                    name="linkLinkedin"
                    id="linkLinkedin"
                    aria-describedby="helpId"
                    placeholder="Link de Linkedin del colaborador"  
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
                    placeholder="Foto del colaborador"
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