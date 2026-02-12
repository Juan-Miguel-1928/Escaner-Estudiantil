<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Scannerqr";

$conexion = new mysqli($host, $user, $password, $dbname);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (!isset($id_estudiante)) {
    $id_estudiante = isset($_GET['id_estudiante']) ? (int) $_GET['id_estudiante'] : 1;
}


$sql = "
SELECT e.*, c.nombre_carrera, g.nombre_grupo
FROM estudiantes e
LEFT JOIN carrera c ON e.id_carrera = c.id_carrera
LEFT JOIN grupo g ON e.id_grupo = g.id_grupo
WHERE e.id_estudiante = $id_estudiante
";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nombre = htmlspecialchars($fila['nombre']);
    $apellidoPaterno = htmlspecialchars($fila['apellido_paterno']);
    $apellidoMaterno = htmlspecialchars($fila['apellido_materno']);
    $matricula = htmlspecialchars($fila['matricula']);
    $correo = htmlspecialchars($fila['correo']);
    $telefono = htmlspecialchars($fila['telefono']);
    $tipoSangre = htmlspecialchars($fila['tipo_sangre']);
    $carrera = htmlspecialchars($fila['nombre_carrera']);
    $grupo = htmlspecialchars($fila['nombre_grupo']);

    
    $foto_tipo = $fila['foto_tipo']; 
    $foto_data = base64_encode($fila['foto']);

   
    $sqlQR = "SELECT codigo_qr FROM qr WHERE id_estudiante = ?";
    $stmtQR = $conexion->prepare($sqlQR);
    $stmtQR->bind_param("i", $id_estudiante);
    $stmtQR->execute();
    $stmtQR->bind_result($codigo_qr);
    $stmtQR->fetch();
    $stmtQR->close();

} else {
    die("Alumno no encontrado.");
}

$conexion->close();
?>
