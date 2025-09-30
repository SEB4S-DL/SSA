<?php
if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

require './db/conection.php';

if ($_SESSION["user_rol"] === "admin"){
    $sql = "SELECT nro_documento, nombre,rol, tipo, correo_institucional, estado FROM usuarios";
}
else{
    $sql = "SELECT nro_documento, nombre,rol, tipo, correo_institucional, estado FROM usuarios WHERE nro_documento = " . $_SESSION["user_id"];
}

$result = $conn->query($sql);

$conn->close();
?>