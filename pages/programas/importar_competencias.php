<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title>Importar competencias</title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    Importar competencias
  </h1>

  <div class="warning-container">
    <div class="warning">
      <p>Para cargar los aprendices con un excel, este debe seguir un formato. El formato debe ser una tabla que contenga las siguientes columnas: {{Campos}}</p>

      <p>A continuación se muestra una imágen con un formato adecuado para subir los aprendices con un excel.</p>
    </div>

    <div class="img-container">
      <div class="img-clickable" onclick="toggleModal('imgModalBg', 'closeModal')">
        <span>Ver imágen</span>
      </div>
      <img src="./assets/img/hola.png" alt="Imágen con formato de excel" class="warning-image" onclick="toggleModal('imgModalBg', 'closeModal')">
    </div>
  </div>

  <form action="" method="POST" enctype="multipart/form-data" class="importar-form">
    <label for="fileInput">Seleccionar archivo</label>
    <input type="file" name="excel" id="fileInput" accept=".xls, .xlsx" required>

    <input type="submit" value="Importar competencias">
  </form>
</div>

<div class="img-modal--bg" id="imgModalBg">
  <span id="closeModal">
    <i class="bi bi-x-lg"></i>
  </span>
  <img src="./assets/img/hola.png" alt="Imágen con formato de excel">
</div>

<script src="./assets/js/modalImage.js"></script>