<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/SSA/assets/css/styleHeader.css">
    <link rel="stylesheet" href="/SSA/assets/css/styleSideBar.css">
    <link rel="stylesheet" href="/SSA/assets/css/styleIndex.css">
    <title>Inicio</title>
</head>
<body>
    <?php require_once './db/conection.php'?>
    <?php include './includes/sidebar.php'?>
    <?php include './includes/header.php'?>
    <?php   
        $sql = "SELECT nro_ficha,tipo_oferta FROM fichas"; //nivel de formacion, tecnico o tecnologo, join con tabla programa_formacion
        $resultado = $conn->query($sql);
        
        echo '<div class="contenedor">';

        if ($resultado->num_rows > 0) {
            while($dato = $resultado->fetch_assoc()) {
                echo '<div class="card">';
                echo '<button>ed</button>';
                echo '<h3>' . htmlspecialchars($dato[""]) . '</h3>';
                echo '<p>' . htmlspecialchars("Ficha: " . $dato["nro_ficha"]) . '</p>';
                echo '<p>' . htmlspecialchars("Oferta: " . $dato["tipo_oferta"]) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No hay fichas disponibles.</p>";
        }

        echo '</div>';

        ?>
        
    </div>
    

</body>
</html>