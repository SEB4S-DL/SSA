<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  require "./functions/crear_aprendiz.php";

  $estados = [
    "0" => "El aprendiz se creó exitosamente",
    "1" => "El aprendiz ya existe",
    "2" => "El número de documento no es válido",
    "3" => "Ocurrió un error, por favor intente nuevamente"
  ];
?>

<link rel="stylesheet" href="./assets/css/crear-aprendiz.css">
<title>Crear aprendiz</title>

<div class="crear-aprendiz-container">

  <?php if (isset($_GET["state"])): ?>
  <div class="state-container
    <?php
      if ($_GET["state"] != 0){
        echo "state-error";
      }
      else{
        echo "state-succes";
      }
    ?>
  ">
    <?= $estados[$_GET["state"]]; ?>
  </div>
  <?php endif; ?>


  <div class="top-container__text">
    <h1 class="top-container-title">Crear aprendiz</h1>

    <?php if(isset($_GET["ficha"])): ?>
    <a href=".?page=fichas/importar_aprendices" class="top-container-button">
      Importar aprendices
      <i class="bi bi-file-earmark-spreadsheet"></i>
    </a>
    <?php endif; ?>
    
  </div>

  <?php if (isset($_GET["ficha"])): ?>

  <form action="./functions/crear_aprendiz.php" class="crear-aprendiz-form" method="POST">
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
      <option value="TI">Tarjeta de identidad</option>
      <option value="CC">Cédula de ciudadanía</option>
      <option value="CE">Cédula de extranjería</option>
    </select>

    <input type="text" name="nro_documento" placeholder="Numero de documento" required>



    <!-- Estado del aprendiz -->
    <label for="apprenticeState">
      <h3>Estado del aprendiz</h3>
    </label>

    <select name="estado" id="apprenticeState" required>
      <option value="en formacion">En formación</option>
      <option value="cancelado">Cancelado</option>
      <option value="trasladado">Trasladado</option>
      <option value="aplazado">Aplazado</option>
    </select>

    <input type="hidden" name="ficha" value="<?= $_GET["ficha"]; ?>">

    <div class="form-buttons-container">
      <button type="button" onclick="window.location.href = '.?page=fichas/visualizar_ficha&ficha=<?= $_GET['ficha']; ?>'">Cancelar</button>
      <input type="submit" value="Crear aprendiz">
    </div>
    
  </form>

  <?php else: ?>

    <p style="color: red; margin-left: 2em;">No se proporcionó un número de ficha válido.</p>

    <a href="." class="volver-button">
      Volver
    </a>

  <?php endif; ?>
</div>