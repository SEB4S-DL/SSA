<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }
?>

<link rel="stylesheet" href="./assets/css/crear-usuario.css">
<title><?= $traducciones['titulo_crear_usuario']?></title>

<style>
    .loader {
        border-top: 2px solid #39a900;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
        display: none;
    }
    @keyframes spin {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .contrato-container{
        display: none;
    }
</style>
 
        
<div class="container">
    <h1><?= $traducciones['titulo_crear_usuario']?></h1>

    <form id="crearUsuarioForm">
        <div class="form-group">
            <label><?= $traducciones['nombre_usuario']?></label>
            <div class="form-column">
                <input id="primerNombre" type="text" name="primer_nombre" placeholder="<?= $traducciones['primer_nombre']?>" required>
                <input id="segundoNombre" type="text" name="segundo_nombre" placeholder="<?= $traducciones['segundo_nombre']?>">
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones['apellidos_usuario']?></label>
            <div class="form-column">
                <input id="primerApellido" type="text" name="primer_apellido" placeholder="<?= $traducciones['primer_apellido']?>" required>
                <input id="segundoApellido" type="text" name="segundo_apellido" placeholder="<?= $traducciones['segundo_apellido']?>">
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones['correo_institucional']?></label>
            <span style="font-size: 13px; display: inline-block; margin-bottom: 1em; color: red;" id="emailStateSpan"></span>
            <input id="emailInput" type="email" name="correo" placeholder="<?= $traducciones['correo']?>" required>
        </div>

        <div class="form-group">
            <label><?= $traducciones['documento_usuario']?></label>
            <div style="margin-bottom: 10px;">
                <label style="font-size: 12px; color: #666;"><?= $traducciones['tipo_documento']?></label>
            </div>
            <div class="document-row">
                <select id="tipoDocumento" name="tipo_documento" class="document-type" required>
                    <option value="CC"><?= $traducciones['cc']?></option>
                    <option value="CE"><?= $traducciones['ce']?></option>
                </select>
            </div>
            <div style="margin-top: 10px;">
                <input id="documentInput" type="texto" name="numero_documento" placeholder="<?= $traducciones['numero_documento']?>" class="document-number" required>
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones['rol2']?></label>
            <div class="role-row">
                <select id="rol" class="role-select" required>
                    <option value="user"><?= $traducciones['usuario']?></option>
                </select>
                
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones['tipo_instructor']?></label>
            <div class="instructor-row">
                <select id="tipoInstructor" class="instructor-select" required>
                    <option value="tecnico"><?= $traducciones['tecnico']?></option>
                    <option value="transversal"><?= $traducciones['transversal']?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones["modalidad_instructor"]; ?></label>
            <div class="instructor-row">
                <select id="modalidadInstructor" class="instructor-select" required>
                    <option value="planta"><?= $traducciones['planta']?></option>
                    <option value="contratista"><?= $traducciones['contratista']?></option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label><?= $traducciones['contraseña']?></label>
            <span style="font-size: 13px; display: inline-block; margin-bottom: 1em; color: red;" id="passwordStateSpan"></span>
            <input id="passInput" type="password" name="contrasena" placeholder="<?= $traducciones['contraseña']?>" required>
        </div>

        <div class="form-group contrato-container" id="contratoContainer">
            <label><?= $traducciones['contrato']?></label>
            <div class="contract-row">
                <label for=""><?= $traducciones['contrato_inicio'] ?></label>
                <input class="contract-input" type="date" id="contractStart" name="fecha_inicio_contrato" placeholder="Fecha inicio contrato">
                <label for=""><?= $traducciones['contrato_fin'] ?></label>
                <input class="contract-input" type="date" id="contractEnd" name="fecha_fin_contrato" placeholder="Fecha fin contrato">
            </div>
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-cancel" onclick="window.location.href = '.?page=cuentas/listar_cuentas'"><?= $traducciones['cancelar']?></button>
            <button type="submit" class="btn btn-create"><?= $traducciones['crear']?></button>
            <div class="loader" id="loader"></div>
        </div>
    </form>
</div>

<script>
    const modalidadInstructorInput = document.getElementById("modalidadInstructor");

    // Cuando se seleccione la modalidad de instructor (planta/contratista) mostrar u ocultar el contenedor de las fechas de contrato
    modalidadInstructorInput.addEventListener("input", (e) =>{
        const value = modalidadInstructorInput.value;
        const contratoContainer = document.getElementById("contratoContainer");
        const inputsContrato = document.querySelectorAll(".contract-input");

        // Resetear el valor de los inputs (si no se hace, aunque se envíe como de planta, es posible que haya un valor en las fechas de contrato)
        inputsContrato.forEach((inp) =>{
            inp.value = "";
        });

        if (value === "contratista"){
            contratoContainer.style.display = "block";
            inputsContrato.forEach((inp) => {
                inp.setAttribute("required", "");
            })
        }
        else{
            contratoContainer.style.display = "none";
            inputsContrato.forEach((inp) =>{
                inp.removeAttribute("required");
            });
        }
    });

    const form = document.getElementById("crearUsuarioForm");

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // Obtener los elementos HTML donde se muestran los mensajes de estado
        const emailStateSpan = document.getElementById("emailStateSpan");
        emailStateSpan.innerHTML = "";
        const passwordStateSpan = document.getElementById("passwordStateSpan");
        passwordStateSpan.innerHTML = "";

        // Primero verificar que los campos sean válidos
        const emailInput = document.getElementById("emailInput");
        const passwordInput = document.getElementById("passInput");

        if (!validEmail(emailInput)){
            emailStateSpan.innerHTML = "Correo inválido.";
            emailStateSpan.scrollIntoView({behavior: "smooth"});
            return;
        }

        if (!validPassword(passwordInput)){
            passwordStateSpan.innerHTML = "La contraseña debe tener almenos 8 carácteres.";
            passwordStateSpan.scrollIntoView({behavior: "smooth"});
            return;
        }

        // Datos del usuario
        const primerNombre = document.getElementById("primerNombre").value;
        const segundoNombre = document.getElementById("segundoNombre").value;
        const primerApellido = document.getElementById("primerApellido").value;
        const segundoApellido = document.getElementById("segundoApellido").value;
        const correo = document.getElementById("emailInput").value;
        const tipoDocumento = document.getElementById("tipoDocumento").value;
        const documento = document.getElementById("documentInput").value;
        const rol = document.getElementById("rol").value;
        const tipoInstructor = document.getElementById("tipoInstructor").value;
        const modalidadInstructor = document.getElementById("modalidadInstructor").value;
        const contrasena = document.getElementById("passInput").value;
        const inicioContrato = document.getElementById("contractStart").value;
        const finContrato = document.getElementById("contractEnd").value;

        // Hacer fetch al backend y mostrar el loader mientras se hace fetch
        const loader = document.getElementById("loader");
        const buttons = document.querySelectorAll(".btn");

        // Ocultar los botones y mostrar el loader
        buttons.forEach((button) =>{
            button.style.display = "none";
        });

        loader.style.display = "block";

        // LLevar el scroll hasta donde está el loader
        loader.scrollIntoView({behavior: "smooth"});

        fetch("./functions/crearUsuario.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "primer_nombre="+primerNombre+"&segundo_nombre="+segundoNombre+"&primer_apellido="+primerApellido+"&segundo_apellido="+segundoApellido+"&correo="+correo+"&tipo_documento="+tipoDocumento+"&numero_documento="+documento+"&rol="+rol+"&tipo_instructor="+tipoInstructor+"&modalidad_instructor="+modalidadInstructor+"&contrasena="+contrasena+"&fecha_inicio_contrato="+inicioContrato+"&fecha_fin_contrato="+finContrato
        })
        .then(res => res.json())
        .then((res) =>{
            const state = res.state;
            const message = res.msg;

            switch (state){
                case 1:
                    alert(message);
                    break;
                case 0:
                    alert(message);
                    window.location.href = ".?page=cuentas/listar_cuentas";
                    break;
            }
        })
        .catch(err => console.error("Error en fetch: ", err))
        .finally(() =>{
            // Ocultar el loader y mostrar los botones nuevamente
            loader.style.display = "none";
            buttons.forEach((button) => {
                button.style.display = "block";
            });
        });
        
    });

    function validPassword(input){
        const passValue = input.value;

        return passValue.length >= 8;
    }

    function validEmail(email){
        const emailValue = email.value;

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(emailValue);
    }
</script>
   