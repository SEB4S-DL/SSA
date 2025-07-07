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
?>

<link rel="stylesheet" href="./assets/css/listar-fichas.css">
<title>Listar fichas</title>
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
    <h1>Listado de fichas</h1>
    <button onclick="window.location.href = '.?page=fichas/crear_ficha'">Crear ficha <i class="bi bi-plus-lg"></i></button>
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
          <p><strong>Ficha:</strong> <?= htmlspecialchars($dato["nro_ficha"]) ?></p>
          <p><strong>Jefe:</strong> <?= htmlspecialchars($dato["nombre_jefe"]) ?></p>
          <p><strong>Oferta:</strong> <?= htmlspecialchars($dato["tipo_oferta"]) ?> </p>
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

    <h1>Editar ficha</h1>

    <form action="./functions/listar_fichas.php" method="POST">
      <label for="jefeGrupoSelect">
        <h3>Jefe de grupo</h3>
      </label>
      <select name="jefe_grupo" id="jefeGrupoSelect" required>
        <?php while($fila = $instructores->fetch_assoc()): ?>
          <option value="<?= $fila["nro_documento"]; ?>"><?= $fila["nombre"]; ?></option>
        <?php endwhile; ?>
      </select>

      <input type="hidden" id="fichaNumero" name="ficha_nro">

      <label for="jornadaSelect">
        <h3>Jornada</h3>
      </label>
      <select name="ficha_jornada" id="jornadaSelect" required>
        <option value="diurna">Diurna</option>
        <option value="mixta">Mixta</option>
        <option value="nocturna">Nocturna</option>
      </select>

      <label for="jornadaSelect">
        <h3>Etapa</h3>
      </label>
      <select name="ficha_etapa" required>
        <option value="lectiva">Lectiva</option>
        <option value="productiva">Productiva</option>
      </select>

      <input type="submit" id="submitInput">
    </form>
  </div>
</div>

<script src="./assets/js/modalEditarFicha.js"></script>