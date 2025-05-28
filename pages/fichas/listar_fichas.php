<link rel="stylesheet" href="./assets/css/listar-fichas.css">
<title>Listar fichas</title>

<?php   
    $sql = "SELECT p.nombre_programa, f.nro_ficha, 
    CONCAT_WS(' ', u.nombre , u.segundo_nombre , u.apellido , u.segundo_apellido) AS 'nombre_jefe', f.tipo_oferta 
    from fichas f
    JOIN programa_formacion p
    ON f.id_programa_formacion = p.id
    JOIN usuarios u
    ON f.id_jefe_ficha = u.nro_documento WHERE f.etapa = 'lectiva'";

    $resultado = $conn->query($sql);

?>
<div class="listar-fichas-container">
  <div class="listar-fichas-top-container">
    <h1>Listado de fichas</h1>
    <button onclick="window.location.href = '.?page=fichas/crear_ficha'">Crear ficha <i class="bi bi-plus-lg"></i></button>
  </div>
      
  <div class="contenedor">
  
  <?php if ($resultado->num_rows > 0): ?>
      <?php while($dato = $resultado->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href = '.?page=cuentas'">
          <button onclick="event.stopPropagation()" title="Editar ficha" class="editarFichaTrigger" customValue="<?= $dato["nro_ficha"] ?>"><i class="bi bi-pencil-fill"></i></button>
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

<div class="modal-bg">
  <div class="editar-fichas-modal">
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <h1>Editar ficha</h1>

    <form action="">
      <label for="jefeGrupoSelect">
        <h3>Jefe de grupo</h3>
      </label>
      <select name="jefe_grupo" id="jefeGrupoSelect">
        <option value="">Andrés Felipe Cardona Muñoz</option>
      </select>

      <label for="jornadaSelect">
        <h3>Jornada</h3>
      </label>
      <select name="ficha_jornada" id="jornadaSelect">
        <option value="">Diurna</option>
      </select>

      <input type="submit" value="Editar ficha">
    </form>
  </div>
</div>

<script src="./assets/js/modalEditarFicha.js"></script>