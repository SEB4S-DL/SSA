<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/listar-competencias.css">
<title>Listar competencias</title>

<?php
if (!isset($_GET["programa"]) || !is_numeric($_GET["programa"])) {
    echo "<p style='color:red;'>ID de competencia no válido o no enviado.</p>";
    exit;
}

$idPrograma = $_GET['id']; // <- guardamos el ID

$programa_id = intval($_GET["programa"]); // seguridad básica
$sql = $sql = "SELECT 
            c.id, 
            c.nombre_competencia, 
            COUNT(r.id) AS cant_rae, 
            c.total_horas 
        FROM competencias c 
        LEFT JOIN resultados_aprendizaje r 
            ON r.id_competencia = c.id 
        WHERE c.id_programa_formacion = " . intval($_GET["programa"]) . " 
        GROUP BY c.id";


$resultado = $conn->query($sql);

if (!$resultado) {
    echo "<p style='color:red;'>Error en la consulta: " . $conn->error . "</p>";
    exit;
}
?>

<div class="listar-fichas-container">
  <div class="listar-fichas-top-container">
    <h1>Listado de competencias</h1>
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_programas'">
      <i class="bi bi-arrow-left"></i>
      Volver
    </button>
    <button class="crear-button" onclick="window.location.href = '.?page=programas/crear_competencia&id=<?= $programa_id ?>'">
  Crear competencia <i class="bi bi-plus-lg"></i>
</button>

  </div>
      
  <div class="contenedor">
  
  <?php if ($resultado->num_rows > 0): ?>
      <?php while($dato = $resultado->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href = '.?page=programas/listar_rae&competencia=<?= $dato['id']; ?>'">
          <button
            onclick="event.stopPropagation()"
            title="Editar competencia"
            class="editarTrigger"
            data-tipo="competencia"
            data-id="<?= $dato['id'] ?>"
            data-nombre="<?= htmlspecialchars($dato['nombre_competencia'], ENT_QUOTES) ?>"
            data-horas="<?= htmlspecialchars($dato['total_horas'], ENT_QUOTES) ?>"
          >
            <i class="bi bi-pencil-fill"></i>
          </button>

          <p class="card-first-p"><?= htmlspecialchars($dato["nombre_competencia"]) ?></p>

          <p><strong>Horas:</strong> <?= htmlspecialchars($dato["total_horas"]) ?></p>

          <p>
            <strong>
              RAE:
            </strong>
            <?= $dato["cant_rae"] ?>
          </p>
        </div>
    <?php endwhile; ?>
    
    <?php else: ?>
      <p>No hay competencias disponibles.</p>
  <?php endif; ?>
  
  </div>
</div>


<div class="modal-bg">
  <div class="editar-fichas-modal">
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <h1>Editar competencia</h1>

    <form action="/SSA/functions/editarCompetencia.php" method="POST">
  <input type="hidden" name="id_competencia" id="idCompetencia" required>
  <input type="hidden" name="id_programa" id="idPrograma" value="<?= $programa_id ?>">

  <label for="nombreCompetencia">
    <h3>Nombre de la competencia</h3>
  </label>
  <input type="text" class="input_edit_program" id="nombreCompetencia" name="nombre" placeholder="Ingrese el nombre" required>

  <label for="cantidadHoras">
    <h3>Cantidad de horas</h3>
  </label>
  <input type="text" class="input_edit_program" id="cantidadHoras" name="horas" placeholder="Ingrese la cantidad de horas" required>

  <input type="submit" id="submitInput">
</form>

  </div>
</div>

<script src="./assets/js/modalEditarFicha.js"></script>