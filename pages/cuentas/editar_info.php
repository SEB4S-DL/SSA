<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }

    if (!isset($_GET["usuario"])){
        header("Location: .?page=cuentas/listar_cuentas");
    }

    function obtener_usuario($usuario){
        global $conn;

        $sql = "SELECT * FROM usuarios WHERE nro_documento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();


        $resultado = $resultado->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $resultado;
    }
?>

<link rel="stylesheet" href="./assets/css/editar-info.css">
<title><?= $traducciones['titulo_editar_usuario'] ?></title>

<?php
    // Datos del usuario
    $usuario = obtener_usuario($_GET["usuario"]);
?>

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


<div class="editar-container">
    <div class="visualizar-usuario">
      <div class="visualizar-usuario-top">
        <h1><?= $traducciones['titulo_editar_usuario']?></h1>
      </div>

            <form class="user-info" id="editarInfoForm" method="POST">
                <div class="label"><?= $traducciones['primer_nombre']?></div>
                <input class="value" type="text" id="primerNombre" placeholder="<?= $traducciones['primer_nombre']?>" value="<?php echo $usuario['nombre']; ?>">

                <div class="label"><?= $traducciones['segundo_nombre']?></div>
                <input class="value" type="text" id="segundoNombre" placeholder="<?= $traducciones['segundo_nombre']?>" value="<?php echo $usuario['segundo_nombre']; ?>">

                <div class="label"><?= $traducciones['primer_apellido']?></div>
                <input class="value" type="text" id="primerApellido" placeholder="<?= $traducciones['primer_apellido']?>" value="<?php echo $usuario['apellido']; ?>">

                <div class="label"><?= $traducciones['segundo_apellido']?></div>
                <input class="value" type="text" id="segundoApellido" placeholder="<?= $traducciones['segundo_apellido']?>" value="<?php echo $usuario['segundo_apellido']; ?>">
                
                <div class="label">
                    <span style="font-size: 13px; display: inline-block; color: red; margin-bottom: 1em;" id="emailStateSpan"></span>
                    <br>
                    <?= $traducciones['correo_institucional']?>
                </div>
                <input class="value" type="text" id="emailInput" placeholder="<?= $traducciones['correo_ejemplo']?>" value="<?php echo $usuario['correo_institucional']; ?>">
                
                <div class="label"><?= $traducciones['tipo_identificacion']?></div>
                <select id="tipoDocumento" class="value" value="<?= $usuario["tipo_documento"] ?>">
                    <option value="CC"><?= $traducciones['cc']?></option>
                    <option value="CE"><?= $traducciones['ce']?></option>
                </select>
                
                <div class="label"><?= $traducciones['nro_identificacion']?></div>
                <input class="value" type="text" id="documentInput" placeholder="Número identificacion" value="<?php echo $usuario['nro_documento']; ?>">
    
                <div class="label"><?= $traducciones['rol']?></div>
                <select id="rol" class="value" value="">
                    <option value="<?= $usuario["rol"] ?>"><?= $traducciones['tipo_rol']?></option>
                    <option value="user"><?= $traducciones['usuario']?></option>
                    <option value="admin"><?= $traducciones['administrador']?></option>
                </select>
                
                <div class="label"><?= $traducciones['tipo_instructor']?></div>
                <select id="tipoInstructor" class="value">
                    <option value="<?= $usuario["tipo"] ?>"><?= $traducciones['input_tipo_usuario']?></option>
                    <option value="tecnico"><?= $traducciones['tecnico']?></option>
                    <option value="transversal"><?= $traducciones['transversal']?></option>
                </select>

                <div class="label"><?= $traducciones['modalidad_instructor']?></div>
                <select id="modalidadInstructor" class="value">
                    <option value="<?= $usuario["modalidad"] ?>"><?= $traducciones['modalidad_instructor_input']?></option>
                    <option value="planta"><?= $traducciones['planta']?></option>
                    <option value="contratista"><?= $traducciones['contratista']?></option>
                </select>
                
                <div class="label">
                    <span style="font-size: 13px; display: inline-block; margin-bottom: 1em; color: red;" id="passwordStateSpan"></span>
                    <br>
                    <?= $traducciones['contraseña']?>
                </div>
                <input class="value" id="passInput" type="password" placeholder="<?= $traducciones['contraseña']?>" value="">
                
                <div style="display: <?= $usuario['modalidad'] == 'planta' ? 'none' : 'block' ?>" class="label hideable-element"><?= $traducciones['inicio_contrato']?></div>
                <input style="display: <?= $usuario['modalidad'] == 'planta' ? 'none' : 'block' ?>" class="value contract-date-input hideable-element" id="contractStart" type="date" value="<?= $usuario["fecha_inicio_contrato"]; ?>">
                
                <div style="display: <?= $usuario['modalidad'] == 'planta' ? 'none' : 'block' ?>" class="label two-line hideable-element"><?= $traducciones['fin_contrato']?></div>
                <input style="display: <?= $usuario['modalidad'] == 'planta' ? 'none' : 'block' ?>" class="value contract-date-input hideable-element" id="contractEnd" type="date" value="<?= $usuario["fecha_fin_contrato"]; ?>">

                <div class="label two-line"><?= $traducciones['estado']?></div>
                <select id="estadoSelect" class="value" >
                    <option value="<?= $usuario["estado"]; ?>"><?= $traducciones['input_select_estado']?></option>
                    <option value="habilitado"><?= $traducciones['habilitado']?></option>
                    <option value="deshabilitado"><?= $traducciones['deshabilitado']?></option>
                </select>

                <div class="acciones">
                    <button class="cancelar btn" type="button" onclick="window.location.href = '.?page=cuentas/listar_cuentas'"><?= $traducciones['cancelar']?></button>
                    <button class="actualizar btn"><?= $traducciones['actualizar']?></button>

                    <div class="loader" id="loader"></div>
                </div>
            </form>
        </div>
