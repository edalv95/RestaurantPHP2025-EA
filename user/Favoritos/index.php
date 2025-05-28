<?php 

include("../../user/templates/header.php");

//Traer todos los registros
$sentencia = $conexion->prepare("SELECT tbl_favoritos.ID AS favorito_id, tbl_favoritos.*, M.* FROM tbl_favoritos JOIN tbl_menu AS M ON menu_ID = M.ID");
$sentencia->execute();
$lista_favoritos = $sentencia->fetchall(PDO::FETCH_ASSOC);

//Borrar por txtID
if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM tbl_favoritos WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    echo '<script>window.location = "index.php";</script>';
    exit;
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : '';
if ($orden === 'precio') {
    usort($lista_favoritos, function($a, $b) { return $a['precio'] <=> $b['precio']; });
} elseif ($orden === 'alfabetico') {
    usort($lista_favoritos, function($a, $b) { return strcmp($a['nombre'], $b['nombre']); });
}

?>
<main class="flex-grow-1">
<br/>


        <section id="Carta" class="container mt-4">
          <h2 class="text-center">Favoritos</h2>
          <div class="d-flex justify-content-center mb-3 gap-2">
            <a href="?orden=precio" class="btn btn-outline-primary btn-sm">Ordenar por Precio</a>
            <a href="?orden=alfabetico" class="btn btn-outline-secondary btn-sm">Ordenar Alfabéticamente</a>
          </div>
          <br/>
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach($lista_favoritos as $key => $value){
                if($value['usuario_ID'] == $_SESSION['id']){ ?>
            <div class="col d-flex">
              <div class="card h-100 menu-card">
                <img src="../../images/Food/<?php echo $value['foto']; ?>" alt="<?php echo $value['nombre']; ?>" class="card-img-top menu-card-img">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?php echo $value['nombre']; ?></h5>
                  <p class="card-text small"><strong>Ingredientes:</strong> <?php echo $value['ingredientes']; ?></p>
                  <p class="card-text"><strong> Precio:</strong> $<?php echo $value['precio']; ?></p>
                  <p class="card-text"><strong> Descripcion:</strong> <?php echo $value['descripcion']; ?></p>
                    <div class="mt-auto d-flex gap-2">
                    <form action="../Carrito/crear.php" method="post" class="d-inline">
                      <input type="hidden" name="menu_id" value="<?php echo $value['menu_ID']; ?>">
                      <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-shopping-cart"></i> Comprar</button>
                    </form>
                    <form action="eliminar.php" method="post" class="d-inline">
                      <input type="hidden" name="menu_id" value="<?php echo $value['ID']; ?>">
                      <button type="submit" class="btn btn-danger btn-sm"><i class=""></i> Eliminar de Favoritos</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } } ?>
          </div>  
          <br/>
          <br/>
        </section>


</main>
<?php include("../../user/templates/footer.php"); ?>

