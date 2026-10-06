<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
require_once("conexion.php");

$conn = CConexion::ConexionBD();
if (!$conn) {
    die("Error al conectar a la base de datos.");
}

$id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Mi Cuenta - CinePlus</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1c1c1c;
      color: #f5f5f5;
      text-align: center;
      margin: 0;
      padding: 0;
    }
    h2 {
      color: #ffcc00;
      margin-top: 20px;
    }
    form {
      background-color: #333;
      padding: 20px;
      border-radius: 10px;
      display: inline-block;
      margin-top: 20px;
      width: 100%;
      max-width: 500px;
    }
    label {
      display: block;
      margin: 10px 0;
      text-align: left;
    }
    input {
      padding: 10px;
      border: none;
      border-radius: 5px;
      width: 100%;
      box-sizing: border-box;
      background-color: #222;
      color: #fff;
    }
    button {
      background-color: #ffcc00;
      color: #1c1c1c;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
    }
    button:hover {
      background-color: #e6b800;
    }
    .container {
      margin: 0 auto;
      padding: 20px;
    }
    .header {
      background-color: #000;
      padding: 15px;
      color: #ffcc00;
      font-size: 24px;
    }
    .danger {
      background-color: #cc0000;
      color: #fff;
      margin-top: 20px;
    }
    .danger:hover {
      background-color: #a80000;
    }
  </style>
</head>
<body>
  <div class="header">🎥 CinePlus - Mi Cuenta 🎬</div>
  <div class="container">
    <h2>Editar Perfil</h2>

    <form action="procesar_edicion.php" method="POST">
      <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

      <label>Nombre:
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required />
      </label>

      <label>Apellido:
        <input type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required />
      </label>

      <label>Nombre de Usuario:
        <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required />
      </label>

      <label>Contraseña (dejar en blanco si no deseas cambiarla):
        <input type="password" name="clave" />
      </label>

      <label>Fecha de Nacimiento:
        <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>" required />
      </label>

      <label>Número Telefónico:
        <input type="tel" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" required />
      </label>

      <button type="submit">Guardar Cambios</button>
    </form>

    <form action="eliminar_perfil.php" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar tu cuenta?');">
      <button class="danger" type="submit">Eliminar Cuenta</button>
    </form>
  </div>
</body>
</html>
