<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "Scannerqr";

$conex = mysqli_connect($host, $user, $password, $dbname);

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
