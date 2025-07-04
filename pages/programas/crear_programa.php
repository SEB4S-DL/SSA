<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/crear-programa.css">

<title>Crear programa</title>

<div class="container">
  <br>
  <div class="top-container">
    <h1>Crear programa</h1>
     

  </div>


  <br>  

  <form id="crearPrograma" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del programa</label>
    <input type="text" name="nombrePrograma" id="fichaNumber" placeholder="Ingrese el nombre del programa" required>

    <label for="groupManager">Nivel del programa</label>
    <select name="nivel" id="groupManager" required>
      <option disabled selected>Seleccione un nivel</option>
        <option value="tecnico">Técnico</option>
        <option value="tecnologo">Tecnólogo</option>
</select>

    <div class="buttons-container">
      <a href=".?page=programas/listar_programas">
        Cancelar
      </a>

      <input type="submit" value="Crear programa">
    </div>
  </form>

  <div class="respuesta" id="respuesta"></div>
</div>
<script src="/SSA/assets/js/crearProgramaForm.js"></script>