<link rel="stylesheet" href="./assets/css/crear-competencia.css">
<?php 
$sql = "SELECT nombre_programa FROM programa_formacion";
$resultado = $conn->query($sql);
?>
<title>Crear programa</title>

<div class="container">
  <br>
    <div class="top-container">
      <h1>Crear competencia</h1>
      <button class="button-volver">
        Subir excel
        <i class="bi bi-file-earmark-spreadsheet"></i>
      </button>
    </div>
<br>  
  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre de la competencia</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre de la competencia" required>

    <label for="groupManager">Programa de formacion</label>
    <select name="jefe_grupo" id="groupManager" required>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <option value=""><?= htmlspecialchars($fila['nombre_programa']) ?></option>
    <?php endwhile; ?>
    </select>

    <label for="day">Total horas de la competencia</label>
      <input type="text" name="horas_competencia" placeholder="Ingrese las horas" required>
    

    <div class="buttons-container">
      <a href=".?page=programas/listar_competencias">
        Cancelar
      </a>

      <input type="submit" value="Crear competencia">
    </div>
  </form>
</div>