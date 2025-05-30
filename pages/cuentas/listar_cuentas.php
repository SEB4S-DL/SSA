<link rel="stylesheet" href="./assets/css/listar_cuentas.css">

<div class="listar-cuentas-container">
  <div class="listar-cuentas-top-container">
    <h1>Listado de Cuentas</h1>
    <button onclick="window.location.href = '.?page=fichas/crear_ficha'">Crear Cuenta <i class="bi bi-plus-lg"></i></button>
  </div>
  

        <div class="grid">
            <?php
            for ($i = 0; $i < 6; $i++) {
                echo '
                <div class="card">
                    <p><strong>Nombre:</strong> Juan Esteban Muñoz</p>
                    <p><strong>Tipo:</strong> {{Transversal o Técnico}}</p>
                    <p><strong>Correo:</strong> correo@example.com</p>
                </div>
                ';
            }
            ?>
        </div>
    </div>