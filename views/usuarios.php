<?php
require_once("../config/Conexion.php");
require_once("../models/Usuario.php");

// Instanciamos la conexión y el modelo
$db = new Conexion();
$conexion = $db->getConexion();
$usuarioModel = new Usuario($conexion);

$mensaje = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cedula = trim($_POST['identificacion']);
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    
    if($cedula === '' || $nombres === '' || $apellidos === '' || $correo === '' || $telefono === ''){
        $mensaje = "Todos los campos deben ser obligatorios";
    } else {
        // Llamamos al método POO
        $mensaje = $usuarioModel->registrar($cedula, $nombres, $apellidos, $correo, $telefono);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <!-- Actualizamos la ruta del CSS -->
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
<div class="main">
    <div class="contenedor">
        <div class="encabezado">
            <h3>Registro de Usuarios</h3>
            <p>Complete la información del usuario</p>
        </div>
        <form method="POST">
            <div class="campo">
                <label for="identificacion">Identificación</label>
                <input type="text" id="identificacion" name="identificacion" placeholder="Ingrese su identificación" maxlength="10">
            </div>
            <div class="fila">
                <div class="campo c">
                    <label for="nombres">Nombres</label>
                    <input type="text" id="nombres" name="nombres" placeholder="Nombres">
                </div>
                <div class="campo c">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
                </div>
            </div>
            <div class="campo">
                <label for="correo">Correo electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com">
            </div>
            <div class="campo">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Ingrese su teléfono" maxlength="10">
            </div>
            <button type="submit" class="registrar" name="registrar">Registrar usuario</button>
        </form>
        <?php if($mensaje != ""){ ?>
            <div class="alerta"><?= $mensaje; ?></div>
        <?php } ?>
        <!-- Actualizamos la ruta para volver al index -->
        <a href="../index.php" class="volver">← Volver al menú principal</a>
    </div>
</div>
</body>
</html>