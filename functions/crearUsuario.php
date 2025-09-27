<?php
session_start();

header("Content-Type: application/json; charset=utf-8");

if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] != "POST"){
    echo json_encode([
        "msg" => "Método http inválido.",
        "state" => 1
    ]);
    exit();
}

// Incluir la conexión a la base de datos
require_once "../db/conection.php";

// Recuperar datos
$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$correo = $_POST["correo"];
$tipo_documento = $_POST["tipo_documento"];
$numero_documento = $_POST["numero_documento"];
$rol = $_POST["rol"];
$tipo_instructor = $_POST["tipo_instructor"];
$modalidad_instructor = $_POST["modalidad_instructor"];
$contrasena_plana = $_POST["contrasena"];
$fecha_inicio_contrato = !empty($_POST["fecha_inicio_contrato"]) ? $_POST["fecha_inicio_contrato"] : null;
$fecha_fin_contrato = !empty($_POST["fecha_fin_contrato"]) ? $_POST["fecha_fin_contrato"] : null;

// Verificar si ya existe un usuario con el numero de documento ingresado
if (existe_usuario($numero_documento)){
    echo json_encode([
        "msg" => "Ya existe un usuario con el número de documento '$numero_documento'.",
        "state" => 1
    ]);
    exit();
}

// Verificar si ya existe un usuario con el correo ingresado
if (existe_usuario_email($correo)){
    echo json_encode([
        "msg" => "Ya existe un usuario con el correo ingresado.",
        "state" => 1
    ]);
    exit();
}

$contrasena = md5($contrasena_plana);

// Verificar si el número de documento es numérico y contiene entre 1 y 10 digitos

if (preg_match("/^\d{1,10}$/", $numero_documento) != 1){
    echo json_encode([
        "msg" => "El número de documento no es válido.",
        "state" => 1
    ]);
    exit();
}

// Verificar si el correo es válido
$correo_valido = false;

if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
    $correo_valido = true;
}

if (!$correo_valido){
    echo json_encode([
        "msg" => "El correo ingresado no es un correo válido",
        "state" => 1
    ]);
    exit();
}

// Validar que las fechas seán coherentes
if (!fechas_validas($fecha_inicio_contrato, $fecha_fin_contrato)){
    echo json_encode([
        "msg" => "Las fechas deben ser coherentes.",
        "state" => 1
    ]);
    exit();
}

$estado = 1; // Inicializar el usuario como habilitado


$sql = "INSERT INTO usuarios (
nombre,
segundo_nombre,
apellido,
segundo_apellido,
correo_institucional,
tipo_documento,
nro_documento,
rol,
tipo,
modalidad,
contrasena,
fecha_inicio_contrato,
fecha_fin_contrato,
estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param(
    "ssssssissssssi", 
    $primer_nombre,
    $segundo_nombre,
    $primer_apellido,
    $segundo_apellido,
    $correo,
    $tipo_documento,
    $numero_documento,
    $rol,
    $tipo_instructor,
    $modalidad_instructor,
    $contrasena,
    $fecha_inicio_contrato,
    $fecha_fin_contrato,
    $estado);

    if ($stmt->execute()) {
        echo json_encode([
            "msg" => "Usuario creado exitosamente.",
            "state" => 0
        ]);
        exit();

    } else {
        echo json_encode([
            "msg" => "Ocurrió un error inesperado. Intente de nuevo más tarde.",
            "state" => 1
        ]);
        exit();
    }

    $stmt->close();
    $conn->close();
}

else {
    echo json_encode([
        "msg" => "Ocurrió un error inesperado. Intente de nuevo más tarde.",
        "state" => 1
    ]);
    exit();
}

// Funciones

function existe_usuario($usuario){
    global $conn;

    $sql = "select * from usuarios where nro_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result(); 

    if( $resultado->num_rows > 0 ){
        return true ; 
    }else{
        return false;
    }
}

function existe_usuario_email($email){
    global $conn;

    $sql = "select * from usuarios where correo_institucional = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0){
        return true;
    }
    else{
        return false;
    }
}

// Función para validar que las fechas tengan coherencia
function fechas_validas($fecha_inicio, $fecha_fin){
    return $fecha_fin >= $fecha_inicio;
}
?>
