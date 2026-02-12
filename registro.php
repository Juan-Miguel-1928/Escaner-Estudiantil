<?php

$id_estudiante = isset($_GET['id_estudiante']) ? (int)$_GET['id_estudiante'] : 0;


if ($id_estudiante <= 0) {
    die("ID de estudiante no válido.");
}


include("mostrar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPQROO - Sistema de Registro Estudiantil</title>
    <link rel="stylesheet" href="registro.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="left-side">
                <div class="header-section">
                    <img src="proyecto.png" width="180" height="70" class="img" />
                    <h1 class="title">BIENVENIDO A LA UPQROO</h1>
                    <p class="subtitle">ESTE ALUMNO PUEDE ACCEDER A LA UNIVERSIDAD</p>
                </div>

                <div class="form-container">
                    <div class="columns-container">
                        <div class="column column-left">
                            <div class="input-group">
                                <i class="fas fa-user input-icon"></i>
                                <h2><?= $nombre ?></h2>
                                <div class="input-underline"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-id-badge input-icon"></i>
                                <h2><?= $apellidoPaterno . " " . $apellidoMaterno ?></h2>
                                <div class="input-underline"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-graduation-cap input-icon"></i>
                                <h2><?= $carrera ?></h2>
                                <div class="input-underline"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-id-card input-icon"></i>
                                <h2><?= $matricula ?></h2>
                                <div class="input-underline"></div>
                            </div>
                        </div>

                        <div class="column column-right">
                            <div class="input-group">
                                <i class="fas fa-users input-icon"></i>
                                <h2><?= $grupo ?></h2>
                                <div class="input-underline"></div>
                            </div>
                           
                            <div class="input-group">
                                <i class="fas fa-phone input-icon"></i>
                                <h2><?= $telefono ?></h2>
                                <div class="input-underline"></div>
                            </div>
                            <div class="input-group">
                                <i class="fas fa-tint input-icon"></i>
                                <h2><?= $tipoSangre ?></h2>
                                <div class="input-underline"></div>
                            </div>
                        </div>
                    </div>

                    <button class="register-btn" onclick="registrarEstudiante()">
                        <i class="fas fa-check-circle"></i>REGISTRADO EN LA UPQROO
                    </button>
                </div>

                <div class="status-indicator">
                    <div class="status-light"></div>
                    <span class="status-text">Sistema conectado</span>
                </div>
            </div>

            <div class="right-side">
               <img src="fotoAlumno.php?id_estudiante=<?= $id_estudiante ?>" width="425" alt="Foto del alumno" />

            </div>
        </div>
    </div>
</body>
</html>
