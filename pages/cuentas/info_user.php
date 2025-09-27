<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    require "./functions/infoUser.php";

    if (!isset($_GET["usuario"])):
?>

<div>
    <p> No se proporciono un usuario valido.</p>
    <a href="?page=cuentas/listar_cuentas" style="color:blue"> <?= $traducciones['volver']?> </a>
</div>



<?php 
    exit();
    endif; 
?>

<link rel="stylesheet" href="./assets/css/info-user.css">
<title><?= $traducciones['visualizar_usuario']?></title>

<?php
    $usuario = obtener_usuario($_GET["usuario"]);
?>
<div class="visualizar-usuario">
  <div class="visualizar-usuario-top">
    <h1><?= $traducciones['visualizar_usuario']?></h1>
    <a href=".?page=cuentas/listar_cuentas" class="volver-button"><i class="bi bi-arrow-left"><?= $traducciones['volver']?></i></a>
   
    <button onclick="window.location.href = '.?page=cuentas/editar_info&usuario=<?= $usuario['nro_documento']; ?>'"> <?= $traducciones['editar']?> </button>
    

  </div>

    <div class="user-info">
        <div class="label"><?= $traducciones['nombre_completo']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['nombre'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['correo_institucional']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['correo_institucional'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['tipo_identificacion']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['tipo_documento'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['nro_identificacion']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['nro_documento'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['rol']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['rol'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['tipo_instructor']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['tipo'] ?? ""); ?></div>

        <div class="label"><?= $traducciones['modalidad_instructor']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['modalidad'] ?? ""); ?></div>
        
        <div class="label"><?= $traducciones['contraseña']?></div>
        <div class="value">********</div>
        
        <div class="label"><?= $traducciones['inicio_contrato']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['fecha_inicio_contrato'] ?? "Indefinido"); ?></div>
        
        <div class="label two-line"><?= $traducciones['fin_contrato']?></div>
        <div class="value"><?php echo htmlspecialchars($usuario['fecha_fin_contrato'] ?? "Indefinido"); ?></div>
    </div>
</div>
 