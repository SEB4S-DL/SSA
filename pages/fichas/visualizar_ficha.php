<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  require "./functions/visualizar_ficha.php";

  $states = [
    "1" => "No se proporcionó la ficha"
  ];

  $aprendices = obtener_aprendices();
?>

<link rel="stylesheet" href="./assets/css/visualizar-ficha.css">
<title>Visualizar ficha</title>

<div class="visualizar-ficha-container">
  <div class="top-container__text">
    <h1 class="top-container-title">Ficha: 
      <?php if(isset($_GET["ficha"])){
        echo $_GET["ficha"];
      }
      ?>
    </h1>
    
    <?php 
      if (isset($_GET["ficha"])):
    ?>

    <a href=".?page=fichas/importar_aprendices&ficha=<?= $_GET["ficha"]; ?>" class="importar-button">
      Importar aprendices
      <i class="bi bi-file-earmark-spreadsheet"></i>
    </a>

    <?php endif; ?>

    <a href=".?page=fichas/listar_fichas" class="top-container-volver">
      Volver
    </a>
  </div>

  <div class="main-content">

  <?php if (isset($_GET["ficha"])): ?>
    <?php if($aprendices->num_rows > 0): ?>

    <?php while ($aprendiz = $aprendices->fetch_assoc()): ?>
    <?php $porcentaje_aprobado = calcular_aprobado($aprendiz);?>
    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=<?= $aprendiz['nro_documento']; ?>&ficha=<?= $_GET['ficha']; ?>'">
      <div class="percentage-container 
      <?php if($porcentaje_aprobado >= 75){
        echo "green";
      }
      else{
        echo "red";
      } ?>-percentage" data-percentage="<?= $porcentaje_aprobado; ?>"></div>
      <p><?= $aprendiz["nombre"]; ?></p>
      <p><?= $aprendiz["tipo_documento"]; ?>: <?= $aprendiz["nro_documento"]; ?></p>
      <p><?= $porcentaje_aprobado; ?>% aprobado</p>
      <p>Estado: <?= $aprendiz["estado"]; ?></p>
    </div>
    <?php endwhile; ?>

    <?php else: ?>

    <p style="color: red;">No se encontraron aprendices para la ficha solicitada</p>

    <?php endif; ?>

  <?php else: ?>
    <p style="color: red;">No se proporcionó una ficha</p>
  <?php endif; ?>
  </div>
</div>

<script src="./assets/js/loadPercentage.js"></script>