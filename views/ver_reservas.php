<?php
require_once("../config/Conexion.php");
require_once("../models/Reserva.php");

$db = new Conexion();
$conexion = $db->getConexion();
$reservaModel = new Reserva($conexion);

$reservas = $reservaModel->obtenerListadoReservas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reservas</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
<div class="main"><div class="contenedor" style="max-width: 800px;">
    <h1>Listado de reservas</h1>
    <table>
        <tr>
            <th>N.º</th>
            <th>Cédula</th>
            <th>Usuario</th>
            <th>Cancha</th>
            <th>Fecha</th>
            <th>Inicio</th>
            <th>Fin</th>
        </tr>
        <?php while ($fila = $reservas->fetch_assoc()) { ?>
            <tr>
                <td><?= $fila["id_reserva"] ?></td>
                <td><?= htmlspecialchars($fila["identificacion"]) ?></td>
                <td><?= htmlspecialchars($fila["nombres"] . " " . $fila["apellidos"]) ?></td>
                <td><?= htmlspecialchars($fila["cancha"]) ?></td>
                <td><?= $fila["fecha"] ?></td>
                <td><?= $fila["inicio"] ?></td>
                <td><?= $fila["fin"] ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="../index.php">Volver al menú principal</a>
</div></div>
</body>
</html>