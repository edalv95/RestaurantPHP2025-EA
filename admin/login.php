<?php

include ("bd.php");

session_start();
$error = "";
if($_POST){
    $nombreusuario = (isset($_POST['nombreusuario'])) ? $_POST['nombreusuario'] : "";
    $contrasenia = (isset($_POST['contrasenia'])) ? $_POST['contrasenia'] : "";

    // Buscar solo por nombreusuario
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE nombreusuario = :nombreusuario");
    $sentencia->bindParam(':nombreusuario', $nombreusuario);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_LAZY);

    if($resultado && md5($contrasenia) === $resultado['contrasenia']){
        $_SESSION['usuario'] = $resultado['nombreusuario'];
        $_SESSION['correo'] = $resultado['correo'];
        $_SESSION['rol'] = $resultado['Rol'];
        $_SESSION['id'] = $resultado['ID'];
        $Rol = $resultado['Rol'];
        if($Rol == 1){
            header("Location:index.php");
        } else {
            header("Location:../index.php");
        }
    } else {
        print_r($resultado);
        $error = "Usuario o contraseña incorrectos";
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>

        <main>
        <div class="container min-vh-100 d-flex align-items-center justify-content-center">
            <div class="row w-100 justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php } ?>
                    <div class="card text-start">
                        <div class="card-header"> Login </div>
                        <div class="card-body">
                            <form action="login.php" method="post">
                                <div class="mb-3">
                                    <label for="nombreusuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="nombreusuario" id="nombreusuario" aria-describedby="helpId" placeholder="" />
                                </div>
                                <div class="mb-3">
                                    <label for="contrasenia" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" placeholder="" />
                                </div>
                                <br/>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
