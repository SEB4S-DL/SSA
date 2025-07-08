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
    <div id="respuesta"></div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid">
    <?php while ($dato = $result->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href ='.?page=cuentas/info_user&usuario=<?= $dato['nro_documento']; ?>'">
            <p><strong>Nombre: </strong><?= $dato["nombre"]; ?></p>
            <p><strong>Tipo: </strong><?= $dato["tipo"]; ?></p>
            <p><strong>Correo institucional: </strong><?= $dato["correo_institucional"]; ?></p>
            <p><strong>Estado: </strong><?= $dato["estado"]; ?></p>
            <?php if ($dato["rol"] !== 'admin'): ?>
            <form class="estadosForm" data-estado="<?= $dato["estado"] ?>">
                <input type="hidden" name="nro_documento" value="<?= $dato["nro_documento"] ?>">
                <input type="submit" class="btn-estado" value="<?= $dato["estado"] === 'habilitado' ? 'Deshabilitar' : 'Habilitar' ?>">
            </form>
            <?php else: ?>
            <p style="color: green;"><strong>Administrador protegido</strong></p>
            <?php endif; ?>
            
        </div>  
        
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>
<script src="/SSA/assets/js/estadoCuentas.js"></script>
