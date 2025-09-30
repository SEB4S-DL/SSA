<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
      exit;
  }

  // Si el usuario no es admin, redirigir a la página principal
  if ($_SESSION["user_rol"] != "admin"){
    echo "<meta http-equiv='refresh' content='0;url=./auth/login.php'>";
    exit;
  }
?>

<link rel="stylesheet" href="./assets/css/listar_programas.css">
<title><?= $traducciones['titulo_programas']?></title>

<?php   
    $sql = "SELECT id,nombre_programa,nivel from programa_formacion";

    $resultado = $conn->query($sql);

?>
<div class="listar-fichas-container">
  <div class="listar-fichas-top-container">
    <h1><?= $traducciones['titulo_programas']?></h1>
    <button onclick="window.location.href = '.?page=programas/crear_programa'"><?= $traducciones['btn_crear_programa']?> <i class="bi bi-plus-lg"></i></button>
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
      <p><?= $traducciones['advertencia_programas']?></p>
  <?php endif; ?>
  
  </div>
</div>

<div class="modal-bg">
  <div class="editar-fichas-modal">
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <h1><?= $traducciones['titulo_editar_programa']?></h1>

    <form action="/SSA/functions/editarPrograma.php" method="POST">
      <label for="nombrePrograma">
        <h3><?= $traducciones['nombre_programa']?></h3>
      </label>
      <input type="text" class="input_edit_program" id="nombrePrograma" name="nombre_programa" required>

      <input type="hidden" id="idPrograma" name="id_programa">

     

      <label for="nivel">
        <h3><?= $traducciones['nivel']?></h3>
      </label>
      <select class="input_edit_program" id="nivel" name="nivel" required>
        <option value="tecnico"><?= $traducciones['tecnico']?></option>
        <option value="tecnologo"><?= $traducciones['tecnologo']?></option>
      </select>

      <input type="submit" id="submitInput">
    </form>
  </div>
</div>
<script src="./assets/js/modalEditarFicha.js"></script>
