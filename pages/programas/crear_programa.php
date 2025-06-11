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

    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_programas'">
      <i class="bi bi-arrow-left"></i>
      Volver
    </button>
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

    <label for="day">Total horas del programa</label>
      <input type="text" name="horas" placeholder="Ingrese las horas" required>
    

    <div class="buttons-container">
      <a href=".?page=programas/listar_programas">
        Cancelar
      </a>

      <input type="submit" value="Crear programa">
    </div>
  </form>
</div>
<script src="/SSA/assets/js/crearProgramaForm.js"></script>