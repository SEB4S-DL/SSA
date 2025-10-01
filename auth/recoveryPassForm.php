<?php
  require "../db/conection.php";

  $token_valido = true;

  $mensaje;

  // Recibir token de la URL
  if (!isset($_GET['token'])) {
    $token_valido = false;
    $mensaje = "Token de recuperación inválido.";
  }
  else{
    $token = $_GET['token'];
    $token_hash = hash("sha256", $token);
  
    // Buscar en DB
    $stmt = $conn->prepare("SELECT id, user_id, expires_at, used FROM password_reset_tokens WHERE token_hash = ?");
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $tokenData = $result->fetch_assoc();
    $stmt->close();
  
    // Validaciones
    if (!$tokenData) {
      $token_valido = false;
      $mensaje = "Token no encontrado.";
    }
  
    if ($tokenData['used']) {
      $token_valido = false;
      $mensaje = "Este enlace ya fue utilizado.";
    }
  
    if (strtotime($tokenData['expires_at']) < time()) {
      $token_valido = false;
      $mensaje = "El enlace ha expirado.";
    }
  }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/recoveryPassForm.css">
  <link rel="icon" href="../assets/img/sena-logo.png">
  <title>Recuperación</title>
</head>
<body>
  <div class="container">
    <?php
      if ($token_valido):
    ?>
    <h1>Recuperación de Contraseña</h1>
    <span id="stateSpan"></span>
    <br>
    <form action="../functions/recoveryPassForm.php" id="passForm" method="POST">
      <label for="idInput">Ingrese la nueva contraseña</label>
      <input type="password" id="idInput" placeholder="Ingrese la nueva contraseña" required>

      <input id="tokenInput" type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

      <label for="idInput2">Confirme la contraseña</label>
      <input type="password" id="idInput2" placeholder="Confirme la nueva contraseña" required>

      <button id="submitButton" type="submit">Enviar</button>
    </form>
    <?php else: ?>
      <h1><?= htmlspecialchars($mensaje) ?><br> Se le redireccionará dentro de 5 segundos.</h1>
      <meta http-equiv="refresh" content="5;URL=../index.php">
    <?php endif; ?>
  </div>

  <script>
    const span = document.getElementById("stateSpan");
    const form = document.getElementById("passForm");
    const states = {
      0: "green",
      1: "red"
    }

    form.addEventListener("submit", (e)=>{
      e.preventDefault();
      const pass1 = document.getElementById("idInput").value;
      const pass2 = document.getElementById("idInput2").value;
      const token = document.getElementById("tokenInput").value;
      const passwordStateSpan = document.getElementById("stateSpan");
      const submitButton = document.getElementById("submitButton");

      if (!validPassword(pass1)){
        passwordStateSpan.style.color = "red";
        passwordStateSpan.innerHTML = "La contraseña debe tener almenos 8 carácteres.";
        passwordStateSpan.scrollIntoView({behavior: "smooth"});
        return;
      }

      fetch("../functions/recoveryPassForm.php",{
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "token="+token+"&password="+pass1+"&password_confirm="+pass2 
      })
      .then(res => res.json())
      .then((res) =>{
        span.innerHTML = res.msg;
        span.style.color = states[res.state];

        if (res.state === 0){
          submitButton.style.display = "none";
          setTimeout(() => {
            window.location.href = "../index.php";
          }, 5000);
        }
      })
      .catch(err => console.error("Error en fetch: ", err));

    });

    function validPassword(pass){
      return pass.length >= 8;
    }
  </script>
</body>
</html>
