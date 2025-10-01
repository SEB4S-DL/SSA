<?php
require_once("../db/conection.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido.";
    exit;
}

if (
    !isset($_POST['id_programa']) || !is_numeric($_POST['id_programa']) ||
    !isset($_POST['nombre_programa']) || empty(trim($_POST['nombre_programa'])) ||
    !isset($_POST['nivel']) || empty(trim($_POST['nivel']))
) {
    echo "Datos inválidos o incompletos.";
    exit;
}

$id_programa = intval($_POST['id_programa']);
$nombre = $conn->real_escape_string(trim($_POST['nombre_programa']));
$nivel = $conn->real_escape_string(trim($_POST['nivel']));


// Preparar la consulta UPDATE
$sql = "UPDATE programa_formacion 
        SET nombre_programa = '$nombre', nivel = '$nivel'  
        WHERE id = $id_programa";

// Ejecutar la consulta y verificar resultado
if ($conn->query($sql) === TRUE) {
    // Éxito: redireccionar a la lista (o devolver JSON si usas AJAX)
    header("Location: ../?page=programas/listar_programas");
    exit;
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>
