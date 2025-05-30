<link rel="stylesheet" href="./assets/css/visualizar-ficha.css">
<title>Visualizar ficha</title>

<div class="visualizar-ficha-container">
  <div class="top-container__text">
    <h1 class="top-container-title">Ficha: 0123456789</h1>
    
    <a href=".?page=fichas/crear_aprendiz" class="top-container-button">
      Crear aprendiz
      <i class="bi bi-plus-lg"></i>
    </a>
  </div>

  <div class="main-content">
    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container red-percentage" data-percentage="30"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>

    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container red-percentage" data-percentage="50"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>

    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container green-percentage" data-percentage="60"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>

    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container red-percentage" data-percentage="36"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>

    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container red-percentage" data-percentage="21"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>

    <div class="apprentice-card" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz&aprendiz=2'">
      <div class="percentage-container red-percentage" data-percentage="12"></div>
      <p>Andrés Felipe Pineda Santos</p>
      <p>TI: 123456789</p>
      <p>30% aprobado</p>
    </div>
  </div>
</div>

<script src="./assets/js/loadPercentage.js"></script>