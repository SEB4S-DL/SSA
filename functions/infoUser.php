<?php 
if (session_status() === PHP_SESSION_NONE){
    session_start();
}

if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

// Incluir la conexion 
require_once "./db/conection.php";

function existe_Usuario($usuario){
    global $conn;

    $sql = 'select nro_documento from aprendices where nro_documento = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();

    $result = $stmt->get_result();

    var_dump($result->fetch_assoc());

    if ($result->num_rows > 0){
        return true;
    }
 else return false;
}

function obtener_usuario($usuario){
    global $conn;

    $sql = "SELECT CONCAT_WS(' ', nombre, segundo_nombre, apellido, segundo_apellido) AS 'nombre', correo_institucional, tipo_documento, nro_documento, rol, tipo, modalidad, fecha_inicio_contrato, fecha_fin_contrato FROM usuarios WHERE nro_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $resultado = $resultado->fetch_assoc();

    return $resultado;
}
?>
