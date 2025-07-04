<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  require_once "./functions/editar_aprendiz.php";

  $states = [
    "1" => "Ocurrió un error al modificar el aprendiz.",
    "2" => "Ocurrió un error, por favor intente nuevamente"
  ];
?>

<?php 
  // Verificar si el usuario ingresó los parametros necesarios por URL
  if ($entrada_valida): 

  // Validar que el aprendiz pertenezca a la ficha enviada por url
  if (aprendiz_valido($_GET["aprendiz"])):

  $aprendiz = obtener_info();
?>

<link rel="stylesheet" href="./assets/css/editar-aprendiz.css">
<title>Editar aprendiz</title>

<div class="editar-aprendiz-container">

  <?php if(isset($_GET["state"])): ?>
  <div class="state-container 
  <?php
    if ($_GET["state"] == 0){
      echo " state-succes";
    }
    else{
      echo " state-error";
    }
  ?>">
    <p><?= $states[$_GET["state"]]; ?></p>
  </div>
  <?php endif; ?>

  <div class="top-container__text">
    <h1 class="top-container-title">Editar aprendiz</h1>
  </div>

  <form action="./functions/editar_aprendiz.php" class="crear-aprendiz-form" method="POST">
    <!-- Nombres aprendiz -->
    <h3>Nombres aprendiz</h3>

    <input type="text" name="primer_nombre" id="" placeholder="Primer nombre" value="<?= $aprendiz["nombre"]; ?>" required>
    <input type="text" name="segundo_nombre" id="" placeholder="Segundo nombre" value="<?= $aprendiz["segundo_nombre"]; ?>">



    <!-- Apellidos aprendiz -->
    <h3>Apellidos aprendiz</h3>

    <input type="text" name="primer_apellido" id="" placeholder="Primer apellido" value="<?= $aprendiz["apellido"]; ?>" required>
    <input type="text" name="segundo_apellido" id="" placeholder="Segundo apellido" value="<?= $aprendiz["segundo_apellido"]; ?>">



    <!-- Documento del aprendiz -->
    <h3>Documento del aprendiz</h3>

    <label for="apprenticeDocumentType" class="simpleLabel">Tipo de documento</label>

    <select name="tipo_documento" id="apprenticeDocumentType" required>
      <option value="<?= $aprendiz["tipo_documento"]; ?>">Seleccione un tipo de documento</option>
      <option value="TI">Tarjeta de identidad</option>
      <option value="CC">Cédula de ciudadanía</option>
      <option value="CE">Cédula de extranjería</option>
    </select>

    <input type="hidden" name="nro_documento" value="<?= $_GET["aprendiz"]; ?>">


    <!-- Estado del aprendiz -->
    <label for="apprenticeState">
      <h3>Estado del aprendiz</h3>
    </label>

    <select name="estado" id="apprenticeState" required>
      <option value="<?= $aprendiz["estado"]; ?>">Seleccione un estado</option>
      <option value="en formacion">En formación</option>
      <option value="aplazado">Aplazado</option>
      <option value="cancelado">Cancelado</option>
      <option value="trasladado">Trasladado</option>
    </select>



    <!-- Ficha del aprendiz -->
    <label for="apprenticeFile">
      <h3>Ficha del aprendiz</h3>
    </label>

    <select name="ficha" id="apprenticeFile" required>
      <option value="<?= $aprendiz["nro_ficha"]; ?>">Seleccione una ficha</option>
      <?php
        $fichas = obtener_fichas();

        while ($ficha = $fichas->fetch_assoc()):
      ?>
      <option value="<?= $ficha["nro_ficha"]; ?>"><?= $ficha["nro_ficha"]; ?></option>
      <?php endwhile; ?>
    </select>

    <div class="custom-table-container">
      <div class="row">
        <div>Competencia</div>
        <div>RAE</div>
        <div>Estado</div>
        <div>Evaluador</div>
        <div>Observaciones</div>
      </div>

      <?php
        $juicios = obtener_juicios();

        while($juicio = $juicios->fetch_assoc()):
      ?>

      <div class="row">
        <div><?= $juicio["nombre_competencia"]; ?></div>
        <div><?= $juicio["nombre_rae"]; ?></div>

        <div>
          <select name="estado_rae[]" required>
            <option value="<?= $juicio["estado"]; ?>">Seleccione un estado</option>
            <option value="por evaluar">Por evaluar</option>
            <option value="aprobado">Aprobado</option>
          </select>
        </div>

        <div>
          <select name="evaluador_rae[]" id="" required>
            <option value="<?= $juicio["id_evaluador"]; ?>" selected">Seleccione un evaluador</option>
            <?php
              $evaluadores = obtener_evaluadores();

              while ($evaluador = $evaluadores->fetch_assoc()):
            ?>
            <option value="<?= $evaluador["nro_documento"]; ?>"><?= $evaluador["nombre"]; ?></option>

            <?php endwhile; ?>
          </select>
        </div>

        <input type="hidden" name="id_juicio[]" value="<?= $juicio["id"]; ?>">

        <div>
          <textarea name="observacion_rae[]" id="" placeholder="Ingrese la observación del aprendiz"><?= $juicio["observacion"]; ?></textarea>
        </div>
      </div>

      <?php endwhile; ?>

    </div>

    <div class="form-buttons-container">
      <button type="button" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=<?= $_GET['aprendiz']; ?>&ficha=<?= $_GET['ficha']; ?>'">Cancelar</button>
      <input type="submit" value="Actualizar">
    </div>
    
  </form>
</div>

  <?php else: ?>

  <p style="color: red">El aprendiz o la ficha proporcionados no son válidos.</p>

  <?php endif; ?>

  

<?php else: ?>

  <p style="color: red">No se propocionó ningún aprendiz o ficha.</p>

<?php endif; ?>