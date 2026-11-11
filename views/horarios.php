<?php
require_once("../config/Conexion.php");
require_once("../models/Horario.php");

$db = new Conexion();
$conexion = $db->getConexion();
$horarioModel = new Horario($conexion);

$cancha = $_GET["cancha"] ?? 0;
$fecha = $_GET["fecha"] ?? date("Y-m-d");
// Llamamos al método POO
$canchas = $horarioModel->obtenerCanchas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Horarios</title>
    <!-- Ruta actualizada -->
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
<div class="main"><div class="contenedor">
    <h1>Consulta de horarios</h1>
    <form method="GET">
        <label>Cancha:</label>
        <select name="cancha" required>
            <option value="">Seleccione una cancha</option>
            <?php while ($fila = $canchas->fetch_assoc()) { ?>
                <option value="<?= $fila["id_cancha"] ?>">
                    <?= htmlspecialchars($fila["nombre"]) ?>
                </option>
            <?php } ?>
        </select>
        <label>Fecha:</label>
        <input type="date" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required>
        <button type="submit">Consultar</button>
    </form>
    
    <?php
    if ($cancha > 0) {
        // Llamamos al método POO
        $horarios = $horarioModel->consultarDisponibilidad($cancha, $fecha);
    ?>
    <h2>Horarios de la cancha</h2>
    <table>
        <tr>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
        </tr>
        <?php while ($fila = $horarios->fetch_assoc()) { ?>
            <tr>
                <td><?= $fila["inicio"] ?></td>
                <td><?= $fila["fin"] ?></td>
                <td>
                    <?php
                    if ($fila["reserva"] == null) {
                        echo "Disponible";
                    } else {
                        echo "Reservado";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php } ?>
    
    <!-- Ruta actualizada -->
    <a href="../index.php">Volver al menú</a>
</div></div>
</body>
</html>