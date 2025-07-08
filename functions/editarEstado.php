<?php
header('Content-Type: application/json');
require_once '../db/conection.php'; // Usamos solo esta

if (!isset($_POST['nro_documento']) || !isset($_POST['estado'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'mensaje' => 'Faltan parámetros']);
    exit;
}

$nro_documento = $_POST['nro_documento'];
$estado_actual = strtolower($_POST['estado']);
$nuevo_estado = ($estado_actual === 'habilitado') ? 'Deshabilitado' : 'Habilitado';

try {
    $stmt = $conn->prepare("UPDATE usuarios SET estado = ? WHERE nro_documento = ?");
    $stmt->bind_param("ss", $nuevo_estado, $nro_documento);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            'success' => true,
            'mensaje' => "Estado actualizado a $nuevo_estado"
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'mensaje' => "No se actualizó nada (¿usuario inexistente?)"
        ]);
    }

    $stmt->close();
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'mensaje' => 'Error en la base de datos',
        'detalle' => $e->getMessage()
    ]);
}
