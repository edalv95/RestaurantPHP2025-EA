<?php $url_base="http://localhost/restaurant/admin"; ?>
<?php 

session_start();

$timeout = 300;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location:$url_base/admin/login.php?timeout=1");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION["usuario"])){
    if ($_SESSION["rol"]!=1){
        header("Location:$url_base/login.php");
    }
} else{
    header("Location:$url_base/login.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Administrador del Sitio</title>
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
        <header>
            <!-- place navbar here -->
             <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="<?php echo $url_base;?>" aria-current="page"
                        >Administrador <span class="visually-hidden">(current)</span></a
                    >
                    
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/banners/">Banners</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/colaboradores/">Colaboradores</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/testimonios/">Testimonios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/menu/">Menu</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/comentarios/">Comentarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/usuarios/">Usuarios</a>
                    <a class="nav-item nav-link" href="../index.php">Restaurant</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/cerrar.php/">Cerrar Sesion</a>

                </div>
             </nav>
             
        </header>
        <main></main>

        <section class="container">