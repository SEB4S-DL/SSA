<?php
require '../db/conection.php'; // <-- corregida

$programa = $_POST['nombrePrograma'] ?? '';
$options = $_POST['nivel'] ?? '';

if ($programa === '' || $options === '') {
    http_response_code(400);
    echo "Faltan datos obligatorios.";
    exit;
}

$stmt = $conn->prepare("INSERT INTO programa_formacion (nombre_programa,nivel) VALUES (?, ?)");
$stmt->bind_param("ss", $programa, $options);

if ($stmt->execute()) {
    echo "Programa registrado con éxito.";
} else {
    http_response_code(500);
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
