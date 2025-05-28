<?php 

include("../../templates/header.php"); 
include("../../bd.php");

//Traer todos los registros
$sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios");
$sentencia->execute();
$lista_usuarios = $sentencia->fetchall(PDO::FETCH_ASSOC);

//Borrar por txtID
if(isset($_GET['txtID'])) {
    $txtID = $_GET['txtID'];
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE ID = :ID");
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
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Password</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                    <?php foreach($lista_usuarios as $key => $value){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $value['ID']; ?></td>
                        <td><?php echo $value['nombreusuario']; ?></td>
                        <td>*********</td>
                        <td><?php echo $value['correo']; ?></td>
                        <td><?php
                            if ($value['Rol'] == '1'){
                                echo "Administrador";
                            } else {
                                echo "Usuario";
                            } ?>
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
