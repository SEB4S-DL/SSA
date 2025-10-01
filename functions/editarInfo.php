<?php 
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] != "POST"){
    echo json_encode([
        "msg" => "Método HTTP no válido.",
        "state" => 1
    ]);
    exit();
}
session_start();

require_once "../db/conection.php";

$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$correo = $_POST["correo"];
$tipo_identificacion = $_POST["tipo_identificacion"];
$numero_identificacion = $_POST["nro_documento"];
$rol = $_POST["rol"];
$tipo_instructor = $_POST["tipo_instructor"];
$modalidad_instructor = $_POST["modalidad_instructor"];
$contrasena = $_POST["contrasena"];
$fecha_inicio = $_POST["fecha_inicio"] !== '' ? $_POST["fecha_inicio"] : null;
$fecha_fin = $_POST["fecha_fin"] !== '' ? $_POST["fecha_fin"] : null;
$estado = $_POST["estado"];
$email_anterior = $_POST["email_anterior"];
$documento_anterior = $_POST["documento_anterior"];

// VALIDACIONES

// Si el documento ingresado es diferente al que había antes, verificar si ya existe un usuario con el numero de documento ingresado
if ($numero_identificacion != $documento_anterior){
    if (existe_usuario($numero_identificacion)){
        echo json_encode([
            "msg" => "Ya existe un usuario con el número de documento '$numero_identificacion'.",
            "state" => 1
        ]);
        exit();
    }
}

// Si el correo ingresado es diferente al que había antes, verificar si ya existe un usuario con el correo ingresado
if ($correo != $email_anterior){
    if (existe_usuario_email($correo)){
        echo json_encode([
            "msg" => "Ya existe un usuario con el correo ingresado.",
            "state" => 1
        ]);
        exit();
    }
}

// Verificar si el número de documento es numérico y contiene entre 1 y 10 digitos
if (preg_match("/^\d{1,10}$/", $numero_identificacion) != 1){
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
if (!fechas_validas($fecha_inicio, $fecha_fin)){
    echo json_encode([
        "msg" => "Las fechas deben ser coherentes.",
        "state" => 1
    ]);
    exit();
}

// Encriptar la contraseña si no está vacía
$contrasena_encriptada = !empty($contrasena) ? md5($contrasena) : '';

$sql = "UPDATE usuarios SET 
nombre = ?,
segundo_nombre = ?,
apellido = ?,
segundo_apellido = ?,
correo_institucional = ?,
tipo_documento = ?,
nro_documento = ?,
rol = ?,
tipo = ?,
modalidad = ?,
contrasena = IF(? != '', ?, contrasena),
fecha_inicio_contrato = ?,
fecha_fin_contrato = ?,
estado = ?
WHERE nro_documento = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssissssssssi",
    $primer_nombre,
    $segundo_nombre,
    $primer_apellido,
    $segundo_apellido,
    $correo,
    $tipo_identificacion,
    $numero_identificacion,
    $rol,
    $tipo_instructor,
    $modalidad_instructor,
    $contrasena_encriptada,
    $contrasena_encriptada,
    $fecha_inicio,
    $fecha_fin,
    $estado,
    $documento_anterior
);

if (!$stmt->execute()) {
    echo json_encode([
        "msg" => "Ocurrió un error al actualizar la información. Por favor intente nuevamente.",
        "state" => 1
    ]);
    exit();
}

echo json_encode([
    "msg" => "Información actualizada correctamente.",
    "state" => 0
]);
exit();

$stmt->close();
$conn->close();


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