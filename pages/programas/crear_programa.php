<link rel="stylesheet" href="./assets/css/crear-programa.css">

<title>Crear programa</title>

<div class="container">
  <br>
  <div class="top-container">
    <h1>Crear programa</h1>

    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_programas'">
      <i class="bi bi-arrow-left"></i>
      Volver
    </button>
  </div>

  <br>  

  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del programa</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre del programa" required>

    <label for="groupManager">Nivel del programa</label>
    <select name="jefe_grupo" id="groupManager" required>
        <option value="">Técnico</option>
        <option value="">Tecnólogo</option>
    </select>

    <label for="day">Total horas del programa</label>
      <input type="text" placeholder="Ingrese las horas" required>
    

    <div class="buttons-container">
      <a href="/SSA/pages/">
        Cancelar
      </a>

      <input type="submit" value="Crear programa">
    </div>
  </form>
</div>