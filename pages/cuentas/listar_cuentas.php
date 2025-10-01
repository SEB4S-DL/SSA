<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    require "./functions/listarCuentas.php";
?>

<link rel="stylesheet" href="./assets/css/listar_cuentas.css">
<title><?= $traducciones['titulo_cuentas']?></title>


<div class="listar-cuentas-container">
    <div class="listar-cuentas-top-container">
        <h1><?= $traducciones['titulo_cuentas']?></h1>
        <?php if($_SESSION["user_rol"] == "admin"): ?>
        <button onclick="window.location.href = '.?page=cuentas/crear_usuario'"><?= $traducciones['crear_cuenta']?><i class="bi bi-plus-lg"></i></button>
        <?php endif; ?>
  </div>
    <div id="respuesta"></div>

  <?php if ($result->num_rows > 0): ?>
    <div class="grid">
    <?php while ($dato = $result->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href ='.?page=cuentas/info_user&usuario=<?= $dato['nro_documento']; ?>'">
            <p><strong><?= $traducciones['nombre']?>: </strong><?= $dato["nombre"]; ?></p>
            <p><strong><?= $traducciones['tipo']?>: </strong><?= $dato["tipo"]; ?></p>
            <p><strong><?= $traducciones['correo_institucional']?>: </strong><?= $dato["correo_institucional"]; ?></p>
            <p><strong><?= $traducciones['estado']?>: </strong><?= $dato["estado"]; ?></p>
            <?php if ($dato["rol"] !== 'admin'): ?>
            <?php if($_SESSION["user_rol"] == "admin"): ?>
            <form class="estadosForm" data-estado="<?= $dato["estado"] ?>">
                <input type="hidden" name="nro_documento" value="<?= $dato["nro_documento"] ?>">
                <input type="submit" class="btn-estado" value="<?= $dato["estado"] === 'habilitado' ? 'Deshabilitar' : 'Habilitar' ?>">
            </form>
            <?php endif; ?>
            <?php else: ?>
            <p style="color: green;"><strong>Administrador</strong></p>
            <?php endif; ?>
            
        </div>  
        
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>
<script src="/SSA/assets/js/estadoCuentas.js"></script>
