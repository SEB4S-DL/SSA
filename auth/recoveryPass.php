<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/img/sena-logo.png">
  <link rel="stylesheet" href="../assets/css/recoveryPass.css">

  <style>
      .loader {
          border-top: 2px solid #39a900;
          border-radius: 50%;
          width: 40px;
          height: 40px;
          animation: spin 1s linear infinite;
          margin: 20px auto;
          display: none;
      }
      @keyframes spin {
          0%   { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }
  </style>

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
      <div class="loader" id="loader"></div>
    </form>
  </div>

  <script>
    const form = document.getElementById("recoveryForm");
    const stateSpan = document.getElementById("stateSpan");
    const states = {
      0: "green",
      1: "red"
    }

    const loader = document.getElementById("loader");
    const formButton = document.getElementById("formButton");

    form.addEventListener("submit", (e)=> {
      const userEmail = document.getElementById("email").value;
      e.preventDefault();

      formButton.style.display = "none";
      loader.style.display = "block";

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
        .finally(() =>{
          loader.style.display = "none";
          formButton.style.display = "block";
        });
    });
  </script>
</body>
</html>
