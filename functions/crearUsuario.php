<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit;
}

// Incluir la conexión a la base de datos
require_once "../db/conection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $primer_nombre = $_POST["primer_nombre"];
    $segundo_nombre = $_POST["segundo_nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $correo = $_POST["correo"];
    $tipo_documento = $_POST["tipo_documento"];
    $numero_documento = $_POST["numero_documento"];
    $rol = $_POST["rol"];
    $tipo_instructor = $_POST["tipo_instructor"];
    $contrasena_plana = $_POST["contrasena"];
    $fecha_inicio_contrato = $_POST["fecha_inicio_contrato"];
    $fecha_fin_contrato = $_POST["fecha_fin_contrato"];

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

    if (existe_usuario($numero_documento)){
        header("Refresh: 3, ../index.php?page=cuentas/listar_cuentas");
        echo"<script>alert('ya existe un usuario registrado')</script>";
        exit;
    }



    // verificar contraseña  
    if (strlen($contrasena_plana) < 8) {
        header("Refresh: 3, ../index.php?page=cuentas/listar_cuentas");
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres')</script>";
        exit;
    }

    $contrasena = md5($contrasena_plana);

    // Verificar si el número de documento es numérico y contiene entre 1 y 10 digitos

    if (preg_match("/^\d{1,10}$/", $numero_documento) != 1){
        header("Refresh: 3, ../index.php?page=cuentas/listar_cuentas");
        echo "<script>alert('El número de documento no es válido')</script>";
        exit;
    }

    // Verificar si el correo es válido ("soy.sena.edu.co" o "misena.edu.co")

    $correo_valido1 = "/^\w+@soy.sena.edu.co$/";
    $correo_valido2 = "/^\w+@misena.edu.co$/";

    $correo_valido = false;
 
    if (preg_match($correo_valido1, $correo) === 1 || preg_match($correo_valido2, $correo) === 1){
        $correo_valido = true;
    }

    if (!$correo_valido){
        header("Refresh: 3, ../index.php?page=cuentas/listar_cuentas");
        echo"<script>alert('El correo no es válido (debe ser institucional)')</script>";
        exit;
    }

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
        contrasena,
        fecha_inicio_contrato,
        fecha_fin_contrato
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "ssssssisssss",
            $primer_nombre,
            $segundo_nombre,
            $primer_apellido,
            $segundo_apellido,
            $correo,
            $tipo_documento,
            $numero_documento,
            $rol,
            $tipo_instructor,
            $contrasena,
            $fecha_inicio_contrato,
            $fecha_fin_contrato
        );

        if ($stmt->execute()) {
            header("refresh:3, ../index.php?page=cuentas/listar_cuentas");
            echo "<script>alert('Usuario creado exitosamente');</script>";
        } else {
            header("refresh:3, ../index.php?page=cuentas/listar_cuentas");
            echo "<script>alert('Error al crear el usuario');</script>";
        }
        
            $stmt->close();
            $conn->close();
    }

    else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}
?>
