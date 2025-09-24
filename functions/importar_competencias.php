<?php
ini_set('display_errors', 0);   // que no los muestre
ini_set('log_errors', 1);       // que sí los guarde en el log
ini_set('html_errors', 0);      // nada de <br /><b> en los mensajes
error_reporting(E_ALL);         // pero sí loguear todo

require_once '../db/conection.php';

header('Content-Type: application/json');

$response = [
  'status' => 'error',
  'mensaje' => 'Error desconocido',
];

try {
  // Validar archivo
  if (!isset($_FILES['excel']) || $_FILES['excel']['error'] !== 0) {
    throw new Exception("Archivo no recibido o con errores");
  }

  // Validar id_programa_formacion
  $id_programa = isset($_POST['idprograma']) ? intval($_POST['idprograma']) : null;
  if (!$id_programa) {
    throw new Exception("ID del programa no recibido");
  }

  $archivo_ruta = $_FILES['excel']['tmp_name'];

  $archivo = fopen($archivo_ruta, "r");
  stream_filter_append($archivo, "convert.iconv.Windows-1252/UTF-8");

  if (!$archivo) {
    throw new Exception("Error al leer el archivo");
  }

  fgetcsv($archivo, 0, ";"); // Saltar encabezado

  $raes = [];

  while ($linea = fgetcsv($archivo, 0, ";")) {
    if (count($linea) < 2) continue;

    $raes[] = [trim($linea[0]), trim($linea[1])];
  }

  foreach ($raes as $rae) {
    $nombre_competencia = $rae[0];
    $nombre_rae = $rae[1];

    if (!$nombre_competencia || !$nombre_rae) continue;

    if (!existe_competencia($nombre_competencia, $id_programa)) {
      $id_comp = agregar_competencia($nombre_competencia, $id_programa);
    } else {
      $id_comp = obtener_id_competencia($nombre_competencia, $id_programa);
    }

    if ($id_comp) {
      agregar_rae($nombre_rae, $id_comp);
    }
  }

  $response['status'] = 'success';
  $response['mensaje'] = '✅ Importación completada con éxito';
} catch (Exception $e) {
  $response['mensaje'] = '❌ Error: ' . $e->getMessage();
}

echo json_encode($response);

// ========== FUNCIONES ==========

function agregar_competencia($competencia, $id_programa) {
  global $conn;
  $sql = "INSERT INTO competencias (nombre_competencia, id_programa_formacion) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $competencia, $id_programa);
  $stmt->execute();
  return $conn->insert_id;
}

function agregar_rae($rae, $id_competencia) {
  global $conn;

  // Evitar duplicados de RAEs
  $sql = "SELECT 1 FROM resultados_aprendizaje WHERE nombre_rae = ? AND id_competencia = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $rae, $id_competencia);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    $sql = "INSERT INTO resultados_aprendizaje (nombre_rae, id_competencia) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $rae, $id_competencia);
    $stmt->execute();
  }
}

function existe_competencia($competencia, $id_programa) {
  global $conn;
  $sql = "SELECT 1 FROM competencias WHERE nombre_competencia = ? AND id_programa_formacion = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $competencia, $id_programa);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->num_rows > 0;
}

function obtener_id_competencia($nombre_competencia, $id_programa) {
  global $conn;
  $sql = "SELECT id FROM competencias WHERE nombre_competencia = ? AND id_programa_formacion = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $nombre_competencia, $id_programa);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  return $row ? $row['id'] : null;
}
