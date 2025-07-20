<?php include_once __DIR__ . '/../../config.php'; ?>

<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<?php
if (!isset($_GET["programa"]) || !is_numeric($_GET["programa"])) {
    die("ID de programa no válido.");
}
$idPrograma = intval($_GET["programa"]);
?>
<?php
// Verificar si ya se importaron competencias
require_once __DIR__ . '/../../db/conection.php';

function ya_tiene_competencias($idPrograma) {
    global $conn;
    $sql = "SELECT 1 FROM competencias WHERE id_programa_formacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPrograma);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$yaImportado = ya_tiene_competencias($idPrograma);

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

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title><?= $traducciones['titulo_importar_competencias']?></title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    <?= $traducciones['titulo_importar_competencias']?>
  </h1>
  <button class="button-volver" onclick="window.location.href = '?page=programas/listar_competencias&programa=<?= $idPrograma ?>'">
      <i class="bi bi-arrow-left"></i> <?= $traducciones['volver']?>
  </button>
<br>
<br>

  <div class="warning-container">
    <div class="warning">
      <p><?= $traducciones['p1']?></p>


    <ul>
      <li><?= $traducciones['tipo_documento']?></li>
      <li>Número de documento</li>
      <li>Nombre</li>
      <li>Apellidos</li>
      <li>Estado</li>
      <li>Competencia</li>
      <li>Resultado de aprendizaje</li>
      <li>Juicio de evaluación</li>
      <li>Fecha y Hora del Juicio Evaluativo</li>
      <li>Funcionario que registro el juicio evaluativo</li>
    </ul>
    <br>
    <p>Cuando el excel cumpla con el formato especificado, debe convertirlo a CSV delimitado por punto y coma ( ; ) y luego subir acá el archivo csv.</p>
  <br>
    <p>A continuación se muestra una imágen con un formato adecuado para subir los aprendices con un excel.</p>
    </div>

    <div class="img-container" onclick="window.open('./assets/img/juicios-excel.png')">
      <div class="img-clickable">
        <span>Ver imágen</span>
      </div>
      <img src="./assets/img/juicios-excel.png" alt="Imágen con formato de excel" class="warning-image">
    </div>
  </div>
<br>
 <?php if ($yaImportado): ?>
  <div class="warning" style="color: red; font-weight: bold;">
    ⚠️ Ya se importaron competencias para este programa. No puedes volver a subir el archivo.
  </div>
<?php else: ?>
  <form id="importarCompetencias" enctype="multipart/form-data" class="importar-form">
    <input type="hidden" name="idprograma" value="<?= $idPrograma ?>">

    <label for="fileInput">Seleccionar archivo</label>
    <input type="file" name="excel" id="fileInput" accept=".csv" required>

    <input type="submit" value="Importar competencias">
    <a href="<?php echo BASE_URL ?>index.php?page=programas/listar_programas" class="btn-cancelar">Cancelar</a>
  </form>
  <?php endif; ?>


</div>
<div id="respuesta"></div>

<div class="img-modal--bg" id="imgModalBg">
  <span id="closeModal">
    <i class="bi bi-x-lg"></i>
  </span>
  <img src="./assets/img/formato-excel.png" alt="Imágen con formato de excel">
</div>

	<script src="<?php echo BASE_URL?>assets/js/modalImage.js"></script>
	<script src="<?php echo BASE_URL?>assets/js/importarCompetenciasForm.js"></script>
