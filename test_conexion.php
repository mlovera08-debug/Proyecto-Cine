<?php
include_once "Conexion.php";

$conn = CConexion::ConexionBD();

if ($conn) {
    echo "✅ Conexión exitosa a la base de datos CinePlus";
} else {
    echo "❌ Error al conectar a la base de datos";
}
?>
