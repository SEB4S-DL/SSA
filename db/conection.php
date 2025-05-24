<?php
$host = "localhost";      
$usuario = "root"; //Depende de su usuario
$contrasena = "123456"; //Depende de si tiene password o no
$base_datos = "ssa";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa";
?>
