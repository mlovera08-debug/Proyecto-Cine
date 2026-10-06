<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Login - CinePlus</title>
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
      max-width: 400px;
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
    a {
      color: #ffcc00;
    }
  </style>
</head>
<body>
   <?php
      include_once("Conexion.php");
      $conn = CConexion::ConexionBD();
    ?>

  <div class="header">🎥 CinePlus - Inicio de Sesión 🎬</div>
  <div class="container">
    <h2>Inicio de Sesión</h2>
      <?php if (isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>
       <p style="color:#0f0;">✅ Registro exitoso. Ahora puedes iniciar sesión.</p>
      <?php endif; ?>
      <?php if (isset($_GET['msg'])): ?>
        <p style="color:#f33;">
          <?php
            if ($_GET['msg'] === 'nouser') echo "❌ Usuario no registrado";
            else if ($_GET['msg'] === 'wrongpass') echo "❌ Contraseña incorrecta";
            else if ($_GET['msg'] === 'err') echo "❌ Error en el servidor";
          ?>
        </p>
      <?php endif; ?>
  <form id="loginForm" action="procesar_login.php" method="POST">
        <label>Usuario:
          <input type="text" name="usuario" required />
        </label>
        <label>Contraseña:
          <input type="password" name="clave" required />
        </label>
        <button type="submit">Iniciar Sesión</button>
  </form>
    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
  </div>
</body>
</html>