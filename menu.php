<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

require_once 'Conexion.php';

$pdo = CConexion::ConexionBD();
if (!$pdo) {
    die("Error al conectar a la base de datos.");
}

try {
    // Ordenar por id descendente para mostrar las últimas primero
    $sql = "SELECT * FROM peliculas ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>CinePlus – Menú principal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1c1c1c;
      color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    /* ===== Encabezado ===== */
    header.cineplus-header {
      background: #000;
      color: #ffcc00;
      font-size: 24px;
      padding: 15px;
      text-align: center;
    }

    /* ===== Barra de navegación ===== */
    nav.cineplus-nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      background: #000;
    }

    nav.cineplus-nav li {
      position: relative;
      margin: 0 8px;
    }

    nav.cineplus-nav a {
      color: #ffcc00;
      text-decoration: none;
      padding: 10px 14px;
      display: block;
      border-radius: 6px;
    }

    nav.cineplus-nav a:hover {
      background: #333;
    }

    /* ===== Submenú desplegable ===== */
    .dropdown:hover .submenu {
      display: block;
    }

    ul.submenu {
      display: none;
      position: absolute;
      left: 0;
      top: 100%;
      background: #000;
      border-radius: 6px;
      min-width: 160px;
      z-index: 1000;
      padding: 0;
    }

    ul.submenu li {
      margin: 0;
    }

    ul.submenu a {
      padding: 8px 12px;
      white-space: nowrap;
    }

    /* ===== Películas ===== */
    main {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
    }

    h2 {
      color: #ffcc00;
      text-align: center;
    }

    .peliculas {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .pelicula-card {
      background: #333;
      border-radius: 10px;
      width: 250px;
      padding: 15px;
      box-sizing: border-box;
      text-align: center;
    }
    .pelicula-card img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .pelicula-card h3 {
      margin: 10px 0 5px;
      color: #ffcc00;
    }
    .pelicula-card p {
      font-size: 14px;
      line-height: 1.3;
    }
    .pelicula-info {
      margin-top: 8px;
      font-size: 13px;
      color: #ccc;
    }
  </style>
</head>
<body>

  <!-- Encabezado -->
  <header class="cineplus-header">
    🎬 Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> <?php echo htmlspecialchars($_SESSION['usuario_apellido']); ?> 🎬
  </header>

  <!-- Barra de navegación -->
  <nav class="cineplus-nav">
    <ul>
      <li><a href="menu.php">Inicio</a></li>
      <li class="dropdown">
        <a href="#">Mi Cuenta ▾</a>
        <ul class="submenu">
          <li><a href="mi_cuenta.php">Editar Perfil</a></li>
          <li><a href="eliminar_perfil.php" onclick="return confirm('¿Seguro que deseas eliminar tu cuenta?');">Eliminar Perfil</a></li>
        </ul>
      </li>
      <li><a href="index.php">Cerrar Sesión</a></li>
    </ul>
  </nav>

  <!-- Contenido principal -->
  <main>
    <h2>Cartelera Destacada</h2>
    <div class="peliculas">
      <?php if (count($peliculas) === 0): ?>
        <p>No hay películas para mostrar.</p>
      <?php else: ?>
        <?php foreach ($peliculas as $pelicula): ?>
          <div class="pelicula-card">
            <?php if (!empty($pelicula['imagen'])): ?>
              <img src="<?= htmlspecialchars($pelicula['imagen']) ?>" alt="<?= htmlspecialchars($pelicula['titulo']) ?>" />
            <?php else: ?>
              <img src="imagenes/default.jpg" alt="Imagen no disponible" />
            <?php endif; ?>
            <h3><?= htmlspecialchars($pelicula['titulo']) ?></h3>
            <p><?= nl2br(htmlspecialchars($pelicula['descripcion'] ?: 'Sin descripción')) ?></p>
            <div class="pelicula-info">
              <span><strong>Género:</strong> <?= htmlspecialchars($pelicula['genero'] ?: 'N/A') ?></span><br />
              <span><strong>Año:</strong> <?= htmlspecialchars($pelicula['anio'] ?: 'N/A') ?></span><br />
              <span><strong>Duración:</strong> <?= htmlspecialchars($pelicula['duracion'] ? $pelicula['duracion'] . ' min' : 'N/A') ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

</body>
</html>
