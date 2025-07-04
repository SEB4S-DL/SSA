<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    require "./functions/infoUser.php";

    if (!isset($_GET["usuario"])):
?>

<div>
    <p> No se proporciono un usuario valido.</p>
    <a href="?page=cuentas/listar_cuentas" style="color:blue"> Volver </a>
</div>

<a href="">Volver</a>

<?php 
    exit();
    endif; 
?>

<link rel="stylesheet" href="./assets/css/info-user.css">
<title>Visualizar usuario</title>

<?php
    $usuario = obtener_usuario($_GET["usuario"]);
?>
<div class="visualizar-usuario">
  <div class="visualizar-usuario-top">
    <h1>Visualizar usuario</h1>
    <a href=".?page=cuentas/listar_cuentas" class="volver-button"><i class="bi bi-arrow-left"></i></a>
   
    <button onclick="window.location.href = '.?page=cuentas/editar_info&usuario=<?= $usuario['nro_documento']; ?>'"> Editar </button>
    

  </div>

    <div class="user-info">
        <div class="label">Nombre completo</div>
        <div class="value"><?php echo htmlspecialchars($usuario['nombre'] ?? ""); ?></div>
        
        <div class="label">Correo institucional</div>
        <div class="value"><?php echo htmlspecialchars($usuario['correo_institucional'] ?? ""); ?></div>
        
        <div class="label">Tipo de identificación</div>
        <div class="value"><?php echo htmlspecialchars($usuario['tipo_documento'] ?? ""); ?></div>
        
        <div class="label">Nro de identificación</div>
        <div class="value"><?php echo htmlspecialchars($usuario['nro_documento'] ?? ""); ?></div>
        
        <div class="label">Rol (usuario/administrador)</div>
        <div class="value"><?php echo htmlspecialchars($usuario['rol'] ?? ""); ?></div>
        
        <div class="label">Tipo instructor</div>
        <div class="value"><?php echo htmlspecialchars($usuario['tipo'] ?? ""); ?></div>
        
        <div class="label">Contraseña</div>
        <div class="value">********</div>
        
        <div class="label">Fecha de inicio de contrato</div>
        <div class="value"><?php echo htmlspecialchars($usuario['fecha_inicio_contrato'] ?? "Indefinido"); ?></div>
        
        <div class="label two-line">Fecha de finalización de contrato</div>
        <div class="value"><?php echo htmlspecialchars($usuario['fecha_fin_contrato'] ?? "Indefinido"); ?></div>
    </div>
</div>
 