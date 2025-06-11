<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/crear-aprendiz.css">
<title>Crear aprendiz</title>

<div class="crear-aprendiz-container">
  <div class="top-container__text">
    <h1 class="top-container-title">Crear aprendiz</h1>

    <a href=".?page=fichas/importar_aprendices" class="top-container-button">
      Importar aprendices
      <i class="bi bi-file-earmark-spreadsheet"></i>
    </a>
  </div>

  <form action="" class="crear-aprendiz-form" method="POST">
    <!-- Nombres aprendiz -->
    <h3>Nombres aprendiz</h3>

    <input type="text" name="primer_nombre" id="" placeholder="Primer nombre"  required>
    <input type="text" name="segundo_nombre" id="" placeholder="Segundo nombre">



    <!-- Apellidos aprendiz -->
    <h3>Apellidos aprendiz</h3>

    <input type="text" name="primer_apellido" id="" placeholder="Primer apellido" required>
    <input type="text" name="segundo_apellido" id="" placeholder="Segundo apellido">



    <!-- Documento del aprendiz -->
    <h3>Documento del aprendiz</h3>

    <label for="apprenticeDocumentType" class="simpleLabel">Tipo de documento</label>

    <select name="tipo_documento" id="apprenticeDocumentType" required>
      <option value="">Tarjeta de identidad</option>
      <option value="">Cédula de ciudadanía</option>
      <option value="">Cédula de extranjería</option>
    </select>

    <input type="text" name="nro_documento" placeholder="Numero de documento" required>



    <!-- Estado del aprendiz -->
    <label for="apprenticeState">
      <h3>Estado del aprendiz</h3>
    </label>

    <select name="estado" id="apprenticeState" required>
      <option value="">En formación</option>
      <option value="">Deserción</option>
      <option value="">Cancelado</option>
      <option value="">Trasladado</option>
    </select>



    <!-- Ficha del aprendiz -->
    <label for="apprenticeFile" required>
      <h3>Ficha del aprendiz</h3>
    </label>

    <select name="ficha" id="apprenticeFile" required>
      <option value="">2895664</option>
      <option value="">7625311</option>
    </select>

    <div class="form-buttons-container">
      <button type="button" onclick="window.location.href = '.?page=fichas/visualizar_ficha'">Cancelar</button>
      <input type="submit" value="Crear aprendiz">
    </div>
    
  </form>
</div>