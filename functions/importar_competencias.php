<?php
// Mostrar errores en pantalla (dev only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validar ID del programa
if (!isset($_POST['programa']) || !is_numeric($_POST['programa'])) {
    die("ID del programa no válido o no enviado.");
}
$idPrograma = intval($_POST['programa']);

// Validar archivo subido
if (!isset($_FILES['excel']) || $_FILES['excel']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo CSV.");
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "ssa");
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Abrir archivo CSV subido
$archivo = fopen($_FILES['excel']['tmp_name'], "r");
if (!$archivo) {
    die("Error al leer el archivo CSV.");
}

// Convertir a UTF-8
stream_filter_append($archivo, "convert.iconv.Windows-1252/UTF-8");

// Saltar encabezado
fgetcsv($archivo, 0, ";");

// Leer filas
$raes = [];
while ($linea = fgetcsv($archivo, 0, ";")) {
    if (count($linea) >= 2) {
        $raes[] = [$linea[0], $linea[1]];
    }
}
fclose($archivo);

// Insertar en la base de datos
foreach ($raes as $rae) {
    [$nombreComp, $nombreRae] = $rae;

    if (!existe_competencia($nombreComp, $idPrograma)) {
        $id_comp = agregar_competencia($nombreComp, $idPrograma);
    } else {
        $id_comp = obtener_id_competencia($nombreComp, $idPrograma);
    }

    if ($id_comp !== null) {
        agregar_rae($nombreRae, $id_comp);
    }
}

// --- Funciones ---

function agregar_competencia($competencia, $idPrograma) {
    global $conn;
    $sql = "INSERT INTO competencias (nombre_competencia, id_programa_formacion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $competencia, $idPrograma);
    $stmt->execute();
    return $conn->insert_id;
}

function obtener_id_competencia($nombre, $idPrograma) {
    global $conn;
    $sql = "SELECT id FROM competencias WHERE nombre_competencia = ? AND id_programa_formacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre, $idPrograma);
    $stmt->execute();
    $result = $stmt->get_result();
    $fila = $result->fetch_assoc();
    return $fila['id'] ?? null;
}

function agregar_rae($rae, $id_competencia) {
    global $conn;
    $sql = "INSERT INTO resultados_aprendizaje (nombre_rae, id_competencia) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $rae, $id_competencia);
    $stmt->execute();
}

function existe_competencia($competencia, $idPrograma) {
    global $conn;
    $sql = "SELECT 1 FROM competencias WHERE nombre_competencia = ? AND id_programa_formacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $competencia, $idPrograma);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>
