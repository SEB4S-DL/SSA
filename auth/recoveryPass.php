<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/recoveryPass.css">
  <title>Recuperación de Contraseña</title>
</head>
<body>
  <div class="container">
      <a href="../auth/login.php">Volver</a>
    <h1>Recuperación De Contraseña</h1>
    <form action="../functions/recoveryPass.php" method="POST">
      <label for="email">Correo Institucional:</label>
      <input type="email" name="email" id="email" placeholder="ejemplo@soy.sena.edu.co" required>
      <button type="submit">Enviar</button>
    </form>
  </div>
</body>
</html>
