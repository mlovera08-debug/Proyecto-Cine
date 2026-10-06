<?php
session_start();
require_once("conexion.php");

$conn = CConexion::ConexionBD();
$id = $_SESSION['usuario_id'] ?? null;

if ($id) {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: index.php?msg=deleted");
        exit;
    } else {
        header("Location: mi_cuenta.php?msg=error");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
