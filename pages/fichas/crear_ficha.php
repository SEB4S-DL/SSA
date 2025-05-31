<link rel="stylesheet" href="./assets/css/crear-ficha.css">
<title>Crear ficha</title>

<div class="container">

  <h1>Crear ficha</h1>

  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Número de  ficha</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el número de ficha" required>

    <label for="groupManager">Jefe de grupo</label>
    <select name="jefe_grupo" id="groupManager" required>
      <option value="1">Juan Esteban Martinez Flores</option>
    </select>

    <label for="day">Jornada</label>
    <select name="jornada" id="day" required>
      <option value="1">Juan Esteban Martinez Flores</option>
    </select>

    <label for="trainingProgram">Programa de formación</label>
    <select name="programa_formacion" id="trainingProgram" required>
      <option value="1">Juan Esteban Martinez Flores</option>
    </select>

    <div class="buttons-container">
      <a href=".">
        Cancelar
      </a>

      <input type="submit" value="Crear ficha">
    </div>
  </form>
</div>