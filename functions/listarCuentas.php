<?php
if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit();
}

require './db/conection.php';

$sql = "SELECT nro_documento, nombre, tipo, correo_institucional FROM usuarios";

$result = $conn->query($sql);

$conn->close();
?>