<link rel="stylesheet" href="./assets/css/crear-rae.css">
<?php
$sql = "SELECT nombre_competencia FROM competencias";
$resultado = $conn->query($sql);
?>
<title>Crear RAE</title>

<div class="container">
  <br>
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_rae='">Volver</button>

  <h1>Crear RAE</h1>
<br>  
  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del RAE</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre del RAE">

    <label for="groupManager">Competencia</label>
    <select name="jefe_grupo" id="groupManager">
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <option value=""><?= htmlspecialchars($fila['nombre_competencia']) ?></option>
    <?php endwhile; ?>
    </select>

    <label for="day">Total horas del RAE</label>
      <input type="text">
    

    <div class="buttons-container">
      <a href="/SSA/pages/programas/listar_rae.php">
        Cancelar
      </a>

      <input type="submit" value="Crear RAE">
    </div>
  </form>
</div>