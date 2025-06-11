<?php
require '../db/conection.php'; // <-- corregida

$programa = $_POST['nombrePrograma'] ?? '';
$options = $_POST['nivel'] ?? '';
$horas = (int) ($_POST['horas'] ?? 0); // <-- casteado

if ($programa === '' || $options === '' || $horas === 0) {
    http_response_code(400);
    echo "Faltan datos obligatorios.";
    exit;
}

$stmt = $conn->prepare("INSERT INTO programa_formacion (nombre_programa, total_horas, nivel) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $programa, $horas, $options);

if ($stmt->execute()) {
    echo "Programa registrado con éxito.";
} else {
    http_response_code(500);
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
