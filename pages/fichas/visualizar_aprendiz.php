<?php
  if (!isset($_SESSION["user"])){
    header("Location: ../../auth/login.php");
  }

  require "./functions/visualizar_aprendiz.php";

  $states = [
    "0" => "Aprendiz modificado exitosamente."
  ];
?>

<?php if ($entrada_valida): ?>

<link rel="stylesheet" href="./assets/css/visualizar-aprendiz.css">
<title>Visualizar aprendiz</title>

<?php
  $aprendiz = obtener_info();
?>

<div class="visualizar-aprendiz-container">

  <?php if(isset($_GET["state"])): ?>
  <div class="state-container 
  <?php
    if ($_GET["state"] == 0){
      echo " state-succes";
    }
  ?>">
    <p><?= $states[$_GET["state"]]; ?></p>
  </div>
  <?php endif; ?>

  <div class="top-container">
    <h1 class="top-title">Visualizar aprendiz</h1>
    <a href=".?page=fichas/visualizar_ficha&ficha=<?= $_GET['ficha']; ?>" class="top-left-button">Volver</a>
    <a href=".?page=fichas/editar_aprendiz&aprendiz=<?= $_GET['aprendiz']; ?>&ficha=<?= $_GET["ficha"]; ?>" class="top-button">Editar</a>
  </div>

  <div class="no-listable-info">
    <p>Nombre completo: <?= $aprendiz["nombre"]; ?></p>
    <p>Tipo de documento: <?= $aprendiz["tipo_documento"]; ?></p>
    <p>Numero de documento: <?= $aprendiz["nro_documento"]; ?></p>
    <p>Estado: <?= $aprendiz["estado"]; ?></p>
    <p>Cantidad de RAE aprobados: <?= $aprendiz["cant_rae_aprobados"]; ?>/<?= $aprendiz["total_rae"]; ?></p>
  </div>

  <?php $juicios = obtener_juicios(); ?>

  <div class="custom-table-container">
    <div class="row">
      <div>Competencia</div>
      <div>RAE</div>
      <div>Estado</div>
      <div>Evaluador</div>
      <div>Observaciones</div>
      <div>Fecha y hora</div>
    </div>

    <?php while($juicio = $juicios->fetch_assoc()): ?>

    <div class="row">
      <div><?= $juicio["nombre_competencia"]; ?></div>
      <div><?= $juicio["nombre_rae"]; ?></div>
      <div><?= $juicio["estado"]; ?></div>
      <div><?= $juicio["nombre_evaluador"]; ?></div>
      <div><?= $juicio["observacion"]; ?></div>
      <div><?= $juicio["fecha_y_hora"]; ?></div>
    </div>

    <?php endwhile; ?>
  </div>
</div>

<?php else: ?>

<p style="color: red">El aprendiz o la ficha proporcionados no son válidos</p>

<?php endif; ?>
