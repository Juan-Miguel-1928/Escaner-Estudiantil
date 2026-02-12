<?php
include 'con_db.php'; 

$id_estudiante = isset($_GET['id_estudiante']) ? (int)$_GET['id_estudiante'] : 0;

if ($id_estudiante > 0) {
    date_default_timezone_set('America/Mexico_City'); 

   
    $fecha_actual = date("Y-m-d");      
    $hora_entrada = date("H:i:s");       

   
    $sql = "INSERT INTO registroAcceso (id_estudiante, fecha, hora_entrada, hora_salida) VALUES (?, ?, ?, NULL)";
    $stmt = mysqli_prepare($conex, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $id_estudiante, $fecha_actual, $hora_entrada);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    header("Location: registro.php?id_estudiante=$id_estudiante");
    exit;
} else {
    echo "ID de estudiante inválido.";
}
?>
