<?php
include("con_db.php");

if (isset($_GET['id_estudiante'])) {
    $id = (int) $_GET['id_estudiante'];

    $sql = "SELECT foto_tipo, foto FROM estudiantes WHERE id_estudiante = $id LIMIT 1";
    $resultado = mysqli_query($conex, $sql);

    if ($row = mysqli_fetch_assoc($resultado)) {
        header("Content-type: " . $row['foto_tipo']);
        echo $row['foto'];
    } else {
        echo "Imagen no encontrada";
    }
} else {
    echo "ID no especificado";
}
?>
