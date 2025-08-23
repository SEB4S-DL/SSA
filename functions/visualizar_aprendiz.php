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

  function obtener_info(){
    global $conn;
    $sql = "SELECT a.nro_documento, a.tipo_documento, a.estado,
    CONCAT_WS(' ', a.nombre, a.segundo_nombre, a.apellido, a.segundo_apellido) AS nombre,
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
    WHERE a.nro_ficha = ? AND a.nro_documento = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $_GET["ficha"], $_GET["aprendiz"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $result = $result->fetch_assoc();

    return $result;
  }

  function obtener_juicios(){
    global $conn;
    $sql = "SELECT c.nombre_competencia, r.nombre_rae, j.*
    FROM juicios_evaluativos j
    JOIN resultados_aprendizaje r
    ON r.id = j.id_rae
    JOIN competencias c
    ON c.id = r.id_competencia
    WHERE j.id_aprendiz = ?
    ORDER BY j.estado ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["aprendiz"]);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
  }
?>