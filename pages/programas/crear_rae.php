<link rel="stylesheet" href="./assets/css/crear-rae.css">
<?php
$sql = "SELECT nombre_competencia FROM competencias";
$resultado = $conn->query($sql);
?>
<title>Crear RAE</title>

<div class="container">
  <br>
  <div class="top-container">
    <h1>Crear RAE</h1>
    <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_rae='">
      <i class="bi bi-arrow-left"></i>
      Volver
    </button>
  </div>

  <form action="" method="POST" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del RAE</label>
    <input type="text" name="numero_ficha" id="fichaNumber" placeholder="Ingrese el nombre del RAE" required>

    <label for="groupManager">Competencia</label>
    <select name="jefe_grupo" id="groupManager" required>
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <option value=""><?= htmlspecialchars($fila['nombre_competencia']) ?></option>
    <?php endwhile; ?>
    </select>

    <label for="day">Total horas del RAE</label>
      <input type="text" name="horas_rae" placeholder="Ingrese las horas" required>
    

    <div class="buttons-container">
      <a href=".?page=programas/listar_rae">
        Cancelar
      </a>

      <input type="submit" value="Crear RAE">
    </div>

  </form>
</div>