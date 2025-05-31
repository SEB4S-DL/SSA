<?php
// Incluir conexión a la base de datos
require_once("../db/conection.php");

// Validar que los datos llegan por POST (seguridad básica)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido.";
    exit;
}

// Validar campos obligatorios
if (
    !isset($_POST['id_competencia']) || !is_numeric($_POST['id_competencia']) ||
    !isset($_POST['nombre']) || empty(trim($_POST['nombre'])) ||
    !isset($_POST['horas']) || !is_numeric($_POST['horas'])
) {
    echo "Datos inválidos o incompletos.";
    exit;
}

// Sanitizar y asignar variables
$id_competencia = intval($_POST['id_competencia']);
$nombre = $conn->real_escape_string(trim($_POST['nombre']));
$horas = intval($_POST['horas']);

// Preparar la consulta UPDATE
$sql = "UPDATE competencias 
        SET nombre_competencia = '$nombre', total_horas = $horas 
        WHERE id = $id_competencia";

// Ejecutar la consulta y verificar resultado
if ($conn->query($sql) === TRUE) {
    // Éxito: redireccionar a la lista (o devolver JSON si usas AJAX)
    header("Location: ../?page=programas/listar_competencias&programa=" . $_POST['id_programa']);
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>
