<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
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

<link rel="stylesheet" href="./assets/css/crear-usuario.css">
<title><?= $traducciones['titulo_crear_usuario']?></title>
 
        
<div class="container">
        <h1><?= $traducciones['titulo_crear_usuario']?></h1>

       <form action="./functions/crearUsuario.php" method="POST">
            <div class="form-group">
                <label><?= $traducciones['nombre_usuario']?></label>
                <div class="form-column">
                    <input type="text" name="primer_nombre" placeholder="<?= $traducciones['primer_nombre']?>" required>
                    <input type="text" name="segundo_nombre" placeholder="<?= $traducciones['segundo_nombre']?>">
                </div>
            </div>

            <div class="form-group">
                <label><?= $traducciones['apellidos_usuario']?></label>
                <div class="form-column">
                    <input type="text" name="primer_apellido" placeholder="<?= $traducciones['primer_apellido']?>" required>
                    <input type="text" name="segundo_apellido" placeholder="<?= $traducciones['segundo_apellido']?>">
                </div>
            </div>

            <div class="form-group">
                <label><?= $traducciones['correo_institucional']?></label>
                <input type="email" name="correo" placeholder="<?= $traducciones['correo']?>" required>
            </div>

            <div class="form-group">
                <label><?= $traducciones['documento_usuario']?></label>
                <div style="margin-bottom: 10px;">
                    <label style="font-size: 12px; color: #666;"><?= $traducciones['tipo_documento']?></label>
                </div>
                <div class="document-row">
                    <select name="tipo_documento" class="document-type" required>
                        <option value="CC"><?= $traducciones['cc']?></option>
                        <option value="CE"><?= $traducciones['ce']?></option>
                    </select>
                   
                </div>
                <div style="margin-top: 10px;">
                    <input type="texto" name="numero_documento" placeholder="<?= $traducciones['numero_documento']?>" class="document-number" required>
                </div>
            </div>

            <div class="form-group">
                <label><?= $traducciones['rol2']?></label>
                <div class="role-row">
                    <select name="rol" class="role-select" required>
                        <option value="user"><?= $traducciones['usuario']?></option>
                    </select>
                    
                </div>
            </div>

            <div class="form-group">
                <label><?= $traducciones['tipo_instructor']?></label>
                <div class="instructor-row">
                    <select name="tipo_instructor" class="instructor-select" required>
                        <option value="tecnico"><?= $traducciones['tecnico']?></option>
                        <option value="transversal"><?= $traducciones['transversal']?></option>
                    </select>
                
                </div>
            </div>

            <div class="form-group">
                <label><?= $traducciones['contraseña']?></label>
                <input type="password" name="contrasena" placeholder="<?= $traducciones['contraseña']?>" required>
            </div>

            <div class="form-group">
                <label><?= $traducciones['contrato']?> <span class="optional">(<?= $traducciones['opcional']?>)</span></label>
                <div class="contract-row">
                    <input type="date" name="fecha_inicio_contrato" placeholder="Fecha inicio contrato">
                    <input type="date" name="fecha_fin_contrato" placeholder="Fecha fin contrato">

                </div>
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-cancel" onclick="window.location.href = '.?page=cuentas/listar_cuentas'"><?= $traducciones['cancelar']?></button>
                <button type="submit" class="btn btn-create"><?= $traducciones['crear']?></button>
            </div>
        </form>
        </div>
   