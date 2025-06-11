<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../../auth/login.php");
    }
?>

<link rel="stylesheet" href="./assets/css/listar_cuentas.css">
<title>Listar cuentas</title>

<div class="listar-cuentas-container">
  <div class="listar-cuentas-top-container">
    <h1>Listado de Cuentas</h1>
    <button onclick="window.location.href = '.?page=cuentas/crear_usuario'">Crear Cuenta <i class="bi bi-plus-lg"></i></button>
  </div>
  

        <div class="grid">
            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>

            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>

            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>

            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>

            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>

            <div class="card" onclick="window.location.href = '.?page=cuentas/info_user'">
                <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                <p><strong>Correo:</strong> correo@example.com</p>
            </div>
        </div>
    </div>