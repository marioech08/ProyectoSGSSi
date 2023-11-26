

<?php if (!isset($_SESSION['csrf_token'])) {
    session_start();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio - Plataforma de Asignaturas</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container">
      <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="post">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required />

          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" required />

          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit">Iniciar Sesión</button>
        </form>
      </div>

      <div class="register-container">
        <h2>¿Nuevo aquí?</h2>
        <a href="registrarse.php">Registrarse</a>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
