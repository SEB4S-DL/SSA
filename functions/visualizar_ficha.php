<?php
  if (session_status() == PHP_SESSION_NONE){
    session_start();
  }

  // Si no hay sesión iniciada o el rol del usuario actual no es admin, no permite usar este archivo
  if (!isset($_SESSION["user"]) || isset($_SESSION["user"]) && $_SESSION["user_rol"] != "admin"){
    header("../auth/login.php");
  }

  // No permite que se acceda a este archivo directamente, solo como include
  if (str_contains($_SERVER["PHP_SELF"], "functions/crear_ficha.php")){
    header("Location: ../index.php");
  }

  function obtener_aprendices(){
    if (isset($_GET["ficha"])){
      global $conn;
      $ficha = $_GET["ficha"];

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
      WHERE a.nro_ficha = ?
      GROUP BY a.nro_documento;";
  
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $ficha);

      $stmt->execute();

      $result = $stmt->get_result();

      return $result;
    }
    else{
      return "0";
    }
  }

  function obtener_fichas(){
    global $conn;
    $sql = "SELECT nro_ficha FROM fichas";

    $result = $conn->query($sql);

    $final_result = [];
    
    while ($res = $result->fetch_assoc()){
      $final_result[] = $res["nro_ficha"];
    }

    return $final_result;
  }

  function calcular_aprobado($aprendiz){
    $rae_actuales = $aprendiz["cant_rae_aprobados"];
    $total_rae = $aprendiz["total_rae"];

    if ($total_rae > 0)
    {
      $total_aprobado = floatval(number_format((($rae_actuales * 100) / $total_rae), 2, ",", "."));
    }
    else
    {
      $total_aprobado = 0;
    }


    return $total_aprobado;
  }
?>