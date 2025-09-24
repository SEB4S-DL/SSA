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
<link rel="stylesheet" href="./assets/css/acordeon.css">
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

  <?php 
    $competencias = obtener_competencias();
  ?>

  <div class="accordion accordion-flush" id="accordionFlushExample">

    <?php
      $cont = 0;
      $raeCont = 0;

      while ($competencia = $competencias->fetch_assoc()):

      $cont += 1;
    ?>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#competencia<?=$cont;?>">
          <?=$competencia["nombre_competencia"];?>
        </button>
      </h2>
      <div id="competencia<?=$cont;?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">

          <div class="accordion accordion-flush" id="juiciosAccordion">

            <?php
              $juicios = obtener_juicios($competencia["id"]);

              while ($juicio = $juicios->fetch_assoc()):

              $raeCont += 1;
            ?>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rae<?=$raeCont;?>">
                  <?=$juicio["nombre_rae"];?>
                </button>
              </h2>
              <div id="rae<?=$raeCont;?>" class="accordion-collapse collapse" data-bs-parent="#juiciosAccordion">
                <div class="accordion-body">
                  Estado: <?=$juicio["estado"];?>
                  <br>
                  Evaluador: <?=$juicio["nombre_evaluador"];?>
                  <br>
                  Documento del evaluador: <?=$juicio["id_evaluador"];?>
                  <br>
                  Observacion: <?=$juicio["observacion"] == "" ? "Ninguna" : $juicio["observacion"];?>
                  <br>
                  Fecha y hora de emisión del juicio: <?=$juicio["fecha_y_hora"];?>
                </div>
              </div>
            </div>

            <?php endwhile; ?>

          </div>

        </div>
      </div>
    </div>
      
    <?php endwhile; ?>
    
  </div>

</div>

<?php else: ?>

<p style="color: red">El aprendiz o la ficha proporcionados no son válidos</p>

<?php endif; ?>
