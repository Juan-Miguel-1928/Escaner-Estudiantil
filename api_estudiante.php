<?php
include 'con_db.php';

$id_estudiante = isset($_GET['id_estudiante']) ? (int)$_GET['id_estudiante'] : 0;

if ($id_estudiante <= 0) {
    http_response_code(400);
    echo json_encode(["error" => "ID de estudiante no válido"]);
    exit;
}

// Validar que exista el estudiante
$sql = "SELECT id_estudiante FROM estudiantes WHERE id_estudiante = ?";
$stmt = mysqli_prepare($conex, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_estudiante);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Estudiante no encontrado"]);
    exit;
}
mysqli_stmt_close($stmt);

// Redirigir a accesoEstudiante.php para registrar el acceso y mostrar info
header("Location: accesoEstudiante.php?id_estudiante=$id_estudiante");
exit;
?>