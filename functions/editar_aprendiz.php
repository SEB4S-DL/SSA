<?php
  // Si no hay sesión iniciada o el rol del usuario actual no es admin, no permite usar este archivo
  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("../auth/login.php");
  }

  // Variable para verificar que el usuario no ingrese por url sin los parametros adecuados
  $entrada_valida;

  if (!isset($_GET["aprendiz"]) || !isset($_GET["ficha"])){
    $entrada_valida = false;
  }
  else{
    $entrada_valida = true;
  }

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    date_default_timezone_set("America/Bogota"); // Establecer la zona horaria

    require "../db/conection.php";
    
    $fecha = date("Y-m-d H:i:s");

    if (validar_datos()){
      
      if (editar_aprendiz($_POST["nro_documento"], $_POST["primer_nombre"], $_POST["segundo_nombre"], $_POST["primer_apellido"], $_POST["segundo_apellido"], $_POST["tipo_documento"], $_POST["estado"], $_POST["ficha"])){

        $arraylen = count($_POST["id_juicio"]);

        for ($i = 0; $i < $arraylen; $i++){

          $juicio = $_POST["id_juicio"][$i];
          $estado = $_POST["estado_rae"][$i];
          $evaluador = $_POST["evaluador_rae"][$i];
          $observacion = $_POST["observacion_rae"][$i];

          editar_juicio($juicio, $estado, $evaluador, $observacion, $fecha);
        }

        editar_rae_aprendiz($_POST["nro_documento"]);

        $conn->close();

        header("Location: ../index.php?page=fichas/visualizar_aprendiz&aprendiz=" . $_POST["nro_documento"] . "&ficha=" . $_POST["ficha"] . "&state=0");

        exit();
      
      }
      else{
        header("Location: ../index.php?page=fichas/editar_aprendiz&aprendiz=" . $_POST["nro_documento"] . "&ficha=" . $_POST["ficha"] . "&state=1");
      }

    }
    else{
      header("Location: ../index.php?page=fichas/editar_aprendiz&aprendiz=" . $_POST["nro_documento"] . "&ficha=" . $_POST["ficha"] . "&state=2");
    }
  }

  // -----------------//-----------------
  // Funciones
  // -----------------//-----------------

  // Verificar que el aprendiz pertenezca a la ficha ingresada por url
  function aprendiz_valido($aprendiz){
    global $conn;
    $sql = "SELECT nro_documento FROM aprendices WHERE nro_ficha = ? AND nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_GET["ficha"], $aprendiz);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows > 0;
  }

  function obtener_info(){
    global $conn;

    $sql = "SELECT a.nro_documento, a.tipo_documento, a.estado, a.nro_ficha,
    a.nombre, a.segundo_nombre, a.apellido, a.segundo_apellido,
    a.cant_rae_aprobados, COUNT(r.id) AS 'total_rae'
    FROM aprendices a
    JOIN fichas f
    ON f.nro_ficha = a.nro_ficha
    LEFT JOIN programa_formacion p
    ON f.id_programa_formacion = p.id
    LEFT JOIN competencias c
    ON c.id_programa_formacion = p.id
    LEFT JOIN resultados_aprendizaje r
    ON r.id_competencia = c.id
    WHERE a.nro_ficha = ? AND a.nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_GET["ficha"], $_GET["aprendiz"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $result = $result->fetch_assoc();

    return $result;
  }

  function obtener_fichas(){
    global $conn;
    $sql = "SELECT nro_ficha FROM fichas WHERE id_programa_formacion = (SELECT id_programa_formacion FROM fichas WHERE nro_ficha = " . $_GET["ficha"] . ")";

    $result = $conn->query($sql);

    return $result;
  }

  function obtener_juicios(){
    global $conn;
    $sql = "SELECT c.nombre_competencia, r.nombre_rae, j.*,
    CONCAT_WS (' ', u.nombre, u.segundo_nombre, u.apellido, u.segundo_apellido) AS 'nombre_evaluador'
    FROM juicios_evaluativos j
    JOIN resultados_aprendizaje r
    ON r.id = j.id_rae
    JOIN competencias c
    ON c.id = r.id_competencia
    JOIN programa_formacion p
    ON c.id_programa_formacion = p.id
    JOIN fichas f
    ON f.id_programa_formacion = p.id
    JOIN aprendices a
    ON a.nro_ficha = f.nro_ficha
    JOIN usuarios u
    ON u.nro_documento  = j.id_evaluador
    WHERE a.nro_documento = ?
    GROUP BY r.id";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["aprendiz"]);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
  }

  function obtener_evaluadores(){
    global $conn;
    $sql = "SELECT nro_documento, 
    CONCAT_WS(' ', nombre, segundo_nombre, apellido, segundo_apellido) AS 'nombre' 
    FROM usuarios";

    $result = $conn->query($sql);

    return $result;
  }

  function editar_aprendiz($id_aprendiz, $nombre, $seg_nombre, $apellido, $seg_apellido, $tipo_documento, $estado, $ficha){
    global $conn;

    $sql = "UPDATE aprendices 
    SET tipo_documento = ?, nombre = ?, segundo_nombre = ?, apellido = ?, segundo_apellido = ?, estado = ?, nro_ficha = ?
    WHERE nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssii", $tipo_documento, $nombre, $seg_nombre, $apellido, $seg_apellido, $estado, $ficha, $id_aprendiz);

    if ($stmt->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  // Verificar que el usuario no modifique los datos válidos inspeccionando en el navegador
  function validar_datos(){
    $nombre = trim($_POST["primer_nombre"]);
    $segundo_nombre = trim($_POST["segundo_nombre"]);

    $apellido = trim($_POST["primer_apellido"]);
    $segundo_apellido = trim($_POST["segundo_apellido"]);

    $documento = $_POST["nro_documento"];

    if (!validar_aprendiz($documento)){
      return false;
    }

    $tipo_documento = $_POST["tipo_documento"];

    if (!documento_valido($tipo_documento)){
      return false;
    }

    $estado = $_POST["estado"];

    if (!estado_valido($estado)){
      return false;
    }

    $ficha = $_POST["ficha"];

    if (!ficha_valida($ficha)){
      return false;
    }

    if (strlen($nombre) > 0 && strlen($apellido) > 0){
      return true;
    }
    else{
      return false;
    }

  }

  function documento_valido($documento){
    $documentos_validos = ["TI", "CC", "CE"];

    if (!in_array($documento, $documentos_validos)){
      return false;
    }

    return true;
  }

  function estado_valido($estado){
    $estados_validos = ["en formacion", "aplazado", "cancelado", "trasladado"];

    if (!in_array($estado, $estados_validos)){
      return false;
    }

    return true;
  }

  function ficha_valida($ficha){
    global $conn;

    $sql = "SELECT nro_ficha FROM fichas WHERE nro_ficha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);

    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows > 0;
  }

  function validar_aprendiz($aprendiz){
    global $conn;

    $sql = "SELECT nro_documento FROM aprendices WHERE nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aprendiz);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows > 0;
  }

  function editar_juicio($id, $estado, $evaluador, $observacion){
    global $conn;
    global $fecha;

    $sql = "UPDATE juicios_evaluativos SET estado = ?, id_evaluador = ?, observacion = ?, fecha_y_hora = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $estado, $evaluador, $observacion, $fecha, $id);
    $stmt->execute();
  }

  function obtener_cant_rae_aprendiz($aprendiz){
    global $conn;

    $sql = "SELECT COUNT(id) AS 'rae' FROM juicios_evaluativos WHERE id_aprendiz = ? AND estado = 'aprobado'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aprendiz);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }

  function editar_rae_aprendiz($id){
    global $conn;

    $cantidad = obtener_cant_rae_aprendiz($id);

    $sql = "UPDATE aprendices SET cant_rae_aprobados = ? WHERE nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cantidad["rae"], $id);
    $stmt->execute();
  }
?>
