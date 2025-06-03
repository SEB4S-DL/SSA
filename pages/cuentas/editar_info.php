<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }
?>

<link rel="stylesheet" href="./assets/css/editar-info.css">
<title>Editar usuario</title>

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
        <h1>Editar usuario</h1>
      </div>
    
    
    
            <form action="" class="user-info" id="editarInfoForm">
                <div class="label">Primer nombre</div>
                <input class="value" type="text" name="primer_nombre" placeholder="Nombre" value="<?php echo $usuario['nombre']; ?>">

                <div class="label">Segundo nombre</div>
                <input class="value" type="text" name="segundo_nombre" placeholder="Segundo nombre" value="<?php echo $usuario['nombre']; ?>">

                <div class="label">Primer apellido</div>
                <input class="value" type="text" name="primer_apellido" placeholder="Apellido" value="<?php echo $usuario['nombre']; ?>">

                <div class="label">Segundo apellido</div>
                <input class="value" type="text" name="segundo_apellido" placeholder="Segundo apellido" value="<?php echo $usuario['nombre']; ?>">
                
                <div class="label">Correo institucional</div>
                <input class="value" type="text" placeholder="correo@example.com" value="<?php echo $usuario['nombre']; ?>">
                
                <div class="label">Tipo de identificación</div>
                <select name="tipo_identificacion" class="value">
                    <option value="">Cédula de ciudadanía</option>
                    <option value="">Cédula de extranjería</option>
                </select>
                
                <div class="label">Nro de identificación</div>
                <input class="value" type="text" placeholder="Número identificacion" value="<?php echo $usuario['nombre']; ?>">
    
                <div class="label">Rol (usuario/administrador)</div>
    
                <select name="rol" class="value">
                    <option <?php echo $usuario['rol'] === 'Usuario' ? 'selected' : ''; ?>>Usuario</option>
                    <option <?php echo $usuario['rol'] === 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                </select>
                
                <div class="label">Tipo instructor</div>
                <select name="tipo_instructor" class="value">
                    <option value="">No aplica</option>
                    <option value="">Técnico</option>
                    <option value="">Transversal</option>
                </select>
                
                <div class="label">Contraseña</div>
                <input class="value" type="password" placeholder="Contraseña" value="<?php echo $usuario['tipo_instructor']; ?>">
                
                <div class="label">Fecha de inicio de contrato</div>
                <input class="value" type="date" value="">
                
                <div class="label two-line">Fecha de finalización de contrato</div>
                <input class="value" type="date" value="">
            </form>
        </div>
    
        <div class="acciones">
        <button class="cancelar" onclick="window.location.href = '.?page=cuentas/listar_cuentas'">Cancelar</button>
        <button class="actualizar" onclick="submitForm('editarInfoForm')">Actualizar</button>
    </div>
</div>
 

<script src="./assets/js/submitForm.js"></script>