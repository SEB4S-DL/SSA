<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
      exit();
  }

  require_once "./functions/listar_fichas.php";

  // Función que obtiene todas las fichas en etapa lectiva
  $resultado = obtener_fichas();

  $estados = [
    "0" => "Ficha modificada exitosamente.",
    "1" => "Ocurrió un error, por favor intente nuevamente.",
    "2" => "No se afectó ninguna fila",
    "3" => "Ficha creada exitosamente"
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

<link rel="stylesheet" href="./assets/css/listar-fichas.css">
<title><?= $traducciones['titulo_listado_fichas']?></title>
<div class="listar-fichas-container">
  <?php if(isset($_GET["status"])): ?>
  <div class="status-container <?php
    if ($_GET["status"] == 0 || $_GET["status"] == 2 || $_GET["status"] == 3){
      echo "status-succes";
    }
    else{
      echo "status-error";
    }
  ?>">
    <?= $estados[$_GET["status"]]; ?>
  </div>
  <?php endif; ?>

  <div class="listar-fichas-top-container">
    <h1><?= $traducciones['titulo_listado_fichas']?></h1>
    <button onclick="window.location.href = '.?page=fichas/crear_ficha'"><?= $traducciones['btn_crear_ficha']?><i class="bi bi-plus-lg"></i></button>
  </div>
      
  <div class="contenedor">
  
  <?php if ($resultado->num_rows > 0): ?>
      <?php while($dato = $resultado->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href = '.?page=fichas/visualizar_ficha&ficha=<?= $dato['nro_ficha']; ?>'">
          <button 
          onclick="event.stopPropagation()" 
          title="Editar ficha" 
          class="editarTrigger"
          data-tipo="ficha"
          data-id="<?= $dato['nro_ficha'] ?>"
          data-jefe="<?= $dato['nombre_jefe'] ?>"
          data-jefeid="<?= $dato['id_jefe_ficha'] ?>"
          data-jornada="<?= $dato['jornada'] ?>"
          customValue="<?= $dato["nro_ficha"] ?>">
            <i class="bi bi-pencil-fill"></i>
          </button>

          <p class="card-first-p"><?= htmlspecialchars($dato["nombre_programa"]) ?></p>
          <p><strong><?= $traducciones['ficha']?>:</strong> <?= htmlspecialchars($dato["nro_ficha"]) ?></p>
          <p><strong><?= $traducciones['jefe']?>:</strong> <?= htmlspecialchars($dato["nombre_jefe"]) ?></p>
          <p><strong><?= $traducciones['oferta']?>:</strong> <?= htmlspecialchars($dato["tipo_oferta"]) ?> </p>
        </div>
    <?php endwhile; ?>
    
    <?php else: ?>
      <p>No hay fichas disponibles.</p>
  <?php endif; ?>
  
  </div>
</div>


<!-- Modal para editar fichas -->

<?php 
  // Obtener los instructores
  $instructores =  obtener_instructores();
?>
<div class="modal-bg">
  <div class="editar-fichas-modal">
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <h1><?= $traducciones['editar_ficha']?></h1>

    <form action="./functions/listar_fichas.php" method="POST">
      <label for="jefeGrupoSelect">
        <h3><?= $traducciones['jefe_de_grupo']?></h3>
      </label>
      <select name="jefe_grupo" id="jefeGrupoSelect" required>
        <?php while($fila = $instructores->fetch_assoc()): ?>
          <option value="<?= $fila["nro_documento"]; ?>"><?= $fila["nombre"]; ?></option>
        <?php endwhile; ?>
      </select>

      <input type="hidden" id="fichaNumero" name="ficha_nro">

      <label for="jornadaSelect">
        <h3><?= $traducciones['jornada']?></h3>
      </label>
      <select name="ficha_jornada" id="jornadaSelect" required>
        <option value="diurna"><?= $traducciones['diurna']?></option>
        <option value="mixta"><?= $traducciones['mixta']?></option>
        <option value="nocturna"><?= $traducciones['nocturna']?></option>
      </select>

      <label for="jornadaSelect">
        <h3><?= $traducciones['etapa']?></h3>
      </label>
      <select name="ficha_etapa" required>
        <option value="lectiva"><?= $traducciones['lectiva']?></option>
        <option value="productiva"><?= $traducciones['productiva']?></option>
      </select>

      <input type="submit" id="submitInput">
    </form>
  </div>
</div>

<script src="./assets/js/modalEditarFicha.js"></script>