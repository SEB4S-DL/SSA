<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="#">
  <link rel="stylesheet" href="../assets/css/global.css">
  <link rel="stylesheet" href="../assets/css/crear-ficha.css">
  <title>Crear ficha</title>
</head>
<body onload="activarModoOscuro('global.css')">
  <div class="container">

    <h1>Crear ficha</h1>

    <form action="" method="POST" class="crear-ficha-form">
      <label for="fichaNumber">Número de  ficha</label>
      <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el número de ficha">

      <label for="groupManager">Jefe de grupo</label>
      <select name="jefe_grupo" id="groupManager">
        <option value="1">Juan Esteban Martinez Flores</option>
      </select>

      <label for="day">Jornada</label>
      <select name="jornada" id="day">
        <option value="1">Juan Esteban Martinez Flores</option>
      </select>

      <label for="trainingProgram">Programa de formación</label>
      <select name="programa_formacion" id="trainingProgram">
        <option value="1">Juan Esteban Martinez Flores</option>
      </select>

      <div class="buttons-container">
        <button>Cancelar</button>
  
        <input type="submit" value="Crear ficha">
      </div>
    </form>
  </div>

  <script src="../assets/js/modoOscuro.js"></script>
</body>
</html>