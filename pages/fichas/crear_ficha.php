<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
      exit();

    }

    // Si el usuario no es admin, redirigir a la página principal
    if ($_SESSION["user_rol"] != "admin"){
      echo "<meta http-equiv='refresh' content='0;url=./auth/login.php'>";
      exit;
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
<title><?= $traducciones['titulo_crear_ficha']?></title>

<div class="container">

  <?php if(isset($_GET["status"])): ?>
    <div class="states" style="padding: 1em; text-align:center; background-color: red; color: #fff;">
      <?= $estados[$_GET["status"]]; ?>
    </div>
  <?php endif; ?>

  <h1><?= $traducciones['titulo_crear_ficha']?></h1>

  <form action="./functions/crear_ficha.php" method="POST" class="crear-ficha-form">
    <label for="fichaNumber"><?= $traducciones['numero_de_ficha']?></label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="<?= $traducciones['input1']?>" required>

    <label for="groupManager"><?= $traducciones['jefe_de_grupo']?></label>
    <select name="jefe_grupo" id="groupManager" required>
      <?php
        while ($usuario = $usuarios->fetch_assoc()):
      ?>

      <option value="<?= $usuario["nro_documento"]; ?>"><?= $usuario["nombre"]; ?></option>

      <?php endwhile; ?>
    </select>

    <label for="day"><?= $traducciones['jornada']?></label>
    <select name="jornada" id="day" required>
      <option value="diurna"><?= $traducciones['diurna']?></option>
      <option value="mixta"><?= $traducciones['mixta']?></option>
      <option value="nocturna"><?= $traducciones['nocturna']?></option>
    </select>

    <label for="trainingProgram"><?= $traducciones['programa_de_formacion']?></label>
    <select name="programa_formacion" id="trainingProgram" required>
      <?php
        while ($programa = $programas->fetch_assoc()):
      ?>

      <option value="<?= $programa["id"]; ?>"><?= $programa["nombre_programa"]; ?> (<?= $programa["nivel"]; ?>)</option>

      <?php endwhile; ?>
    </select>

    <label for="day"><?= $traducciones['oferta']?></label>
    <select name="oferta" id="day" required>
      <option value="abierta"><?= $traducciones['abierta']?></option>
      <option value="cerrada"><?= $traducciones['cerrada']?></option>
    </select>

    <div class="buttons-container">
      <a href=".">
        <?= $traducciones['cancelar']?>
      </a>

      <input type="submit" value="<?= $traducciones['btn_crear_ficha']?>">
    </div>
  </form>
</div>