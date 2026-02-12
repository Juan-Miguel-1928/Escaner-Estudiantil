 <?php 
require_once 'phpqrcode/qrlib.php';
include 'con_db.php';

$id_estudiante = isset($_GET['id_estudiante']) ? (int)$_GET['id_estudiante'] : 0;

if ($id_estudiante <= 0) {
    die("ID de estudiante no válido.");
}

$ip_local = "192.168.56.1";
// Cambia la URL para que apunte a apiQR.php
$contenido = "http://$ip_local/prueba/api_estudiante.php?id_estudiante=" . $id_estudiante;

$sqlCheck = "SELECT id_qr FROM qr WHERE id_estudiante = ?";
$stmtCheck = mysqli_prepare($conex, $sqlCheck);
mysqli_stmt_bind_param($stmtCheck, "i", $id_estudiante);
mysqli_stmt_execute($stmtCheck);
mysqli_stmt_store_result($stmtCheck);

if (mysqli_stmt_num_rows($stmtCheck) == 0) {
    mysqli_stmt_close($stmtCheck);

    $sqlInsert = "INSERT INTO qr (id_estudiante, codigo_qr) VALUES (?, ?)";
    $stmtInsert = mysqli_prepare($conex, $sqlInsert);
    mysqli_stmt_bind_param($stmtInsert, "is", $id_estudiante, $contenido);
    mysqli_stmt_execute($stmtInsert);
    mysqli_stmt_close($stmtInsert);
} else {
    mysqli_stmt_close($stmtCheck);
}

QRcode::png($contenido, false, QR_ECLEVEL_H, 6);
?>
api_esutidante.php: <?php
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