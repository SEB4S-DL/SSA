<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
      exit();

    }
    
    require_once "./functions/crear_ficha.php";
    
    $usuarios = obtener_usuarios();
    $programas = obtener_programas();

    $estados = [
      "1" => "Ocurrió un error, por favor intente nuevamente",
      "2" => "Ya existe una ficha con este número"
    ];
?>

<link rel="stylesheet" href="./assets/css/crear-ficha.css">
<title>Crear ficha</title>

<div class="container">

  <?php if(isset($_GET["status"])): ?>
    <div class="states" style="padding: 1em; text-align:center; background-color: red; color: #fff;">
      <?= $estados[$_GET["status"]]; ?>
    </div>
  <?php endif; ?>

  <h1>Crear ficha</h1>

  <form action="./functions/crear_ficha.php" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Número de  ficha</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el número de ficha" required>

    <label for="groupManager">Jefe de grupo</label>
    <select name="jefe_grupo" id="groupManager" required>
      <?php
        while ($usuario = $usuarios->fetch_assoc()):
      ?>

      <option value="<?= $usuario["nro_documento"]; ?>"><?= $usuario["nombre"]; ?></option>

      <?php endwhile; ?>
    </select>

    <label for="day">Jornada</label>
    <select name="jornada" id="day" required>
      <option value="diurna">Diurna</option>
      <option value="mixta">Mixta</option>
      <option value="nocturna">Nocturna</option>
    </select>

    <label for="trainingProgram">Programa de formación</label>
    <select name="programa_formacion" id="trainingProgram" required>
      <?php
        while ($programa = $programas->fetch_assoc()):
      ?>

      <option value="<?= $programa["id"]; ?>"><?= $programa["nombre_programa"]; ?> (<?= $programa["nivel"]; ?>)</option>

      <?php endwhile; ?>
    </select>

    <label for="day">Oferta</label>
    <select name="oferta" id="day" required>
      <option value="abierta">Abierta</option>
      <option value="cerrada">Cerrada</option>
    </select>

    <div class="buttons-container">
      <a href=".">
        Cancelar
      </a>

      <input type="submit" value="Crear ficha">
    </div>
  </form>
</div>