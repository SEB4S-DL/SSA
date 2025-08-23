<?php
  if (!isset($_SESSION["user"])){
    header("Location: ../../auth/login.php");
  }

  require "./functions/visualizar_aprendiz.php";

  $states = [
    "0" => "Aprendiz modificado exitosamente."
  ];

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

<?php if ($entrada_valida): ?>

<link rel="stylesheet" href="./assets/css/visualizar-aprendiz.css">
<title><?= $traducciones['titulo_visualizar_aprendiz']?></title>

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
    <h1 class="top-title"><?= $traducciones['titulo_visualizar_aprendiz']?></h1>
    <a href=".?page=fichas/visualizar_ficha&ficha=<?= $_GET['ficha']; ?>" class="top-left-button"><?= $traducciones['volver']?></a>
  </div>

  <div class="no-listable-info">
    <p><?= $traducciones['nombre_aprendiz']?>: <?= $aprendiz["nombre"]; ?></p>
    <p><?= $traducciones['documento_aprendiz']?>: <?= $aprendiz["tipo_documento"]; ?></p>
    <p><?= $traducciones['numero_documento_aprendiz']?>: <?= $aprendiz["nro_documento"]; ?></p>
    <p><?= $traducciones['estado']?>: <?= $aprendiz["estado"]; ?></p>
    <p><?= $traducciones['cantidad_rae']?>: <?= $aprendiz["cant_rae_aprobados"]; ?>/<?= $aprendiz["total_rae"]; ?></p>
  </div>

  <?php $juicios = obtener_juicios(); ?>

  <div class="custom-table-container">
    <div class="row">
      <div><?= $traducciones['competencia']?></div>
      <div>RAE</div>
      <div><?= $traducciones['estado']?></div>
      <div><?= $traducciones['evaluador']?></div>
      <div><?= $traducciones['observaciones']?></div>
      <div><?= $traducciones['fecha_y_hora']?></div>
    </div>

    <?php while($juicio = $juicios->fetch_assoc()): ?>

    <div class="row">
      <div><?= $juicio["nombre_competencia"]; ?></div>
      <div><?= $juicio["nombre_rae"]; ?></div>
      <div><?= $juicio["estado"]; ?></div>
      <div><?= $juicio["id_evaluador"]; ?> - <?= $juicio["nombre_evaluador"]; ?></div>
      <div><?= $juicio["observacion"]; ?></div>
      <div><?= $juicio["fecha_y_hora"]; ?></div>
    </div>

    <?php endwhile; ?>
  </div>
</div>

<?php else: ?>

<p style="color: red">El aprendiz o la ficha proporcionados no son válidos</p>

<?php endif; ?>
