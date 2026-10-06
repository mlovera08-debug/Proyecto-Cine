<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro - CinePlus</title>
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
    .msg {
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="header">🎥 CinePlus - Registro de Usuario 🎬</div>
  <div class="container">
    <h2>Registro de Usuario</h2>

    <form id="registerForm" action="procesar_registro.php" method="POST">
      <label>Nombre:
        <input type="text" name="nombre" required />
      </label>
      <label>Apellido:
        <input type="text" name="apellido" required />
      </label>
      <label>Nombre de Usuario:
        <input type="text" name="usuario" required />
      </label>
      <label>Contraseña:
        <input type="password" name="clave" required />
      </label>
      <label>Fecha de Nacimiento:
        <input type="date" name="fecha_nacimiento" required />
      </label>
      <label>Número Telefónico (10 dígitos):
        <input type="tel" name="telefono" required pattern="\d{10}" />
      </label>
      <button type="submit">Registrarse</button>
    </form>

    <!-- Mostrar mensajes -->
    <?php 
    $msg = htmlspecialchars($_GET["msg"] ?? ''); 
    if ($msg): ?>
      <div class="msg" style="color:<?= $msg==='ok' ? '#0f0' : '#f33' ?>">
        <?php
          switch($msg){
            case 'ok':      echo '✅ Usuario registrado correctamente'; 
            break;
            case 'exists':  echo '⚠️ El usuario ya existe'; break;
            case 'empty':   echo '❌ Debes completar todos los campos'; break;
            case 'telerr':  echo '❌ Número telefónico inválido (10 dígitos)'; break;
            case 'dateerr': echo '❌ Fecha de nacimiento inválida'; break;
            default:        echo '❌ Error al guardar los datos'; break;
          }
        ?>
      </div>
    <?php endif; ?>
  </div>
  
</body>
</html>
