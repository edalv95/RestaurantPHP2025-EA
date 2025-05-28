<?php
// Solo incluir el header, que ya incluye la base de datos y session_start
include("user/templates/header.php");

// Obtener datos después del header
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


            <section id="banner" class="container-fluid p-0">
             <div class="banner-img" style="position:relative; background:url('images/banners/<?php echo $banner_activo['foto']?>') center/cover no-repeat; height:400px; ">
              <div class="banner-text" style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color: #fff;">
                <h1 style="background: rgba(0,0,0,0.7); color: #fff; display: inline-block; padding: 0.5em 1em; border-radius: 8px; margin-bottom: 0.5em;">
                  <?php echo $banner_activo['titulo']; ?>
                </h1>
                <br/>
                <p style="background: rgba(0,0,0,0.7); color: #fff; display: inline-block; padding: 0.5em 1em; border-radius: 8px; font-size: 1.2em; margin-bottom: 1em;">
                  <?php echo $banner_activo['descripcion']; ?>
                </p>
                <br/>
                <a href="<?php echo $banner_activo['link']; ?>" class="btn btn-primary btn-lg" style="margin-top: 0.5em;"><?php echo $banner_activo['boton']?></a>
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

        </br>
        </br>
        </br>
        <!-- Chefs -->
        <section id="Chefs" class="container mt-4 text-center">
          <h2>Nuestros Chefs </h2>
          </br>
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
            </br>
            </br>
            </br>
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
              </br>


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

<style>
.chef-card-img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  object-position: center;
  border-radius: 8px 8px 0 0;
}
</style>


<button type="button" id="btnScrollTop" class="btn btn-primary btn-lg" style="position: fixed; bottom: 40px; right: 40px; display: none; z-index: 9999;">
  <i class="fas fa-arrow-up"></i>
</button>

<script>
window.addEventListener('scroll', function() {
  var btn = document.getElementById('btnScrollTop');
  if (window.scrollY > 200) {
    btn.style.display = 'block';
  } else {
    btn.style.display = 'none';
  }
});
var btn = document.getElementById('btnScrollTop');
btn && btn.addEventListener('click', function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

<?php
include("user/templates/footer.php");
?>