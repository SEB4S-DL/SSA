<?php
header('Content-Type: application/json');

require_once '../db/conection.php';

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

// Validación de sesión y rol
if (!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin")){
    header("Location: ../auth/login.php");
    exit();
}

// --- Funciones ---
function obtener_aprendices($ficha){
    global $conn;

    $sql = "SELECT a.nro_documento, a.tipo_documento, a.estado,
        CONCAT_WS(' ', a.nombre, a.segundo_nombre, a.apellido, a.segundo_apellido) AS nombre,
        a.cant_rae_aprobados, COUNT(r.id) AS total_rae
        FROM aprendices a
        JOIN fichas f ON f.nro_ficha = a.nro_ficha
        LEFT JOIN programa_formacion p ON f.id_programa_formacion = p.id
        LEFT JOIN competencias c ON c.id_programa_formacion = p.id
        LEFT JOIN resultados_aprendizaje r ON r.id_competencia = c.id
        WHERE a.nro_ficha = ?
        GROUP BY a.nro_documento";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);
    $stmt->execute();
    return $stmt->get_result();
}

function calcular_aprobado($aprendiz){
    $rae_actuales = $aprendiz["cant_rae_aprobados"];
    $total_rae = $aprendiz["total_rae"];

    if ($total_rae > 0){
        $total_aprobado = ($rae_actuales * 100) / $total_rae;
    } else {
        $total_aprobado = 0;
    }

    return round($total_aprobado, 2);
}

// --- Lógica ---
if (isset($_GET["ficha"])) {
    $ficha = intval($_GET["ficha"]);
    $result = obtener_aprendices($ficha);

    $labels = [];
    $values = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row["nombre"];
        $values[] = (int)$row["cant_rae_aprobados"];
    }

    echo json_encode([
        "labels" => $labels,
        "values" => $values
    ]);
} else {
    echo json_encode([
        "labels" => [],
        "values" => []
    ]);
}
