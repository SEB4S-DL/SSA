<link rel="stylesheet" href="./assets/css/info-user.css">
<title>Visualizar usuario</title>

<?php
    // Datos del usuario
    $usuario = [
        'nombre' => 'Juan Sebastián Duque López',
        'correo' => 'example@soy.sena.edu.co',
        'tipo_id' => 'Tarjeta de identidad',
        'numero_id' => '1058138512',
        'rol' => 'Usuario',
        'tipo_instructor' => 'No aplica',
        'contrasena' => '********',
        'fecha_inicio' => '5 de abril de 2020',
        'fecha_fin' => '5 de abril de 2025'
    ];
    ?>
<div class="visualizar-usuario">
  <div class="visualizar-usuario-top">
    <h1>Visualizar usuario</h1>
    <button onclick="window.location.href = '.?page=cuentas/editar_info'"> Editar </button>
  </div>



        <div class="user-info">
            <div class="label">Nombre completo</div>
            <div class="value"><?php echo htmlspecialchars($usuario['nombre']); ?></div>
            
            <div class="label">Correo institucional</div>
            <div class="value"><?php echo htmlspecialchars($usuario['correo']); ?></div>
            
            <div class="label">Tipo de identificación</div>
            <div class="value"><?php echo htmlspecialchars($usuario['tipo_id']); ?></div>
            
            <div class="label">Nro de identificación</div>
            <div class="value"><?php echo htmlspecialchars($usuario['numero_id']); ?></div>
            
            <div class="label">Rol (usuario/administrador)</div>
            <div class="value"><?php echo htmlspecialchars($usuario['rol']); ?></div>
            
            <div class="label">Tipo instructor</div>
            <div class="value"><?php echo htmlspecialchars($usuario['tipo_instructor']); ?></div>
            
            <div class="label">Contraseña</div>
            <div class="value"><?php echo htmlspecialchars($usuario['contrasena']); ?></div>
            
            <div class="label">Fecha de inicio de contrato</div>
            <div class="value"><?php echo htmlspecialchars($usuario['fecha_inicio']); ?></div>
            
            <div class="label two-line">Fecha de finalización de contrato</div>
            <div class="value"><?php echo htmlspecialchars($usuario['fecha_fin']); ?></div>
        </div>
    </div>
 