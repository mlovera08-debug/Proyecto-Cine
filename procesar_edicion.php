<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

$id               = $_POST['id'];
$nombre           = $_POST['nombre'];
$apellido         = $_POST['apellido'];
$usuario          = $_POST['usuario'];
$clave            = $_POST['clave'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$telefono         = $_POST['telefono'];

if (!empty($clave)) {
    $clave = password_hash($clave, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios 
            SET nombre = :nombre, apellido = :apellido, usuario = :usuario, 
                clave = :clave, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono 
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':clave', $clave);
} else {
    $sql = "UPDATE usuarios 
            SET nombre = :nombre, apellido = :apellido, usuario = :usuario, 
                fecha_nacimiento = :fecha_nacimiento, telefono = :telefono 
            WHERE id = :id";
    $stmt = $conn->prepare($sql);
}

$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$stmt->bindParam(':telefono', $telefono);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: mi_cuenta.php?msg=ok");
    exit;
} else {
    header("Location: mi_cuenta.php?msg=error");
}
