<?php
include 'con_db.php';


$sqlCarreras = "SELECT id_carrera, nombre_carrera FROM carrera";
$resultCarreras = mysqli_query($conex, $sqlCarreras);

$sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupo";
$resultGrupos = mysqli_query($conex, $sqlGrupos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registro de Alumno</title>
</head>
<body>

<form action="registrarAlumno.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="nombre" required placeholder="Nombres" />
    <input type="text" name="apellido_paterno" required placeholder="Apellido paterno" />
    <input type="text" name="apellido_materno" required placeholder="Apellido materno" />
    <input type="date" name="fecha_nacimiento" required placeholder="Fecha de nacimiento" />
    <input type="text" name="matricula" required placeholder="Matricula" />
    <input type="email" name="correo" required placeholder="Correo" />
    <input type="tel" name="telefono" required placeholder="Telefono" />
    <input type="text" name="genero" required placeholder="Genero" />
    <input type="text" name="tipo_sangre" required placeholder="Tipo de sangre" />

    <label for="id_carrera">Carrera:</label>
    <select name="id_carrera" id="id_carrera" required>
        <option value="">Selecciona una carrera</option>
        <?php while($row = mysqli_fetch_assoc($resultCarreras)) { ?>
            <option value="<?= $row['id_carrera'] ?>"><?= htmlspecialchars($row['nombre_carrera']) ?></option>
        <?php } ?>
    </select>

    <label for="id_grupo">Grupo:</label>
    <select name="id_grupo" id="id_grupo" required>
        <option value="">Selecciona un grupo</option>
        <?php while($row = mysqli_fetch_assoc($resultGrupos)) { ?>
            <option value="<?= $row['id_grupo'] ?>"><?= htmlspecialchars($row['nombre_grupo']) ?></option>
        <?php } ?>
    </select>

    <input type="file" name="foto" required />
    <button type="submit">Registrar</button>
</form>

</body>
</html>
