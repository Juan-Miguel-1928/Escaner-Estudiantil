<?php
include 'con_db.php';
require_once 'phpqrcode/qrlib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $matricula = $_POST['matricula'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $genero = $_POST['genero'];
    $tipo_sangre = $_POST['tipo_sangre'];

    $id_carrera = isset($_POST['id_carrera']) ? (int)$_POST['id_carrera'] : 0;
    $id_grupo = isset($_POST['id_grupo']) ? (int)$_POST['id_grupo'] : 0;

    if ($id_carrera <= 0 || $id_grupo <= 0) {
        die("Carrera o grupo no válido.");
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_tipo = $_FILES['foto']['type']; 
        $foto = file_get_contents($foto_tmp); 
    } else {
        die("Error al cargar la foto.");
    }

    $sql = "INSERT INTO estudiantes 
        (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, matricula, correo, telefono, genero, tipo_sangre, id_carrera, id_grupo, foto_tipo, foto)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conex, $sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . mysqli_error($conex));
    }

  mysqli_stmt_bind_param($stmt, "sssssssssiisb", 
    $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $matricula, $correo, $telefono, $genero, $tipo_sangre, $id_carrera, $id_grupo, $foto_tipo, $foto);

mysqli_stmt_send_long_data($stmt, 12, $foto);

   if (mysqli_stmt_execute($stmt)) {
    $id_estudiante = mysqli_insert_id($conex);
    mysqli_stmt_close($stmt);

    $sqlCheckQR = "SELECT id_qr FROM qr WHERE id_estudiante = ?";
    $stmtCheck = mysqli_prepare($conex, $sqlCheckQR);
    mysqli_stmt_bind_param($stmtCheck, "i", $id_estudiante);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) == 0) {
        $ip_local = "192.168.56.1";

        // Aquí cambias la URL para que apunte a apiQR.php
        $contenido_qr = "http://$ip_local/prueba/api_estudiante.php?id_estudiante=" . $id_estudiante;

        $qr_dir = "imagenes/qrs/";
        if (!file_exists($qr_dir)) {
            mkdir($qr_dir, 0755, true);
        }
        $qr_path = $qr_dir . $id_estudiante . ".png";
        QRcode::png($contenido_qr, $qr_path, QR_ECLEVEL_H, 5);

        $contenidoQR = base64_encode(file_get_contents($qr_path));

        $sqlQR = "INSERT INTO qr (id_estudiante, codigo_qr) VALUES (?, ?)";
        $stmtQR = mysqli_prepare($conex, $sqlQR);
        mysqli_stmt_bind_param($stmtQR, "is", $id_estudiante, $contenidoQR);
        mysqli_stmt_execute($stmtQR);
        mysqli_stmt_close($stmtQR);
    }
    mysqli_stmt_close($stmtCheck);

    header("Location: generarqr.php?id_estudiante=$id_estudiante");
    exit;
} else {
    echo "Error al registrar al estudiante: " . mysqli_error($conex);
}
} else {
    echo "Método no permitido.";
}
?>