<link rel="stylesheet" href="./assets/css/crear-programa.css">
<?php 
$sql = "SELECT nombre_programa FROM programa_formacion";
$resultado = $conn->query($sql);
?>
<title>Crear programa</title>

<div class="container">
  <br>
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_rae='">Volver</button>

  <h1>Crear competencia</h1>
<br>  
  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre de la competencia</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre de la competencia">

    <label for="groupManager">Programa de formacion</label>
    <select name="jefe_grupo" id="groupManager">
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <option value=""><?= htmlspecialchars($fila['nombre_programa']) ?></option>
    <?php endwhile; ?>
    </select>

    <label for="day">Total horas de la competencia</label>
      <input type="text">
    

    <div class="buttons-container">
      <a href="/SSA/pages/">
        Cancelar
      </a>

      <input type="submit" value="Crear competencia">
    </div>
  </form>
</div>