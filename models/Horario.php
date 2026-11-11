<?php
class Horario {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function obtenerCanchas() {
        return $this->conexion->query("SELECT * FROM canchas");
    }

    public function consultarDisponibilidad($cancha, $fecha) {
        $sql = $this->conexion->prepare(
            "SELECT h.inicio, h.fin, r.id_reserva AS reserva
             FROM horarios h
             LEFT JOIN reservas r
             ON h.id_horario = r.id_horario
             AND r.id_cancha = ?
             AND r.fecha = ?
             ORDER BY h.inicio"
        );
        $sql->bind_param("is", $cancha, $fecha);
        $sql->execute();
        return $sql->get_result();
    }
}
?>