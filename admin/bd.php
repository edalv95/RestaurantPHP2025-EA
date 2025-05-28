<?php

$servidor = "localhost";
$baseDatos = "restaurante";
$usuario = "root";
$password = "";

try{
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
  
   
   
    /* $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $conexion->prepare("SELECT * FROM banners");
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch all results
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Display the results
    foreach ($resultados as $fila) {
        echo "ID: " . $fila['id'] . "<br>";
        echo "Titulo: " . $fila['titulo'] . "<br>";
        echo "Descripcion: " . $fila['descripcion'] . "<br>";
        echo "Link: " . $fila['link'] . "<br>";
        echo "<hr>";
    }*/

}catch(Exception $e){
    echo "Error: " . $e->getMessage();
}
?>