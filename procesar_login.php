<?php
session_start();
include_once "Conexion.php";
$conn = CConexion::ConexionBD();

if (!$conn) {
    die("Error en la conexión a la base de datos");
}

$usuario = trim($_POST['usuario'] ?? '');
$clavePlano = $_POST['clave'] ?? '';

if ($usuario === '' || $clavePlano === '') {
    header("Location: index.php?msg=err");
    exit;
}

try {
    $sql = "SELECT id, nombre, apellido, usuario, clave FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Usuario no encontrado
        header("Location: index.php?msg=nouser");
        exit;
    }

    // Verificar contraseña con password_verify
    if (password_verify($clavePlano, $user['clave'])) {
        // Login correcto: guardar sesión
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        $_SESSION['usuario_apellido'] = $user['apellido'];
        $_SESSION['usuario_usuario'] = $user['usuario'];

        // Redirigir a menú principal o donde quieras
        header("Location: menu.php");
        exit;
    } else {
        // Contraseña incorrecta
        header("Location: index.php?msg=wrongpass");
        exit;
    }

} catch (PDOException $e) {
    error_log("Error en login: " . $e->getMessage());
    header("Location: index.php?msg=err");
    exit;
}
?>