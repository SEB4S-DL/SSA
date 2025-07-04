<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    require "./functions/listarCuentas.php";
?>

<link rel="stylesheet" href="./assets/css/listar_cuentas.css">
<title>Listar cuentas</title>



<div class="listar-cuentas-container">
  <div class="listar-cuentas-top-container">
    <h1>Listado de Cuentas</h1>
    <button onclick="window.location.href = '.?page=cuentas/crear_usuario'">Crear Cuenta <i class="bi bi-plus-lg"></i></button>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid">
    <?php while ($dato = $result->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href ='.?page=cuentas/info_user&usuario=<?= $dato['nro_documento']; ?>'">
            <p><strong>Nombre: </strong><?= $dato["nombre"]; ?></p>
            <p><strong>Tipo: </strong><?= $dato["tipo"]; ?></p>
            <p><strong>Correo institucional: </strong><?= $dato["correo_institucional"]; ?></p>

        

        </div>
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>

