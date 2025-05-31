<!-- Enlace a los estilos de esta página -->
<link rel="stylesheet" href="./assets/css/listar-rae.css">

<!-- Título del documento -->
<title>Listar RAE'S</title>

<?php
// Validar si se envió el parámetro 'competencia' por GET y asegurarse que sea numérico
if (!isset($_GET["competencia"]) || !is_numeric($_GET["competencia"])) {
    echo "<p style='color:red;'>ID de competencia no válido o no enviado.</p>";
    exit; // Detener ejecución si no hay un ID válido
}

// Convertir el ID recibido a entero para evitar inyecciones SQL
$competencia = intval($_GET["competencia"]);

// Incluir el archivo de conexión a la base de datos
require_once("./db/conection.php"); // Asegúrate que la ruta sea correcta

// Consultar el ID del programa relacionado con la competencia dada
$sql_programa = "SELECT id_programa_formacion FROM competencias WHERE id = $competencia";
$res_programa = $conn->query($sql_programa);

// Verificar si se encontró la competencia
if (!$res_programa || $res_programa->num_rows === 0) {
    echo "<p style='color:red;'>No se pudo encontrar el programa asociado a la competencia.</p>";
    exit;
}

// Obtener el ID del programa asociado
$programa = $res_programa->fetch_assoc();
$id_programa = intval($programa['id_programa_formacion']);

// Consultar los resultados de aprendizaje asociados a la competencia
$sql = "SELECT * FROM resultados_aprendizaje WHERE id_competencia = $competencia";
$resultado = $conn->query($sql);

// Validar si la consulta se ejecutó correctamente
if (!$resultado) {
    echo "<p style='color:red;'>Error en la consulta: " . $conn->error . "</p>";
    exit;
}
?>

<!-- Contenedor general -->
<div class="listar-fichas-container">

  <!-- Parte superior con título y botones -->
  <div class="listar-fichas-top-container">
    <h1>Listado de resultados de aprendizaje</h1>

    <!-- Botón para volver a la lista de competencias del programa correspondiente -->
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_competencias&programa=<?= $id_programa ?>'">
      <i class="bi bi-arrow-left"></i>
      Volver
    </button>

    <!-- Botón para ir a la creación de un nuevo RAE -->
    <button class="action-button" onclick="window.location.href = '.?page=programas/crear_rae'">
      Crear RAE <i class="bi bi-plus-lg"></i>
    </button>
  </div>

  <!-- Contenedor para los datos -->
  <div class="contenedor">
    <?php if ($resultado->num_rows > 0): ?>
      <!-- Si hay resultados, se muestra la tabla -->
      <div class="table-container">

        <!-- Encabezados de la tabla -->
        <div class="table-row">
          <div>Resultado de aprendizaje</div>
          <div>Horas</div>
        </div>

        <!-- Iterar sobre los resultados obtenidos -->
        <?php while($dato = $resultado->fetch_assoc()): ?>
          <div class="table-row">
            <div><?= htmlspecialchars($dato["nombre_rae"]) ?></div>
            <div><?= htmlspecialchars($dato["total_horas"]) ?></div>
          </div>
        <?php endwhile; ?>

      </div>
    <?php else: ?>
      <!-- Si no hay RAEs registrados -->
      <p>No hay resultados de aprendizaje disponibles.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Modal para editar RAE (todavía sin funcionalidad de backend) -->
<div class="modal-bg">
  <div class="editar-fichas-modal">

    <!-- Botón para cerrar el modal -->
    <span class="exitModal"><i class="bi bi-x-lg"></i></span>

    <!-- Título del modal -->
    <h1>Editar RAE</h1>

    <!-- Formulario de edición -->
    <form action="/functions/editarRae.php" method="POST">
      <!-- Campo para editar nombre del RAE -->
      <label for="nombreCompetencia">
        <h3>Nombre del RAE</h3>
      </label>
      <input type="text" class="input_edit_program" id="nombreCompetencia" placeholder="">

      <!-- Campo para editar horas del RAE -->
      <label for="cantidadHoras">
        <h3>Cantidad de horas</h3>
      </label>
      <input type="text" class="input_edit_program" id="cantidadHoras" placeholder="Ingrese la cantidad de horas">

      <!-- Botón para enviar el formulario -->
      <input type="submit" value="Editar RAE">
    </form>
  </div>
</div>

<!-- Script para el comportamiento del modal (abrir/cerrar) -->
<script src="./assets/js/modalEditarFicha.js"></script>
