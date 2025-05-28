<?php 

include("../../templates/header.php");
include("../../bd.php");

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php

if($_POST){
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $nombreusuario = (isset($_POST['nombreusuario'])) ? $_POST['nombreusuario'] : "";
    $contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : "";

    // Solo hashear si no está vacía
    if($contrasenia !== "") {
        $contrasenia = md5($contrasenia);
    }

    $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios (nombreusuario, contrasenia, correo) VALUES (:nombreusuario, :contrasenia, :correo);");
    $sentencia->bindParam(':nombreusuario', $nombreusuario);
    $sentencia->bindParam(':contrasenia', $contrasenia);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->execute();

    
    //header("Location:index.php");
}

?>
<br />
<div class="card">
    <div class="card-header"><strong>Usuario</strong></div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombreusuario" class="form-label">Nombre de Usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombreusuario"
                    id="nombreusuario"
                    aria-describedby="helpId"
                    placeholder="Nombre de Usuario"
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
                        placeholder="Contraseña del usuario"
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('contrasenia');
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    });
</script>

<?php include("../../templates/footer.php"); ?>