<?php
  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }

  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("../auth/login.php");
  }

  // Verificar que el archivo no esté siendo un include y qué el método por el que se hay enviado sea "POST". Esto para que no se pueda acceder por url a este sitio y si se envío un formulario a este sitio (editar ficha), si pueda corresponder de forma adecuada
  if (str_contains($_SERVER["PHP_SELF"], "functions/listar_fichas.php")){
    if ($_SERVER["REQUEST_METHOD"] !== "POST"){
      header("Location: ../index.php");
      exit();
    }

    require_once "../db/conection.php";

    // Verificar que los datos enviados no hayan sido alterados
    if (datos_editar_validos()){
      editar_ficha();
    }
    else{
      header("Location: ../index.php?page=fichas/listar_fichas&status=1");
      exit();
    }
  }

  // Obtener todas las fichas en etapa lectiva
  function obtener_fichas(){
    global $conn;
    $sql = "SELECT p.nombre_programa, f.nro_ficha, f.id_jefe_ficha, f.jornada,
    CONCAT_WS(' ', u.nombre , u.segundo_nombre , u.apellido , u.segundo_apellido) AS 'nombre_jefe', f.tipo_oferta 
    from fichas f
    JOIN programa_formacion p
    ON f.id_programa_formacion = p.id
    JOIN usuarios u
    ON f.id_jefe_ficha = u.nro_documento 
    WHERE f.etapa = 'lectiva'";

    $resultado = $conn->query($sql);

    return $resultado;
  }

  // Obtener todos los instructores para el form de editar
  function obtener_instructores(){
    global $conn;

    $sql = "SELECT nro_documento, CONCAT_ws(' ', nombre, segundo_nombre, apellido, segundo_apellido) AS nombre
    FROM usuarios WHERE rol = 'user' AND estado = 'habilitado'";

    $result = $conn->query($sql);

    return $result;
  }

  // Verificar que los datos enviados por el form no hayan sido alterados
  function datos_editar_validos(){
    $jefe = intval($_POST["jefe_grupo"]);
    $ficha = intval($_POST["ficha_nro"]);
    $jornada = $_POST["ficha_jornada"];
    $etapa = $_POST["ficha_etapa"];

    // Array para almacenar el id de los instructores válidos
    $instructores = [];
    
    // Obtener los instructores y asignarlos al array
    $instructores_sql = obtener_instructores();
    while ($instructor = $instructores_sql->fetch_assoc()){
      $instructores[] = $instructor["nro_documento"];
    }

    $jornadas_validas = ["diurna", "mixta", "nocturna"];

    // Array que contiene las fichas válidas
    $fichas = [];

    $fichas_sql = obtener_fichas();

    while($ficha_sql = $fichas_sql->fetch_assoc()){
      $fichas[] = $ficha_sql["nro_ficha"];
    }

    // Array que contiene las etapa válidas
    $etapas_validas = ["lectiva", "productiva"];

    // Verificar que los datos enviados por el formulario no hayan sido alterados
    if (in_array($jefe, $instructores) && in_array($jornada, $jornadas_validas) && in_array($ficha, $fichas) && in_array($etapa, $etapas_validas)){
      return true;
    }

    return false;
  }

  // Editar la ficha con los datos enviados por el metodo post
  function editar_ficha(){
    global $conn;
    $jefe = intval($_POST["jefe_grupo"]);
    $ficha = intval($_POST["ficha_nro"]);
    $jornada = $_POST["ficha_jornada"];
    $etapa = $_POST["ficha_etapa"];

    $sql = "UPDATE fichas SET id_jefe_ficha = ?, jornada = ?, etapa = ? WHERE nro_ficha = ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $jefe, $jornada, $etapa, $ficha);

    if ($stmt->execute()){
      if($stmt->affected_rows > 0){
        header("Location: ../index.php?page=fichas/listar_fichas&status=0");
        exit();
      }
      else{
        header("Location: ../index.php?page=fichas/listar_fichas&status=2");
        exit();
      }
    }
    else{
      header("Location: ../index.php?page=fichas/listar_fichas&status=1");
      exit();
    }
  }
?>