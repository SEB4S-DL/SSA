<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
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

<link rel="stylesheet" href="./assets/css/crear-programa.css">

<title><?= $traducciones['titulo_crear_programa']?></title>

<div class="container">
  <br>
  <div class="top-container">
    <h1><?= $traducciones['titulo_crear_programa']?></h1>
     

  </div>


  <br>  

  <form id="crearPrograma" class="crear-ficha-form">
    <label for="fichaNumber"><?= $traducciones['nombre_programa']?></label>
    <input type="text" name="nombrePrograma" id="fichaNumber" placeholder="<?= $traducciones['input_nombre_programa']?>" required>

    <label for="groupManager"><?= $traducciones['nivel_programa']?></label>
    <select name="nivel" id="groupManager" required>
      <option disabled selected><?= $traducciones['input_select']?></option>
        <option value="tecnico"><?= $traducciones['tecnico']?></option>
        <option value="tecnologo"><?= $traducciones['tecnologo']?></option>
</select>

    <div class="buttons-container">
      <a href=".?page=programas/listar_programas">
        <?= $traducciones['cancelar']?>
      </a>

      <input type="submit" value="<?= $traducciones['crear_programa']?>">
    </div>
  </form>

  <div class="respuesta" id="respuesta"></div>
</div>
<script src="/SSA/assets/js/crearProgramaForm.js"></script>
