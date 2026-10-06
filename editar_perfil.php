<?php
session_start();
require_once("Conexion.php");

$conn = CConexion::ConexionBD();
$id_usuario = $_SESSION['id']; 

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Editar Perfil</h2>
<form action="procesar_edicion.php" method="POST">
  <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
  
  Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br>
  Email: <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br>
  Contraseña: <input type="password" name="contrasena" placeholder="Dejar en blanco para no cambiar"><br>

  <button type="submit">Guardar cambios</button>
</form>
