<?php $url_base="http://localhost/restaurant"; ?>
<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/restaurant/admin/bd.php');

session_start();

$timeout = 300;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location:$url_base/admin/login.php?timeout=1");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

if(!(isset($_SESSION["usuario"]))){
   
    header("Location:$url_base/admin/login.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_banners WHERE activo = 1");
$sentencia->execute();
$banner_activo = $sentencia->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
    <head>
        <title><?php echo $banner_activo['titulo']?></title>
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

        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        />

        <style>
          .menu-card-img {
            height: 200px;
            object-fit: cover;
          }
          .menu-card {
            min-height: 420px;
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
          }
        </style>

    </head>
    <body style="min-height:100vh;display:flex;flex-direction:column;">
 <header>
            <!-- place navbar here -->
             <nav
              class="navbar navbar-expand-lg navbar-dark bg-dark"
             >
              <div class="container">
                <a class="navbar-brand" href="<?php echo $url_base; ?>"><i class="fas fa-utensils"></i> <?php echo $banner_activo['titulo']?></a>
                <button
                  class="navbar-toggler d-lg-none"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapsibleNavId"
                  aria-controls="collapsibleNavId"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                  <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" href="<?php echo $url_base; ?>" aria-current="page"
                        >Inicio
                        <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>#Carta">Carta</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>#Chefs">Chefs</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>#Testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>#Contactos">Contactos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>#Horarios">Horarios</a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] == "") { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo $url_base; ?>admin/login.php">Login</a>
                    </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") { ?>
                    <li class="nav-item dropdown">
                      <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="dropdownId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        ><?php echo $_SESSION['usuario']?></a
                      >
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="dropdownId"
                      >
                        <a class="dropdown-item" href="<?php echo $url_base;?>/user/Carrito/index.php"
                          >Carrito de Compras</a
                        >
                        <a class="dropdown-item" href="<?php echo $url_base;?>/user/Historial/index.php"
                          >Historial</a
                        >
                        <a class="dropdown-item" href="<?php echo $url_base;?>/user/Favoritos/index.php"
                          >Favoritos</a
                        >
                        <?php if ($_SESSION['rol'] == 1){ ?>
                        <a class="dropdown-item" href="<?php echo $url_base;?>/admin/index.php"
                          >Administracion</a
                        >
                        <?php } ?>
                        <a class="dropdown-item" href="<?php echo $url_base; ?>/admin/cerrar.php"
                          >Cerrar Sesion</a
                        >
                      </div>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
             </nav>
    </header>
    <main class="flex-grow-1">



