<?php 

include("../../templates/header.php"); 
include("../../bd.php");


$sentencia = $conexion->prepare("SELECT * FROM tbl_banners");
$sentencia->execute();
$lista_banners = $sentencia->fetchall(PDO::FETCH_ASSOC);


if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM tbl_banners WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    $registro_foto  = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($registro_foto["foto"]) && $registro_foto["foto"] != "") {
        if(file_exists("../../../images/banners/".$registro_foto["foto"])) {
            unlink("../../../images/banners/".$registro_foto["foto"]);
        }
    }
    header("Location:index.php");
}

?>
<br/>

<div class="card">

    <div class="card-header">
    <?php if ($lista_banners == null) { ?>
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Registros</a
        >
    <?php } ?>
        
    </div>
    <div class="card-body">
       <div
        class="table-responsive-sm"
       >
        <table
            class="table"
        >
            <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Boton</th>
                    <th scope="col">Link</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                    <?php foreach($lista_banners as $key => $value){ ?>
                    <tr class="">
                        <td><?php echo $value['titulo']; ?></td>
                        <td><?php echo $value['descripcion']; ?></td>
                        <td><?php echo $value['boton']; ?></td>
                        <td><?php echo $value['link']; ?></td>
                        <td>
                            <?php if (!empty($value['foto'])): ?>
                                <img src="../../../images/banners/<?php echo $value['foto']; ?>" alt="Foto de <?php echo $value['titulo']; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <span class="text-muted">Sin foto</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a
                                name=""
                                id=""
                                class="btn btn-info"
                                href="editar.php?txtID=<?php echo $value['ID']; ?>"
                                role="button"
                                >Editar</a
                            >
                            <a
                                name=""
                                id=""
                                class="btn btn-danger"
                                href="index.php?txtID=<?php echo $value['ID']; ?>"
                                role="button"
                                >Borrar</a
                            >
                        </td>
                    </tr>
                    <?php } ?> 
                
           </tbody>
        </table>
       </div>
       
    </div>
    <div class="card-footer text-muted"></div>

</div>
                            </br>
                            </br>
                            <h1>Preview del banner:</h1>
                            </br>
                            </br>
            <section id="banner" class="container-fluid p-0">
             <div class="banner-img" style="position:relative; background:url('../../../images/banners/<?php echo $value['foto']?>') center/cover no-repeat; height:400px; ">
              <div class="banner-text" style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color: #fff;">
                <h1 style="background: rgba(0,0,0,0.7); color: #fff; display: inline-block; padding: 0.5em 1em; border-radius: 8px;">
                  <?php echo $value['titulo']; ?>
                </h1>
                <p class="text-dark bg-light"><?php echo $value['descripcion']; ?></p>
                <a href="<?php echo $value['link']; ?>" class="btn btn-primary"><?php echo $value['boton']?></a>
              </div>
            </section>


<?php include("../../templates/footer.php"); ?>
