<?php include("templates/header.php"); 

?>

<br/>
<div class="row align-items-md-stretch">

    <div class="col-md-16">
        <div
            class="h-100 p-5 border rounded-3"
        >
            <h2>Hola <?php echo $_SESSION['usuario']; ?></h2>
            <p>
                Aca podes administrar las cosas
            </p>
            <button
                class="btn btn-outline-primary"
                type="button"
            >
                iniciar ahora
            </button>
        </div>
    </div>

</div>



<?php include("templates/footer.php"); ?>