<?php
class Conexion {
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $clave = '';
    private $basedatos = 'reserva_canchas';
    public $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->servidor, $this->usuario, $this->clave, $this->basedatos);
        
        if ($this->conexion->connect_error) {
            die('Error en la conexión a la BD: ' . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>
