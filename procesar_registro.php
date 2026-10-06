<?php
include_once "Conexion.php";
$conn = CConexion::ConexionBD();

if (!$conn) {
    header("Location: registro.php?msg=err");
    exit;
}

// Obtener y limpiar datos
$nombre          = trim($_POST['nombre']          ?? '');
$apellido        = trim($_POST['apellido']        ?? '');
$usuario         = trim($_POST['usuario']         ?? '');
$clavePlano      = $_POST['clave']                ?? '';
$fechaNacimiento = $_POST['fecha_nacimiento']     ?? '';
$telefono        = trim($_POST['telefono']        ?? '');

// Validar campos vacíos
if ($nombre==='' || $apellido==='' || $usuario==='' || $clavePlano==='' || $fechaNacimiento==='' || $telefono==='') {
    header("Location: registro.php?msg=empty");
    exit;
}

// Validar formato del teléfono (10 dígitos)
if (!preg_match('/^\d{10}$/', $telefono)) {
    header("Location: registro.php?msg=telerr");
    exit;
}

// Validar fecha
if (!DateTime::createFromFormat('Y-m-d', $fechaNacimiento)) {
    header("Location: registro.php?msg=dateerr");
    exit;
}

// Encriptar la contraseña
$claveHash = password_hash($clavePlano, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO usuarios
            (nombre, apellido, usuario, clave, fecha_nacimiento, telefono)
            VALUES (:nombre, :apellido, :usuario, :clave, :fecha, :telefono)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre',   $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':usuario',  $usuario);
    $stmt->bindParam(':clave',    $claveHash);
    $stmt->bindParam(':fecha',    $fechaNacimiento);
    $stmt->bindParam(':telefono', $telefono);

    $stmt->execute();

    // Redirigir con mensaje de éxito
    header("Location: registro.php?msg=ok");

} catch (PDOException $e) {
    // Si el usuario ya existe (clave duplicada en la BD)
    if ($e->getCode() == 23000) {
        header("Location: registro.php?msg=exists");
    } else {
        error_log("Error al insertar usuario: ".$e->getMessage());
        header("Location: registro.php?msg=err");
    }
}
header("Location: index.php?msg=ok");
exit;
?>
