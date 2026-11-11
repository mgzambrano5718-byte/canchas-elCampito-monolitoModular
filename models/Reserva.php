<?php
class Reserva {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function obtenerUsuarios() {
        return $this->conexion->query("SELECT * FROM usuarios");
    }

    public function obtenerCanchas() {
        return $this->conexion->query("SELECT * FROM canchas");
    }

    public function obtenerHorarios() {
        return $this->conexion->query("SELECT * FROM horarios");
    }

    public function registrarReserva($usuario, $cancha, $fecha, $horario) {
        $sql = $this->conexion->prepare("SELECT id_reserva FROM reservas WHERE id_cancha = ? AND fecha = ? AND id_horario = ?");
        $sql->bind_param("isi", $cancha, $fecha, $horario);
        $sql->execute();
        $resultado = $sql->get_result();
        
        if ($resultado->num_rows > 0) {
            return "La cancha ya está reservada en ese horario.";
        } else {
            $sql = $this->conexion->prepare("INSERT INTO reservas (id_usuario, id_cancha, fecha, id_horario) VALUES (?, ?, ?, ?)");
            $sql->bind_param("iisi", $usuario, $cancha, $fecha, $horario);
            try {
                if ($sql->execute()) {
                    return "Reserva registrada correctamente.";
                }
            } catch (mysqli_sql_exception $e) {
                return "No se pudo registrar la reserva.";
            }
        }
    }

    public function obtenerListadoReservas() {
        $sql = "SELECT r.id_reserva, u.identificacion, u.nombres, u.apellidos, c.nombre AS cancha, r.fecha, h.inicio, h.fin 
                FROM reservas r 
                INNER JOIN usuarios u ON r.id_usuario = u.id_usuario 
                INNER JOIN canchas c ON r.id_cancha = c.id_cancha 
                INNER JOIN horarios h ON r.id_horario = h.id_horario 
                ORDER BY r.fecha, h.inicio";
        return $this->conexion->query($sql);
    }
}
?>