<?php
class Usuario {
    private $conexion;

    // El constructor recibe la conexión a la base de datos
    public function __construct($db) {
        $this->conexion = $db;
    }

    // Método POO para registrar al usuario
    public function registrar($cedula, $nombres, $apellidos, $correo, $telefono) {
        // Verificamos si existe
        $usuario_bd = $this->conexion->prepare('SELECT * FROM usuarios WHERE identificacion = ?');
        $usuario_bd->bind_param('s', $cedula); 
        $usuario_bd->execute(); 
        $usuario_bd->store_result(); 
        
        if($usuario_bd->num_rows > 0){ 
            return 'El usuario con cédula '.$cedula.' ya está registrado.';
        } else {
            // Si no existe, lo insertamos
            $usuario_registro = $this->conexion->prepare('INSERT INTO usuarios(identificacion, nombres, apellidos, correo, telefono) VALUES(?,?,?,?,?)');
            $usuario_registro->bind_param('sssss', $cedula, $nombres, $apellidos, $correo, $telefono);            
            try {
                if($usuario_registro->execute()){
                    return 'Usuario registrado satisfactoriamente';
                }
            } catch(mysqli_sql_exception $e) {
                if($e->getCode() == 1062){
                    return 'El usuario con cédula '.$cedula.' ya está registrado.';
                } else {
                    return 'Error al registrar usuario';
                }
            }
        }
    }
}
?>