<?php 

include("../../templates/header.php");
include("../../bd.php");

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php

if(isset($_GET['txtID'])) {
    $txtID =(isset($_GET['txtID']))? $_GET['txtID'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombreusuario = $usuario['nombreusuario'];
    $contrasenia = $usuario['contrasenia'];
    $correo = $usuario['correo'];


} else {
    header("Location:index.php");
}

if($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreusuario = (isset($_POST['nombreusuario'])) ? $_POST['nombreusuario'] : "";
    $contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";
    $contrasenia = md5($contrasenia);
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET nombreusuario = :nombreusuario, contrasenia = :contrasenia, correo = :correo WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->bindParam(':nombreusuario', $nombreusuario);
    $sentencia->bindParam(':contrasenia', $contrasenia);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->execute();

    
    header("Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Usuario</strong></div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID de Usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="ID de Usuario"
                    value ="<?php echo $txtID; ?>"
                    readonly
                />
                
            </div>

            <div class="mb-3">
                <label for="nombreusuario" class="form-label">Nombre de Usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombreusuario"
                    id="nombreusuario"
                    aria-describedby="helpId"
                    placeholder="Nombre de Usuario"
                    value="<?php echo $nombreusuario; ?>"
                />
                
            </div>

            <div class="mb-3">
                <label for="contrasenia" class="form-label">Contraseña:</label>
                <div class="input-group">
                    <input
                        type="password"
                        class="form-control"
                        name="contrasenia"
                        id="contrasenia"
                        aria-describedby="helpId"
                        placeholder="*********"
                        
                    />
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input
                    type="text"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="helpId"
                    placeholder="Correo del usuario"
                    value="<?php echo $correo; ?>"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('contrasenia');
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    });
</script>

<?php include("../../templates/footer.php"); ?>