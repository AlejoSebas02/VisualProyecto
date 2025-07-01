<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
  <ul>
    <li><a href="/Cuarto/index.php?action=Inicio">Inicio</a></li>
    <li><a href="/Cuarto/index.php?action=Nosotros">Nosotros</a></li>
    <li><a href="/Cuarto/index.php?action=Servicios">Servicios</a></li>
    <li><a href="/Cuarto/index.php?action=Contactanos">Contacto</a></li>

    <?php if (isset($_SESSION['usuario'])): ?>
      <li><a href="/Cuarto/Models/logout.php">Cerrar Sesión</a></li>
    <?php endif; ?>
    <?php if (isset($_SESSION['usuario'])): ?>
      <li style="float:right; list-style:none; margin-left:2rem;">
        <span class="bienvenido-usuario">
          Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </span>
      </li>
    <?php endif; ?>
  </ul>
</nav>