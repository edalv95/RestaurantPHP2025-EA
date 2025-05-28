<?php 

include("../../templates/header.php"); 
include("../../bd.php");

//Traer todos los registros
$sentencia = $conexion->prepare("SELECT * FROM tbl_colaboradores");
$sentencia->execute();
$lista_colaboradores = $sentencia->fetchall(PDO::FETCH_ASSOC);

//Borrar por txtID
if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];

    $sentencia = $conexion->prepare("SELECT foto FROM tbl_colaboradores WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    $registro_foto  = $sentencia->fetch(PDO::FETCH_LAZY);
    if(isset($registro_foto["foto"]) && $registro_foto["foto"] != "") {
        if(file_exists("../../../images/chefs/".$registro_foto["foto"])) {
            unlink("../../../images/chefs/".$registro_foto["foto"]);
        }
    }

    $sentencia = $conexion->prepare("DELETE FROM tbl_colaboradores WHERE ID = :ID");
    $sentencia->bindParam(':ID', $txtID);
    $sentencia->execute();
    header("Location:index.php");
}



?>
<br/>

<div class="card">
    <div class="card-header">

        <a
            name=""
            id=""
            class="btn btn-primary"
            href="crear.php"
            role="button"
            >Agregar Registros</a
        >
        
        
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
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Info</th>
                    <th scope="col">Links</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                    <?php foreach($lista_colaboradores as $key => $value){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $value['ID']; ?></td>
                        <td><?php echo $value['titulo']; ?></td>
                        <td>
                            <?php if (!empty($value['foto'])): ?>
                                <img src="../../../images/chefs/<?php echo $value['foto']; ?>" alt="Foto de <?php echo $value['titulo']; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <span class="text-muted">Sin foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $value['descripcion']; ?></td>
                        <td>
                            <div class="d-flex flex-column">
                                <a href="<?php echo $value['linkFacebook']; ?>" target="_blank" class="mb-1 text-decoration-none">
                                    <i class="fab fa-facebook me-1"></i><?php echo $value['linkFacebook']; ?>
                                </a>
                                <a href="<?php echo $value['linkInstagram']; ?>" target="_blank" class="mb-1 text-decoration-none">
                                    <i class="fab fa-instagram me-1"></i><?php echo $value['linkInstagram']; ?>
                                </a>
                                <a href="<?php echo $value['linkLinkedin']; ?>" target="_blank" class="text-decoration-none">
                                    <i class="fab fa-linkedin me-1"></i><?php echo $value['linkLinkedin']; ?>
                                </a>
                            </div>
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


<?php include("../../templates/footer.php"); ?>
