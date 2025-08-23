<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  if (!isset($_GET["ficha"])){
    header("Location: .");
  }

              $idiomasPermitidos = ['es', 'en'];
$idioma = 'es';

if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomasPermitidos)) {
    $idioma = $_GET['lang'];
    setcookie('lang', $idioma, time() + (86400 * 30), "/");
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $idiomasPermitidos)) {
    $idioma = $_COOKIE['lang'];
}

$traducciones = require __DIR__ . "/../../lang/$idioma.php";
?>

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title><?= $traducciones['titulo_importar_aprendices']?></title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    <?= $traducciones['titulo_importar_aprendices']?>
  </h1>

  <div class="warning-container">
    <div class="warning">
      <p><?= $traducciones['p1_importar_aprendices']?></p>

      <ul>
        <li><?= $traducciones['tdoc']?></li>
        <li><?= $traducciones['ndoc']?></li>
        <li><?= $traducciones['nombre']?></li>
        <li><?= $traducciones['apellidos']?></li>
        <li><?= $traducciones['estado']?></li>
        <li><?= $traducciones['competencia']?></li>
        <li><?= $traducciones['rae']?></li>
        <li><?= $traducciones['juicio_evaluacion']?></li>
        <li><?= $traducciones['fecha_hora']?></li>
        <li>Funcionario que registro el juicio evaluativo</li>
        
      </ul>

      <br>

      <p>Cuando el excel cumpla con el formato especificado, debe convertirlo a CSV delimitado por punto y coma ( ; ) y luego subir acá el archivo csv.</p>

      <br>

      <p>A continuación se muestra una imágen con un formato adecuado para subir los aprendices con un excel.</p>
    </div>

    <div class="img-container" onclick="window.open('./assets/img/juicios-excel.png')">
      <div class="img-clickable">
        <span>Ver imágen</span>
      </div>
      <img src="./assets/img/juicios-excel.png" alt="Imágen con formato de excel" class="warning-image">
    </div>
  </div>

  <form action="./functions/importar_aprendices.php" enctype="multipart/form-data" class="importar-form" method="POST">
    <label for="fileInput">Seleccionar archivo</label>
    <input type="file" name="excel" id="fileInput" accept=".csv" required>
    <input type="hidden" name="ficha" value="<?= $_GET["ficha"]; ?>">

    <input type="submit" value="Importar aprendices">

    <button type="button" class="cancelar-button" onclick="window.location.href = '?page=fichas/visualizar_ficha&ficha=<?= $_GET['ficha']; ?>'"><?= $traducciones['cancelar']?></button>
  </form>

  <p class="selected-file"></p>
</div>

<script src="./assets/js/formChange.js"></script>
