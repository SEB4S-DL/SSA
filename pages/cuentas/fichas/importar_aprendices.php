<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  if (!isset($_GET["ficha"])){
    header("Location: .");
  }
?>

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title>Importar aprendices</title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    Importar aprendices
  </h1>

  <div class="warning-container">
    <div class="warning">
      <p>Para cargar los aprendices con un excel, este debe seguir un formato. El formato debe ser una tabla que contenga las siguientes columnas: </p>

      <ul>
        <li>Tipo de documento</li>
        <li>Número de documento</li>
        <li>Nombre</li>
        <li>Apellidos</li>
        <li>Estado</li>
        <li>Competencia</li>
        <li>Resultado de aprendizaje</li>
        <li>Juicio de evaluación</li>
        <li>Fecha y Hora del Juicio Evaluativo</li>
        <li>Funcionario que registro el juicio evaluativo</li>
      </ul>

      <br>

      <p>Cuando el excel cumpla con el formato especificado, debe convertirlo a CSV delimitado por punto y coma ( ; ) y luego subir acá el archivo csv.</p>

      <br>

      <p>A continuación se muestra una imágen con un formato adecuado para subir los aprendices con un excel.</p>
    </div>

    <div class="img-container">
      <div class="img-clickable" onclick="toggleModal('imgModalBg', 'closeModal')">
        <span>Ver imágen</span>
      </div>
      <img src="./assets/img/juicios-excel.png" alt="Imágen con formato de excel" class="warning-image" onclick="toggleModal('imgModalBg', 'closeModal')">
    </div>
  </div>

  <form action="./functions/importar_aprendices.php" enctype="multipart/form-data" class="importar-form" method="POST">
    <label for="fileInput">Seleccionar archivo</label>
    <input type="file" name="excel" id="fileInput" accept=".csv" required>
    <input type="hidden" name="ficha" value="<?= $_GET["ficha"]; ?>">

    <input type="submit" value="Importar aprendices">
  </form>
</div>

<div class="img-modal--bg" id="imgModalBg">
  <span id="closeModal">
    <i class="bi bi-x-lg"></i>
  </span>
  <img src="./assets/img/juicios-excel.png" alt="Imágen con formato de excel">
</div>

<script src="./assets/js/modalImage.js"></script>