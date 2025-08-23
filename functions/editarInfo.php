<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
    $contrasena = $_POST["contrasena"];
    $fecha_inicio = $_POST["fecha_inicio"] !== '' ? $_POST["fecha_inicio"] : null;
    $fecha_fin = $_POST["fecha_fin"] !== '' ? $_POST["fecha_fin"] : null;
    $estado = $_POST["estado"];

    // Encriptar la contraseña si no está vacía
    $contrasena_encriptada = !empty($contrasena) ? md5($contrasena) : '';

    // ID del usuario
    $id_usuario = $_SESSION["user_id"];

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
    contrasena = IF(? != '', ?, contrasena),
    fecha_inicio_contrato = ?,
    fecha_fin_contrato = ?,
    estado = ?
    WHERE nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssisssssssi",
        $primer_nombre,
        $segundo_nombre,
        $primer_apellido,
        $segundo_apellido,
        $correo,
        $tipo_identificacion,
        $numero_identificacion,
        $rol,
        $tipo_instructor,
        $contrasena_encriptada,
        $contrasena_encriptada,
        $fecha_inicio,
        $fecha_fin,
        $estado,
        $numero_identificacion
    );

    if ($stmt->execute()) {
        header("refresh:3, ../index.php?page=cuentas/info_user&usuario=". $numero_identificacion);
        echo "<script>alert('Información actualizada correctamente . Se le redireccionara dentro de 3 segundos');</script>";
        exit;
    } else {
        header("refresh:3, ../index.php?page=cuentas/info_user&usuario=". $numero_identificacion);
        echo "<script>alert('Error al actualizar la información. Se le redireccionara dentro de 3 segundos');</script>";
    }

    $stmt->close();
    $conn->close();
}


function obtener_usuario($usuario){
    global $conn;

    $sql = "SELECT * FROM usuarios WHERE nro_documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();


    $resultado = $resultado->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $resultado;
}
?>