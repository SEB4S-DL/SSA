<?php

  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }

  // Si no hay sesión iniciada o el rol del usuario actual no es admin, no permite usar este archivo
  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("Location: ../auth/login.php");
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../index.php");
    exit();
  }



  $ficha = $_POST["ficha"];

  $file = $_FILES["excel"];

  $temp_file = $file["tmp_name"];

  // Verificar que el archivo si sea CSV
  $finfo = finfo_open(FILEINFO_MIME_TYPE);

  $tipo_mime = finfo_file($finfo, $temp_file);

  finfo_close($finfo);

  $extensiones_validas = [
    "text/csv" => "csv",
    "text/plain" => "csv"
  ];

  $extension_real = $extensiones_validas[$tipo_mime] ?? "desconocida";

  if ($extension_real !== "csv"){
    header("Refresh: 0.5, ../index.php?page=fichas/importar_aprendices&ficha=$ficha");
    echo "<script>alert('Tipo de archivo no permitido. Se detectó: $tipo_mime')</script>";
    exit;
  }

  // --------------------//--------------------

  $ruta = $file["tmp_name"];

  require "../db/conection.php";

  header("Content-Type: text/html; charset=UTF-8");

  $archivo = fopen($ruta, "r");

  // Convertir el archivo a UTF-8 para que se lean correctamente los caracteres especiales
  stream_filter_append($archivo, "convert.iconv.Windows-1252/UTF-8");

  if (!$archivo){
    header("Refresh: 1, ../index.php?page=fichas/importar_aprendices&ficha=$ficha");
    echo("<script>alert('Error al leer el archivo')</script>");
  }

  $encabezado = fgetcsv($archivo, 0, ";");

  if (!$encabezado){
    header("Refresh: 0, ../index.php?page=fichas/importar_aprendices&ficha=$ficha");
    echo "<script>alert('Error al leer el archivo')</script>";
    exit;
  }

  if (count($encabezado) != 10){
    header("Refresh: 1, ../index.php?page=fichas/importar_aprendices&ficha=$ficha");
    echo("<script>alert('El archivo no cumple con los campos solicitados')</script>");
  }

  // Eliminar juicios anteriores (en caso de que los haya) y resetear la cantidad de rae aprobados de cada aprendiz en 0
  eliminar_juicios_ficha($ficha);
  reset_juicios_aprendiz($ficha);

  while ($fila = fgetcsv($archivo, 0, ";")){

    $tipo_documento = strtoupper(trim($fila[0]));  

    $documento = intval($fila[1]);

    $nombre = trim($fila[2]);
    [$primer_nombre, $segundo_nombre] = obtener_nombres($nombre);

    $apellidos = $fila[3];
    [$primer_apellido, $segundo_apellido] = obtener_nombres($apellidos);

    $estado = strtolower(trim($fila[4]));

    $rae = $fila[6];
    $rae_final = obtener_rae($rae);
    $juicio = strtolower(trim($fila[7]));

    if (!comprobar_programa($ficha, $rae_final)){
      header("Refresh: 0.5, ../index.php?page=fichas/importar_aprendices&ficha=$ficha");
      echo "<script>alert('El programa de formación no coincide con el archivo insertado.')</script>";
      exit;
    }

    // Si el aprendiz no existe, lo crea
    if (!existe_aprendiz($documento)){
      crear_aprendiz($tipo_documento, $documento, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $estado, $ficha, 0);
    }

    $evaluador = $fila[8];

    $documento_evaluador = obtener_evaluador($evaluador);



    // Insertar los juicios evaluativos del aprendiz
    insertar_juicio($documento, $rae_final, $juicio, $documento_evaluador);

    // Actualizar la cantidad de juicios aprobados del aprendiz actual
    $cant_juicios = obtener_juicios_aprobados($documento);

    actualizar_juicios_aprendiz($cant_juicios, $documento);
  }

  fclose($archivo);

  header("Refresh: 0.5, ../index.php?page=fichas/visualizar_ficha&ficha=$ficha");
  echo "<script>alert('Aprendices importados correctamente')</script>";

  // Verificar que el programa coincida con el del archivo
  function comprobar_programa($ficha, $rae){
    global $conn;
    $sql = "SELECT id_programa_formacion FROM fichas WHERE nro_ficha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    $id_p_ficha = $result["id_programa_formacion"];

    $sql = "SELECT id_programa_formacion FROM competencias WHERE id = (SELECT id_competencia FROM resultados_aprendizaje WHERE id = ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rae);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    $id_p_rae = $result["id_programa_formacion"];

    return $id_p_ficha == $id_p_rae;
  }

  function obtener_nombres($cadena = ""){
    // Si no se proporciona contenido, devuelve null
    if (mb_strlen($cadena) == 0){
      return ["", ""];
    }

    $primer_nombre = [];

    for ($i = 0; $i < mb_strlen($cadena, "UTF-8"); $i++){
      $caracter = mb_substr($cadena, $i, 1, "UTF-8");
      if ($caracter === " "){
        $existe_seg_nombre = true;
        $posicion_seg_nombre = $i + 1;
        $segundo_nombre = [];
        break;
      }
      $primer_nombre[] = $caracter;
      $existe_seg_nombre = false;
    }

    $primer_nombre = implode('', $primer_nombre);

    if ($existe_seg_nombre){
      for ($i = $posicion_seg_nombre; $i < mb_strlen($cadena); $i++){
        $caracter = mb_substr($cadena, $i, 1, "UTF-8");
        $segundo_nombre[] = $caracter;
      }
      $segundo_nombre = implode('', $segundo_nombre);
    }

    if (isset($segundo_nombre)){
      return [$primer_nombre, $segundo_nombre];
    }

    return [$primer_nombre, null];
  }

  function existe_aprendiz($documento){
    global $conn;

    $sql = "SELECT nro_documento FROM aprendices WHERE nro_documento = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $documento);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows > 0;
  }

  function crear_aprendiz($tipo_documento, $documento, $nombre, $segundo_nombre, $apellido, $segundo_apellido, $estado, $ficha, $cant_rae_aprobados){
    global $conn;

    $sql = "INSERT INTO aprendices (nro_documento, tipo_documento, nombre, segundo_nombre, apellido, segundo_apellido, estado, nro_ficha, cant_rae_aprobados) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssii", $documento, $tipo_documento, $nombre, $segundo_nombre, $apellido, $segundo_apellido, $estado, $ficha, $cant_rae_aprobados);
    $stmt->execute();
  }

  function obtener_rae($rae){
    global $conn;

    $sql = "SELECT id FROM resultados_aprendizaje WHERE nombre_rae = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rae);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    return $result["id"];
  }

  function reset_juicios_aprendiz($ficha){
    global $conn;

    $sql = "UPDATE aprendices SET cant_rae_aprobados = 0 WHERE nro_ficha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);
    $stmt->execute();
  }

  function eliminar_juicios_ficha($ficha){
    global $conn;

    $sql = "DELETE FROM juicios_evaluativos WHERE id_aprendiz IN (SELECT nro_documento FROM aprendices WHERE nro_ficha = ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);
    $stmt->execute();
  }

  function obtener_juicios_aprobados($aprendiz){
    global $conn;

    $sql = "SELECT COUNT(id) as 'aprobados' FROM juicios_evaluativos WHERE id_aprendiz = ? AND estado = 'aprobado'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aprendiz);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    return $result["aprobados"];
  }

  function actualizar_juicios_aprendiz($cant_juicios, $aprendiz){
    global $conn;

    $sql = "UPDATE aprendices SET cant_rae_aprobados = ? WHERE nro_documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cant_juicios, $aprendiz);
    $stmt->execute();
  }

  function insertar_juicio($aprendiz, $rae, $juicio, $evaluador){
    global $conn;

    $sql = "INSERT INTO juicios_evaluativos (id_aprendiz, id_rae, estado, id_evaluador) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $aprendiz, $rae, $juicio, $evaluador);
    $stmt->execute();
  }

  function obtener_evaluador($columna_evaluador){
    // Separar nombre, tipo de documento y documento
    $evaluador = explode("-", $columna_evaluador);

    $info_documento = explode(" ", $evaluador[0]);

    return $info_documento[1];
  }
?>
