<?php
  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }

  // Si no hay sesión iniciada o el rol del usuario actual no es admin, no permite usar este archivo
  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("Location: ../auth/login.php");
  }

  if (str_contains($_SERVER["PHP_SELF"], "functions/crear_ficha.php")){
    if ($_SERVER["REQUEST_METHOD"] !== "POST"){
      header("Location: ../index.php");
      exit();
    }

    require_once "../db/conection.php";

    if (validar_datos()){
      crear_ficha();
    }
    else{
      header("Location: ../index.php?page=fichas/crear_ficha&status=1");
    }
  }

  function obtener_usuarios(){
    global $conn;
    $sql = "SELECT nro_documento, CONCAT_WS(' ', nombre, segundo_nombre, apellido, segundo_apellido) AS nombre
    FROM usuarios WHERE estado = 'habilitado'";

    $resultado = $conn->query($sql);

    return $resultado;
  }

  function obtener_programas(){
    global $conn;
    $sql = "SELECT id, nombre_programa, nivel FROM programa_formacion";

    $result = $conn->query($sql);

    return $result;
  }

  function validar_datos(){
    $ficha = intval($_POST["numero_ficha"]);

    if (existe_ficha($ficha)){
      header("Location: ../index.php?page=fichas/crear_ficha&status=2");
      exit();
    }


    $jefe = intval($_POST["jefe_grupo"]);

    $jefes_validos = [];

    $jefes_sql = obtener_usuarios();

    while ($jefe_sql = $jefes_sql->fetch_assoc()){
      $jefes_validos[] = $jefe_sql["nro_documento"];
    }


    $jornada = $_POST["jornada"];
    $jornadas_validas = ["diurna", "mixta", "nocturna"];


    $programa = $_POST["programa_formacion"];

    $programas_validos = [];

    $programas_sql = obtener_programas();

    while ($programa_sql = $programas_sql->fetch_assoc()){
      $programas_validos[] = $programa_sql["id"];
    }


    $oferta = $_POST["oferta"];

    $ofertas_validas = ["abierta", "cerrada"];

    if ($ficha > 0 && in_array($jefe, $jefes_validos) && in_array($jornada, $jornadas_validas) && in_array($programa, $programas_validos) && in_array($oferta, $ofertas_validas)){
      return true;
    }

    return false;
  }

  function crear_ficha(){
    global $conn;

    $ficha = intval($_POST["numero_ficha"]);
    $jefe = intval($_POST["jefe_grupo"]);
    $jornada = $_POST["jornada"];
    $programa = intval($_POST["programa_formacion"]);
    $tipo_oferta = $_POST["oferta"];

    $sql = "INSERT INTO fichas (nro_ficha, id_jefe_ficha, jornada, etapa, id_programa_formacion, tipo_oferta)
    VALUES (?, ?, ?, 'lectiva', ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisis", $ficha, $jefe, $jornada, $programa, $tipo_oferta);

    if ($stmt->execute()){
      header("Location: ../index.php?page=fichas/listar_fichas&status=3");
    }
    else{
      header("Location: ../index.php?page=fichas/crear_ficha&status=1");
    }
  }

  function existe_ficha($numero){
    global $conn;
    $sql = "SELECT nro_ficha FROM fichas WHERE nro_ficha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $numero);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0){
      return true;
    }

    return false;
  }
?>