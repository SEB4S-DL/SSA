<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    if (!isset($_GET["usuario"])){
        header("Location: .?page=cuentas/listar_cuentas");
    }

    require_once "./functions/editarInfo.php";
?>

<link rel="stylesheet" href="./assets/css/editar-info.css">
<title>Editar usuario</title>

<?php
    // Datos del usuario
    $usuario = obtener_usuario($_GET["usuario"]);
    ?>

    <?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo "<script>alert('Información actualizada correctamente');</script>";
    } elseif ($_GET['status'] === 'error') {
        echo "<script>alert('Hubo un error al actualizar la información');</script>";
    }
}
?>


<div class="editar-container">
    <div class="visualizar-usuario">
      <div class="visualizar-usuario-top">
        <h1>Editar usuario</h1>
      </div>
    
    
    
            <form action="./functions/editarInfo.php" class="user-info" id="editarInfoForm" method="POST">
                <div class="label">Primer nombre</div>
                <input class="value" type="text" name="primer_nombre" placeholder="Nombre" value="<?php echo $usuario['nombre']; ?>">

                <div class="label">Segundo nombre</div>
                <input class="value" type="text" name="segundo_nombre" placeholder="Segundo nombre" value="<?php echo $usuario['segundo_nombre']; ?>">

                <div class="label">Primer apellido</div>
                <input class="value" type="text" name="primer_apellido" placeholder="Apellido" value="<?php echo $usuario['apellido']; ?>">

                <div class="label">Segundo apellido</div>
                <input class="value" type="text" name="segundo_apellido" placeholder="Segundo apellido" value="<?php echo $usuario['segundo_apellido']; ?>">
                
                <div class="label">Correo institucional</div>
                <input class="value" type="text" name="correo" placeholder="correo@example.com" value="<?php echo $usuario['correo_institucional']; ?>">
                
                <div class="label">Tipo de identificación</div>
                <select name="tipo_identificacion" class="value" value="<?= $usuario["tipo_documento"] ?>">
                    <option value="CC">Cédula de ciudadanía</option>
                    <option value="CE">Cédula de extranjería</option>
                </select>
                
                <div class="label">Nro de identificación</div>
                <input class="value" type="text" name="nro_documento" placeholder="Número identificacion" value="<?php echo $usuario['nro_documento']; ?>">
    
                <div class="label">Rol (usuario/administrador)</div>
    
                <select name="rol" class="value" value="">
                    <option value="<?= $usuario["rol"] ?>">Seleccione el tipo de Rol </option>
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
                
                <div class="label">Tipo instructor</div>
                <select name="tipo_instructor" class="value">
                    <option value="<?= $usuario["tipo"] ?>">Seleccione el tipo de usuario</option>
                    <option value="tecnico">Técnico</option>
                    <option value="transversal">Transversal</option>
                </select>
                
                <div class="label">Contraseña</div>
                <input class="value" name="contrasena" type="password" placeholder="Contraseña" value="">
                
                <div class="label">Fecha de inicio de contrato</div>
                <input class="value" name="fecha_inicio" type="date" value="<?= $usuario["fecha_inicio_contrato"]; ?>">
                
                <div class="label two-line">Fecha de finalización de contrato</div>
                <input class="value" name="fecha_fin" type="date" value="<?= $usuario["fecha_fin_contrato"]; ?>">

                <div class="label two-line">Estado</div>
                <select name="estado" id="" class="value" >
                    <option value="<?= $usuario["estado"]; ?>">Seleccione el tipo de estado </option>
                    <option value="habilitado">Habilitado</option>
                    <option value="deshabilitado">Deshabilitado</option>
                </select>
            </form>
        </div>
    
        <div class="acciones">
        <button class="cancelar" onclick="window.location.href = '.?page=cuentas/listar_cuentas'">Cancelar</button>
        <button class="actualizar" onclick="submitForm('editarInfoForm')">Actualizar</button>
    </div>
</div>
 

<script src="./assets/js/submitForm.js"></script>