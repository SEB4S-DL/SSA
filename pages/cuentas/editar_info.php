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

$idiomasPermitidos = ['es', 'en'];
$idioma = 'es';

if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomasPermitidos)) {
    $idioma = $_GET['lang'];
    setcookie('lang', $idioma, time() + (86400 * 30), "/");
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $idiomasPermitidos)) {
    $idioma = $_COOKIE['lang'];
}

$traducciones = require __DIR__ . "/../../lang/$idioma.php";
?>


<div class="editar-container">
    <div class="visualizar-usuario">
      <div class="visualizar-usuario-top">
        <h1><?= $traducciones['titulo_editar_usuario']?></h1>
      </div>

            <form action="./functions/editarInfo.php" class="user-info" id="editarInfoForm" method="POST">
                <div class="label"><?= $traducciones['primer_nombre']?></div>
                <input class="value" type="text" name="primer_nombre" placeholder="<?= $traducciones['primer_nombre']?>" value="<?php echo $usuario['nombre']; ?>">

                <div class="label"><?= $traducciones['segundo_nombre']?></div>
                <input class="value" type="text" name="segundo_nombre" placeholder="<?= $traducciones['segundo_nombre']?>" value="<?php echo $usuario['segundo_nombre']; ?>">

                <div class="label"><?= $traducciones['primer_apellido']?></div>
                <input class="value" type="text" name="primer_apellido" placeholder="<?= $traducciones['primer_apellido']?>" value="<?php echo $usuario['apellido']; ?>">

                <div class="label"><?= $traducciones['segundo_apellido']?></div>
                <input class="value" type="text" name="segundo_apellido" placeholder="<?= $traducciones['segundo_apellido']?>" value="<?php echo $usuario['segundo_apellido']; ?>">
                
                <div class="label"><?= $traducciones['correo_institucional']?></div>
                <input class="value" type="text" name="correo" placeholder="<?= $traducciones['correo_ejemplo']?>" value="<?php echo $usuario['correo_institucional']; ?>">
                
                <div class="label"><?= $traducciones['tipo_identificacion']?></div>
                <select name="tipo_identificacion" class="value" value="<?= $usuario["tipo_documento"] ?>">
                    <option value="CC"><?= $traducciones['cc']?></option>
                    <option value="CE"><?= $traducciones['ce']?></option>
                </select>
                
                <div class="label"><?= $traducciones['nro_identificacion']?></div>
                <input class="value" type="text" name="nro_documento" placeholder="Número identificacion" value="<?php echo $usuario['nro_documento']; ?>">
    
                <div class="label"><?= $traducciones['rol']?></div>
    
                <select name="rol" class="value" value="">
                    <option value="<?= $usuario["rol"] ?>"><?= $traducciones['tipo_rol']?></option>
                    <option value="user"><?= $traducciones['usuario']?></option>
                    <option value="admin"><?= $traducciones['administrador']?></option>
                </select>
                
                <div class="label"><?= $traducciones['tipo_instructor']?></div>
                <select name="tipo_instructor" class="value">
                    <option value="<?= $usuario["tipo"] ?>"><?= $traducciones['input_tipo_usuario']?></option>
                    <option value="tecnico"><?= $traducciones['tecnico']?></option>
                    <option value="transversal"><?= $traducciones['transversal']?></option>
                </select>
                
                <div class="label"><?= $traducciones['contraseña']?></div>
                <input class="value" name="contrasena" type="password" placeholder="<?= $traducciones['contraseña']?>" value="">
                
                <div class="label"><?= $traducciones['inicio_contrato']?></div>
                <input class="value" name="fecha_inicio" type="date" value="<?= $usuario["fecha_inicio_contrato"]; ?>">
                
                <div class="label two-line"><?= $traducciones['fin_contrato']?></div>
                <input class="value" name="fecha_fin" type="date" value="<?= $usuario["fecha_fin_contrato"]; ?>">

                <div class="label two-line"><?= $traducciones['estado']?></div>
                <select name="estado" id="" class="value" >
                    <option value="<?= $usuario["estado"]; ?>"><?= $traducciones['input_select_estado']?></option>
                    <option value="habilitado"><?= $traducciones['habilitado']?></option>
                    <option value="deshabilitado"><?= $traducciones['deshabilitado']?></option>
                </select>
            </form>
        </div>
    
        <div class="acciones">
        <button class="cancelar" onclick="window.location.href = '.?page=cuentas/listar_cuentas'"><?= $traducciones['cancelar']?></button>
        <button class="actualizar" onclick="submitForm('editarInfoForm')"><?= $traducciones['actualizar']?></button>
    </div>
</div>
 

<script src="./assets/js/submitForm.js"></script>