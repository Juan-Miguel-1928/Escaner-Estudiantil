<?php
include 'conexion.php'; 

$nombre = $_POST['nombre'];
$ap_paterno = $_POST['apellido_paterno'];
$ap_materno = $_POST['apellido_materno'];
$matricula = $_POST['matricula'];

$sql = "INSERT INTO estudiantes (nombre, apellido_paterno, apellido_materno, matricula)
        VALUES ('$nombre', '$ap_paterno', '$ap_materno', '$matricula')";
mysqli_query($conn, $sql);

$id = mysqli_insert_id($conn);

$ip_local = "192.168.56.1";

// Cambiar la URL para que apunte a apiQR.php
$url = "http://$ip_local/prueba/api_estudiante.php?id_estudiante=$id";

include 'phpqrcode/qrlib.php'; 
$qrPath = "imagenes/qrs/$id.png";
QRcode::png($url, $qrPath, QR_ECLEVEL_H, 5);

header("Location: accesoEstudiante.php?id_estudiante=$id");
exit;
?>