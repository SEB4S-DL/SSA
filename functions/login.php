<?php
  // Código solo para el login. No reutilizar en otras páginas


  require_once "../db/conection.php";

  function validarDatos(){
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
      $email = $_POST["email"];
      $password = $_POST["password"];

      // Hacer una consulta a la db para verificar que las credenciales sean correctas
      
      if (existeUsuario($email, $password)){
        return true;
      }

      return false;
    }
  }

  function existeUsuario($email, $password){
    global $conn;
    $encryptedPassword = md5($password);


    $sql = "SELECT * FROM usuarios WHERE correo_institucional = ? AND contrasena = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $encryptedPassword);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0){
      return true;
    }
    
    return false;
  }

  // Consultar el usuario con las credenciales que se enviaron por el form
  function consultarUsuario(){
    global $conn;

    $email = $_POST["email"];

    $password = md5($_POST["password"]);

    $sql = "SELECT nro_documento, nombre, rol, correo_institucional
    FROM usuarios WHERE correo_institucional = ? AND contrasena = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();

    return $result->fetch_assoc();
  }
?>