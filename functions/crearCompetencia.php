<?php
require '../db/conection.php'; // <-- corregida
file_put_contents('log.txt', print_r($_POST, true));

 if (!isset($_POST['id_programa']) || !is_numeric($_POST['id_programa'])) {
    echo "ID de programa no válido.";
    exit;
}

$idPrograma = (int) $_POST['id_programa'];
$competencia = $_POST['nombreCompetencia'] ?? '';
$horas = (int) ($_POST['horas'] ?? 0); // <-- casteado

if ($competencia === '' || $horas === 0) {
    http_response_code(400);
    echo "Faltan datos obligatorios.";
    exit;
}

$stmt = $conn->prepare("INSERT INTO competencias (nombre_competencia, total_horas, id_programa_formacion) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $competencia, $horas, $idPrograma);
if ($stmt->execute()) {
    $idCompetencia = $stmt->insert_id;

    // Imprimir HTML + JavaScript para mostrar mensaje y redirigir
    echo "
";

} else {
    http_response_code(500);
    echo "Error al registrar: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
