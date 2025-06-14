<?php
require __DIR__ . '/vendor/autoload.php';
require_once '../db/conection.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_FILES['archivo_excel']) || $_FILES['archivo_excel']['error'] !== 0) {
    die("Error al subir el archivo.");
}


// Cargar archivo Excel
$archivo = $_FILES['archivo_excel']['tmp_name'];
$documento = IOFactory::load($archivo);
$hoja = $documento->getActiveSheet();
$filas = $hoja->toArray();

foreach ($filas as $i => $fila) {
    if ($i === 0) continue; // Saltar encabezado

    $nombre = $mysqli->real_escape_string($fila[0]);
    $correo = $mysqli->real_escape_string($fila[1]);
    $edad   = (int)$fila[2];

    $mysqli->query("INSERT INTO usuarios (nombre, correo, edad) 
                    VALUES ('$nombre', '$correo', $edad)");
}

echo "Importación exitosa!";
?>
