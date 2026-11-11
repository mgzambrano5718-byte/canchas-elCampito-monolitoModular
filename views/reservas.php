<?php
require_once("../config/Conexion.php");
require_once("../models/Reserva.php");

$db = new Conexion();
$conexion = $db->getConexion();
$reservaModel = new Reserva($conexion);

$mensaje = "";
$usuarios = $reservaModel->obtenerUsuarios();
$canchas = $reservaModel->obtenerCanchas();
$horarios = $reservaModel->obtenerHorarios();

if (isset($_POST["guardar"])) {
    $usuario = $_POST["usuario"];
    $cancha = $_POST["cancha"];
    $fecha = $_POST["fecha"];
    $horario = $_POST["horario"];
    
    $mensaje = $reservaModel->registrarReserva($usuario, $cancha, $fecha, $horario);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Reserva</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
<div class="main"><div class="contenedor">
    <h1>Registrar reserva</h1>
    <?php if ($mensaje != "") { ?>
        <div class="alerta"><?= htmlspecialchars($mensaje) ?></div>
    <?php } ?>
    <form method="POST">
        <label>Usuario:</label>
        <select name="usuario" required>
            <option value="">Seleccione un usuario</option>
            <?php while ($fila = $usuarios->fetch_assoc()) { ?>
                <option value="<?= $fila["id_usuario"] ?>"><?= htmlspecialchars($fila["nombres"] . " " . $fila["apellidos"]) ?></option>
            <?php } ?>
        </select>
        <label>Cancha:</label>
        <select name="cancha" required>
            <option value="">Seleccione una cancha</option>
            <?php while ($fila = $canchas->fetch_assoc()) { ?>
                <option value="<?= $fila["id_cancha"] ?>"><?= htmlspecialchars($fila["nombre"]) ?></option>
            <?php } ?>
        </select>
        <label>Fecha:</label>
        <input type="date" name="fecha" required>
        <label>Horario:</label>
        <select name="horario" required>
            <option value="">Seleccione un horario</option>
            <?php while ($fila = $horarios->fetch_assoc()) { ?>
                <option value="<?= $fila["id_horario"] ?>"><?= $fila["inicio"] ?> - <?= $fila["fin"] ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="guardar">Registrar reserva</button>
    </form>
    <a href="../index.php">Volver al menú principal</a>
</div></div>
</body>
</html>