<link rel="stylesheet" href="./assets/css/editar-info.css">

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

<div class="editar-container">
    <div class="visualizar-usuario">
      <div class="visualizar-usuario-top">
        <h1>Visualizar usuario</h1>
      </div>
    
    
    
            <div class="user-info">
                <div class="label">Nombre completo</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['nombre']; ?>" value="<?php echo $usuario['nombre']; ?>">
                
                <div class="label">Correo institucional</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['nombre']; ?>" value="<?php echo $usuario['nombre']; ?>">
                
                <div class="label">Tipo de identificación</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['nombre']; ?>" value="<?php echo $usuario['nombre']; ?>">
                
                <div class="label">Nro de identificación</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['nombre']; ?>" value="<?php echo $usuario['nombre']; ?>">
    
                <div class="label">Rol (usuario/administrador)</div>
    
                <select class="value">
                    <option <?php echo $usuario['rol'] === 'Usuario' ? 'selected' : ''; ?>>Usuario</option>
                    <option <?php echo $usuario['rol'] === 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                </select>
    
                <div class="label">Rol (usuario/administrador)</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['tipo_instructor']; ?>" value="<?php echo $usuario['tipo_instructor']; ?>">
                
                <div class="label">Tipo instructor</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['tipo_instructor']; ?>" value="<?php echo $usuario['tipo_instructor']; ?>">
                
                <div class="label">Contraseña</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['tipo_instructor']; ?>" value="<?php echo $usuario['tipo_instructor']; ?>">
                
                <div class="label">Fecha de inicio de contrato</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['tipo_instructor']; ?>" value="<?php echo $usuario['tipo_instructor']; ?>">
                
                <div class="label two-line">Fecha de finalización de contrato</div>
                <input class="value" type="text" placeholder="<?php echo $usuario['tipo_instructor']; ?>" value="<?php echo $usuario['tipo_instructor']; ?>">
            </div>
        </div>
    
        <div class="acciones">
        <button class="cancelar">Cancelar</button>
        <button class="actualizar">Actualizar</button>
    </div>
</div>
 