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

    <br>

    <span id="stateSpan"></span>

    <h1>Recuperación De Contraseña</h1>
    <form method="POST" id="recoveryForm">
      <label for="email">Correo Institucional:</label>
      <input type="email" name="email" id="email" placeholder="ejemplo@soy.sena.edu.co" required>
      <button id="formButton" type="submit">Enviar</button>
    </form>
  </div>

  <script>
    const form = document.getElementById("recoveryForm");
    const stateSpan = document.getElementById("stateSpan");
    const states = {
      0: "green",
      1: "red"
    }

    form.addEventListener("submit", (e)=> {
      const userEmail = document.getElementById("email").value;
      e.preventDefault();

      fetch("../functions/recoveryPass.php",
        {
          method: "POST",
          headers: {"Content-Type": "application/x-www-form-urlencoded"},
          body: "email=" + userEmail
        }
      )
        .then(res => res.json())
        .then((res) => {
          stateSpan.innerHTML = res.msg;
          stateSpan.style.color = states[res.state];
        })
        .catch(err => console.error("Error en fetch: ", err))
    });
  </script>
</body>
</html>
