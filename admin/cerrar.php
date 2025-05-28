<?php 

$url_base="http://localhost/restaurant/admin";

session_start();
session_destroy();
header("Location:$url_base/login.php");
?>