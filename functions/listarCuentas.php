<?php
if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

require './db/conection.php';

$sql = "SELECT nro_documento, nombre,rol, tipo, correo_institucional, estado FROM usuarios";

$result = $conn->query($sql);

$conn->close();
?>