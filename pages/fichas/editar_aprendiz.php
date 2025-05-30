<link rel="stylesheet" href="./assets/css/editar-aprendiz.css">
<title>Editar aprendiz</title>

<div class="editar-aprendiz-container">
  <div class="top-container__text">
    <h1 class="top-container-title">Editar aprendiz</h1>
  </div>

  <form action="" class="crear-aprendiz-form" method="POST">
    <!-- Nombres aprendiz -->
    <h3>Nombres aprendiz</h3>

    <input type="text" name="primer_nombre" id="" placeholder="Primer nombre">
    <input type="text" name="segundo_nombre" id="" placeholder="Segundo nombre">



    <!-- Apellidos aprendiz -->
    <h3>Apellidos aprendiz</h3>

    <input type="text" name="primer_apellido" id="" placeholder="Primer apellido">
    <input type="text" name="segundo_apellido" id="" placeholder="Segundo apellido">



    <!-- Documento del aprendiz -->
    <h3>Documento del aprendiz</h3>

    <label for="apprenticeDocumentType" class="simpleLabel">Tipo de documento</label>

    <select name="tipo_documento" id="apprenticeDocumentType">
      <option value="">Tarjeta de identidad</option>
      <option value="">Cédula de ciudadanía</option>
      <option value="">Cédula de extranjería</option>
    </select>

    <input type="text" name="nro_documento" placeholder="Numero de documento">



    <!-- Estado del aprendiz -->
    <label for="apprenticeState">
      <h3>Estado del aprendiz</h3>
    </label>

    <select name="estado" id="apprenticeState">
      <option value="">En formación</option>
      <option value="">Deserción</option>
      <option value="">Cancelado</option>
      <option value="">Trasladado</option>
    </select>



    <!-- Ficha del aprendiz -->
    <label for="apprenticeFile">
      <h3>Ficha del aprendiz</h3>
    </label>

    <select name="ficha" id="apprenticeFile">
      <option value="">2895664</option>
      <option value="">7625311</option>
    </select>

    <div class="custom-table-container">
      <div class="row">
        <div>Competencia</div>
        <div>RAE</div>
        <div>Estado</div>
        <div>Evaluador</div>
        <div>Observaciones</div>
      </div>

      <div class="row">
        <div>Codificar el software</div>
        <div>Aprender el uso de herramientas de bases de datos</div>

        <div>
          <select name="estado_rae" id="">
            <option value="">Por evaluar</option>
            <option value="">Aprobado</option>
          </select>
        </div>

        <div>
          <select name="evaluador_rae" id="">
            <option value="">Andrés Felipe Cardona Orozco</option>
          </select>
        </div>

        <div>
          <textarea name="observacion_rae" id="" placeholder="Ingrese la observación del aprendiz"></textarea>
        </div>
      </div>

      <div class="row">
        <div>Codificar el software</div>
        <div>Aprender el uso de herramientas de bases de datos</div>

        <div>
          <select name="estado_rae" id="">
            <option value="">Por evaluar</option>
            <option value="">Aprobado</option>
          </select>
        </div>

        <div>
          <select name="evaluador_rae" id="">
            <option value="">Andrés Felipe Cardona Orozco</option>
          </select>
        </div>

        <div>
          <textarea name="observacion_rae" id="" placeholder="Ingrese la observación del aprendiz"></textarea>
        </div>
      </div>
    </div>

    <div class="form-buttons-container">
      <button type="button" onclick="window.location.href = '.?page=fichas/visualizar_aprendiz'">Cancelar</button>
      <input type="submit" value="Actualizar">
    </div>
    
  </form>
</div>