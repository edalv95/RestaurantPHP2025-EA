<?php
include("admin/bd.php");

$url_base="http://localhost/restaurant/";

session_start();

$sentencia = $conexion->prepare("SELECT * FROM tbl_banners WHERE activo = 1");
$sentencia->execute();
$banner_activo = $sentencia->fetch(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_colaboradores");
$sentencia->execute();
$lista_colaboradores = $sentencia->fetchall(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM tbl_menu");
$sentencia->execute();
$lista_menu = $sentencia->fetchall(PDO::FETCH_ASSOC);

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
          .chef-card-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
          }
        </style>

    </head>

    <body>
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
                      <a class="nav-link" href="#Carta">Carta</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Chefs">Chefs</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Contactos">Contactos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Horarios">Horarios</a>
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
                        <a class="dropdown-item" href="<?php echo $url_base;?>user/Carrito/index.php"
                          >Carrito de Compras</a
                        >
                        <a class="dropdown-item" href="<?php echo $url_base;?>/user/Historial/index.php"
                          >Historial</a
                        >
                        <a class="dropdown-item" href="<?php echo $url_base;?>user/Favoritos/index.php"
                          >Favoritos</a
                        >
                        <a class="dropdown-item" href="<?php echo $url_base; ?>admin/cerrar.php"
                          >Cerrar Sesion</a
                        >
                      </div>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
             </nav>
             
            <section id="banner" class="container-fluid p-0">
             <div class="banner-img" style="position:relative; background:url('images/banners/<?php echo $banner_activo['foto']?>') center/cover no-repeat; height:400px; ">
              <div class="banner-text" style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color: #fff;">
                <h1 style="background: rgba(0,0,0,0.7); color: #fff; display: inline-block; padding: 0.5em 1em; border-radius: 8px;">
                  <?php echo $banner_activo['titulo']; ?>
                </h1>
                <p class="text-dark bg-light"><?php echo $banner_activo['descripcion']; ?></p>
                <a href="<?php echo $banner_activo['link']; ?>" class="btn btn-primary"><?php echo $banner_activo['boton']?></a>
              </div>
            </section>

            <section id="id" class="container mt-4 text-center">
              <div class="jumbotron bg-dark text-white">
                <br/>
                  <h2>HOLA</h2>
                  <p>COMIDA</p> 
                <br/>          

              </div>
            </section>

            


        </header>
        <main>

        <!-- Chefs -->
        <section id="Chefs" class="container mt-4 text-center">
          <h2>Nuestros Chefs </h2>
            <div class="row">
            <?php foreach($lista_colaboradores as $key => $value){ ?>
              <div class="col-md-4">
                <div class="card">
                  <img src="images/chefs/<?php echo $value['foto']; ?>" class="card-img-top chef-card-img" alt="<?php echo $value['titulo']; ?>"/>
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $value['titulo']; ?></h5>
                    <p class="card-text"><?php echo $value['descripcion']; ?></p>
                    <div class="social-icons mt-3">
                      <a href="<?php echo $value['linkFacebook']; ?>" target="_blank" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                      <a href="<?php echo $value['linkInstagram']; ?>" target="_blank" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                      <a href="<?php echo $value['linkLinkedin']; ?>" target="_blank" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

        </section>

        <!--  Testimonios -->
        <section id="Testimonios" calss="bg-light py-5">
        
        <div class="container">

              <h2 class="text-center mb-4">Testimonios</h2>
              <div class="row">
                <div class="col-md-6 d-flex">
                  <div class="card mb-4 w-100">
                    <div class="card-body">
                      <p class="card-text">"La comida es increíble y el servicio es excepcional!"</p>
                      <div class="card-footer text-muted">
                        persona 1
                      </div>
                    </div>                      
                  </div>
                </div> 

                <div class="col-md-6 d-flex">
                  <div class="card mb-4 w-100">
                    <div class="card-body">
                      <p class="card-text">"La comida no es increíble y el servicio no es excepcional!"</p>
                      <div class="card-footer text-muted">
                        persona 2
                      </div>
                    </div>                      
                  </div>
                </div> 
              </div>

        </div>
        </section>

        <!-- Menu -->
        <section id="Carta" class="container mt-4">
          <h2 class="text-center">Menú</h2>
          <br/>
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach($lista_menu as $key => $value){ ?>
            <div class="col d-flex">
              <div class="card h-100 menu-card">
                <img src="images/Food/<?php echo $value['foto']; ?>" alt="<?php echo $value['nombre']; ?>" class="card-img-top menu-card-img">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?php echo $value['nombre']; ?></h5>
                  <p class="card-text small"><strong>Ingredientes:</strong> <?php echo $value['ingredientes']; ?></p>
                  <p class="card-text"><strong> Precio:</strong> $<?php echo $value['precio']; ?></p>
                  <p class="card-text"><strong> Descripcion:</strong> <?php echo $value['descripcion']; ?></p>
                  <div class="mt-auto d-flex gap-2">
                    <form action="user/Carrito/crear.php" method="post" class="d-inline add-to-cart-form">
                      <input type="hidden" name="menu_id" value="<?php echo $value['ID']; ?>">
                      <button type="button" class="btn btn-success btn-sm btn-add-to-cart"><i class="fas fa-shopping-cart"></i> Comprar</button>
                    </form>
                    <form action="user/Favoritos/crear.php" method="post" class="d-inline">
                      <input type="hidden" name="menu_id" value="<?php echo $value['ID']; ?>">
                      <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-heart"></i> Agregar a Favoritos</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>  
          <br/>
          <br/>
        </section>

        <!-- Modal de confirmación -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Producto agregado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                El producto fue agregado al carrito correctamente.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="user/Carrito/index.php" class="btn btn-primary">Ir al carrito</a>
              </div>
            </div>
          </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.btn-add-to-cart').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
              var form = btn.closest('.add-to-cart-form');
              var formData = new FormData(form);
              fetch('user/Carrito/crear.php', {
                method: 'POST',
                body: formData
              })
              .then(function(response) { return response.text(); })
              .then(function(data) {
                var cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();
              })
              .catch(function(error) {
                alert('Error al agregar al carrito');
              });
            });
          });
        });
        </script>

        <!-- Contacto -->
        <section id="Contactos" class="container mt-4">

        <h2>Contacto</h2>
        <p>Solo si es importante</p>

        <form action="?" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" placeholder="Tu nombre" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control"  name="email" placeholder="Tu email" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control"  name="message" placeholder="el mensaje" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <br/>


        </section> 

        <!--  Horarios  -->
        <section id="Horarios">
        <div class="text-center bg-light p-4">
          <h3 class="mb-4">horario de atencion</h3>
          <div>
            <p><strong>Lunes a viernes</strong></p>
            <p><strong>2:00 a.m. - 2:30 a.m. </strong></p>
          </div>

          <div>
            <p><strong>Sabado</strong></p>
            <p><strong>8:00 a.m. - 8:30 p.m. </strong></p>
          </div>

          <div>
            <p><strong>Domingo</strong></p>
            <p><strong>1:00 a.m. - 1:01 a.m. </strong></p>
          </div>

        </div>
        </section>

        </main>
        <footer class="bg-dark text-light text-center">
            <div class="container">
                <p>&copy; 2025 Restaurante Algo. Todos los derechos reservados.</p>
                <div>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </footer>
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


<?php



?>