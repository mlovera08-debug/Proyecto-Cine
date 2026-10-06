<?php
class CConexion {
    public static function ConexionBD() {
        // Datos de conexión: CAMBIA por los de tu entorno
        $host = "localhost";        // o 127.0.0.1
        $dbname = "cineplus";       // nombre de tu BD
        $usuario = "root";          // usuario de MySQL
        $clave = "";                // contraseña de MySQL (si tienes)

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $clave);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            return false;
        }
    }
}
?>
