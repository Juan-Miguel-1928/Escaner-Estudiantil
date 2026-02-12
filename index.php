<?php include("mostrar.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Alumno UPQROO</title>
</head>
<body>
    <h1>Alumno UPQROO</h1>
    <p><strong>Nombre completo:</strong> <?php echo "$nombre $apellidoPaterno $apellidoMaterno"; ?></p>
    <p><strong>Matrícula:</strong> <?php echo $matricula; ?></p>
    <p><strong>Grupo:</strong> <?php echo $grupo; ?></p>
    <p><strong>Correo:</strong> <?php echo $correo; ?></p>
    <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
    <p><strong>Foto:</strong> <?php echo $foto; ?></p>
    
</body>
</html>
