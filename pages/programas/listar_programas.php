<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/listar_programas.css">
<title>Listar programas</title>

<?php   
    $sql = "SELECT id,nombre_programa,nivel from programa_formacion";

    $resultado = $conn->query($sql);

?>
<div class="listar-fichas-container">
  <div class="listar-fichas-top-container">
    <h1>Listado de programas</h1>
    <button onclick="window.location.href = '.?page=programas/crear_programa'">Crear programa <i class="bi bi-plus-lg"></i></button>
  </div>
      
  <div class="contenedor">
  
  <?php if ($resultado->num_rows > 0): ?>
      <?php while($dato = $resultado->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href = '.?page=programas/listar_competencias&programa=<?= $dato['id']; ?>'">
          <button 
  onclick="event.stopPropagation()" 
  title="Editar programa" 
  class="editarTrigger"
  data-tipo="programa"
  data-id="<?= $dato['id'] ?>"
  data-nombre="<?= htmlspecialchars($dato['nombre_programa'], ENT_QUOTES )?>"
  data-nivel="<?= htmlspecialchars($dato['nivel'], ENT_QUOTES )?>"
>
  <i class="bi bi-pencil-fill"></i>
</button>

          <p class="card-first-p"><?= htmlspecialchars($dato["nombre_programa"]) ?></p>
          <p> <?= htmlspecialchars($dato["nivel"]) ?></p>
        </div>
    <?php endwhile; ?>
    
    <?php else: ?>
      <p>No hay programas disponibles.</p>
  <?php endif; ?>
  
  </div>
</div>

<div class="modal-bg">
  <div class="editar-fichas-modal">
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <h1>Editar programa</h1>

    <form action="/SSA/functions/editarPrograma.php" method="POST">
      <label for="nombrePrograma">
        <h3>Nombre del programa</h3>
      </label>
      <input type="text" class="input_edit_program" id="nombrePrograma" name="nombre_programa" required>

      <input type="hidden" id="idPrograma" name="id_programa">

     

      <label for="nivel">
        <h3>Nivel</h3>
      </label>
      <select class="input_edit_program" id="nivel" name="nivel" required>
        <option value="tecnico">Técnico</option>
        <option value="tecnologo">Tecnólogo</option>
      </select>

      <input type="submit" id="submitInput">
    </form>
  </div>
</div>




<script src="./assets/js/modalEditarFicha.js"></script>