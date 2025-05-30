<link rel="stylesheet" href="./assets/css/crear-programa.css">

<title>Crear programa</title>

<div class="container">
  <br>
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_rae='">Volver</button>

  <h1>Crear programa</h1>
<br>  
  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del programa</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre del programa">

    <label for="groupManager">Nivel del programa</label>
    <select name="jefe_grupo" id="groupManager">
        <option value="">Técnico</option>
        <option value="">Tecnólogo</option>
    </select>

    <label for="day">Total horas del programa</label>
      <input type="text">
    

    <div class="buttons-container">
      <a href="/SSA/pages/">
        Cancelar
      </a>

      <input type="submit" value="Crear programa">
    </div>
  </form>
</div>