</div>

<script>
    const modalidadInstructorInput = document.getElementById("modalidadInstructor");

    const emailAnterior = document.getElementById("emailInput").value;
    const documentoAnterior = document.getElementById("documentInput").value;

    // Cuando se seleccione la modalidad de instructor (planta/contratista) mostrar u ocultar el contenedor de las fechas de contrato
    modalidadInstructorInput.addEventListener("input", (e) =>{
        const value = modalidadInstructorInput.value;
        const hideableElements = document.querySelectorAll(".hideable-element");
        const inputsContrato = document.querySelectorAll(".contract-date-input");

        // Resetear el valor de los inputs (si no se hace, aunque se envíe como de planta, es posible que haya un valor en las fechas de contrato)
        inputsContrato.forEach((inp) =>{
            inp.value = "";
        });

        if (value === "contratista"){
            hideableElements.forEach((elem) =>{
                elem.style.display = 'block';
            });

            inputsContrato.forEach((inp) => {
                inp.setAttribute("required", "");
            })
        }
        else{
            hideableElements.forEach((elem) =>{
                elem.style.display = 'none';
            });

            inputsContrato.forEach((inp) =>{
                inp.removeAttribute("required");
            });
        }
    });

    const form = document.getElementById("editarInfoForm");

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

        if (passwordInput.value.trim() != ""){
            if (!validPassword(passwordInput)){
                passwordStateSpan.innerHTML = "La contraseña debe tener almenos 8 carácteres.";
                passwordStateSpan.scrollIntoView({behavior: "smooth"});
                return;
            }
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
        const estado = document.getElementById("estadoSelect").value;

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

        fetch("./functions/editarInfo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "primer_nombre="+primerNombre+"&segundo_nombre="+segundoNombre+"&primer_apellido="+primerApellido+"&segundo_apellido="+segundoApellido+"&correo="+correo+"&tipo_identificacion="+tipoDocumento+"&nro_documento="+documento+"&rol="+rol+"&tipo_instructor="+tipoInstructor+"&modalidad_instructor="+modalidadInstructor+"&contrasena="+contrasena+"&fecha_inicio="+inicioContrato+"&fecha_fin="+finContrato+"&estado="+estado+"&email_anterior="+emailAnterior+"&documento_anterior="+documentoAnterior
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
                    window.location.href = ".?page=cuentas/info_user&usuario="+documento;
                    break;
            }
        })
        .catch(err => console.error("Error en fetch: ", err));

        // Ocultar el loader y mostrar los botones nuevamente
        loader.style.display = "none";
        buttons.forEach((button) => {
            button.style.display = "block";
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
