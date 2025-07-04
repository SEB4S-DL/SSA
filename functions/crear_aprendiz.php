<?php
  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }

  // Si no hay sesión iniciada o el rol del usuario actual no es admin, no permite usar este archivo
  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("../auth/login.php");
  }

  if (str_contains($_SERVER["PHP_SELF"], "functions/crear_aprendiz.php")){
    if ($_SERVER["REQUEST_METHOD"] !== "POST"){
      header("Location: ../index.php");
      exit();
    }

    require_once "../db/conection.php";

    if (validar_datos()){
      crear_aprendiz();
    }
    else{
      header("Location: ../index.php?page=fichas/crear_aprendiz&ficha=$ficha_aprendiz&state=3");
      exit();
    }
  }

  function obtener_fichas(){
    global $conn;
    $sql = "SELECT nro_ficha FROM fichas";

    $result = $conn->query($sql);

    return $result;
  }

  function validar_datos(){
    $ficha = $_POST["ficha"];

    if (!validar_ficha($ficha)){
      header("Location: ../index.php?page=fichas/crear_aprendiz");
      exit();
    }

    $nro_documento = $_POST["nro_documento"];

    if (preg_match("/^\d{1,11}$/", $nro_documento) != 1){
      header("Location: ../index.php?page=fichas/crear_aprendiz&ficha=$ficha&state=2");
      exit();
    }

    if (existe_aprendiz($nro_documento)){
      header("Location: ../index.php?page=fichas/crear_aprendiz&ficha=$ficha&state=1");
      exit();
    }
    
    $nombre = $_POST["primer_nombre"];

    $apellido = $_POST["primer_apellido"];

    $tipo_documento = $_POST["tipo_documento"];

    $estado_aprendiz = $_POST["estado"];

    $ficha = $_POST["ficha"];

    if ($nombre != "" && 
    $apellido != "" && 
    validar_tipo_documento($tipo_documento) && 
    preg_match("/^\d+$/", $nro_documento) == 1 && // Si el valor ingresado no es numérico, devuelve 0
    validar_estado($estado_aprendiz) &&
    validar_ficha($ficha)){
      return true;
    }
    else{
      return false;
    }
  }

  function validar_tipo_documento($doc){
    $documentos_validos = ["TI", "CC", "CE"];

    if (in_array($doc, $documentos_validos)){
      return true;
    }
    return false;
  }

  function validar_estado($estado){
    $estados_validos = ["en formacion", "trasladado", "cancelado", "aplazado"];

    if (in_array($estado, $estados_validos)){
      return true;
    }
    return false;
  }

  function validar_ficha($ficha){
    global $conn;

    $fichas = obtener_fichas();

    $fichas_validas = [];

    while ($ficha_sql = $fichas->fetch_assoc()){
      $fichas_validas[] = $ficha_sql["nro_ficha"];
    }

    if (in_array($ficha, $fichas_validas)){
      return true;
    }
    return false;
  }

  function existe_aprendiz($aprendiz){
    global $conn;
    $sql = "SELECT nro_documento FROM aprendices";

    $result = $conn->query($sql);

    $aprendices_existentes = [];

    while ($aprendiz_actual = $result->fetch_assoc()){
      $aprendices_existentes[] = $aprendiz_actual["nro_documento"];
    }

    if (in_array($aprendiz, $aprendices_existentes)){
      return true;
    }
    return false;
  }

  function crear_aprendiz(){
    global $conn;

    $nombre = trim($_POST["primer_nombre"]);
    $segundo_nombre = trim($_POST["segundo_nombre"]);

    if ($segundo_nombre == ""){
      $segundo_nombre = null;
    }

    $apellido = trim($_POST["primer_apellido"]);
    $segundo_apellido = trim($_POST["segundo_apellido"]);

    if ($segundo_apellido == ""){
      $segundo_apellido = null;
    }

    $tipo_documento = $_POST["tipo_documento"];

    $nro_documento = intval(trim($_POST["nro_documento"]));

    $estado_aprendiz = $_POST["estado"];

    $ficha_aprendiz = $_POST["ficha"];

    $sql = "INSERT INTO aprendices 
    (nro_documento, tipo_documento, nombre, segundo_nombre, apellido, segundo_apellido, estado, horas_aprobadas, nro_ficha)
    VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssi", $nro_documento, $tipo_documento, $nombre, $segundo_nombre, $apellido, $segundo_apellido, $estado_aprendiz, $ficha_aprendiz);

    if ($stmt->execute()){
      header("Location: ../index.php?page=fichas/crear_aprendiz&ficha=$ficha_aprendiz&state=0");
      exit();
    }
    else{
      header("Location: ../index.php?page=fichas/crear_aprendiz&ficha=$ficha_aprendiz&state=3");
      exit();
    }
  }

?>