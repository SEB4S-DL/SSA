<?php
  header("Content-Type: application/json; charset=utf-8");

  if ($_SERVER["REQUEST_METHOD"] != "POST"){
    echo json_encode([
      "msg" => "Método http inválido",
      "state" => 1
    ]);
    exit();
  }
  
  require "../db/conection.php";

  if (!isset($_POST['token']) || !isset($_POST['password']) || !isset($_POST["password_confirm"])) {
    echo json_encode([
      "msg" => "Datos inválidos.",
      "state" => 1
    ]);
    exit();
  }

  $password = $_POST['password'];
  $pass2 = $_POST["password_confirm"];

  if ($password != $pass2){
    echo json_encode([
      "msg" => "Las contraseñas no coinciden.",
      "state" => 1
    ]);
    exit();
  }

  $token = $_POST['token'];
  $token_hash = hash("sha256", $token);

  // Buscar token
  $stmt = $conn->prepare("SELECT id, user_id, expires_at, used FROM password_reset_tokens WHERE token_hash = ?");
  $stmt->bind_param("s", $token_hash);
  $stmt->execute();
  $result = $stmt->get_result();
  $tokenData = $result->fetch_assoc();
  $stmt->close();

  if (!$tokenData || $tokenData['used'] || strtotime($tokenData['expires_at']) < time()) {
    echo json_encode([
      "msg" => "Token inválido o expirado.",
      "state" => 1
    ]);
    exit();
  }

  // Actualizar contraseña (ejemplo con password_hash)
  $hash = md5($password);
  $stmt = $conn->prepare("UPDATE usuarios SET contrasena=? WHERE nro_documento=?");
  $stmt->bind_param("si", $hash, $tokenData['user_id']);
  $stmt->execute();
  $stmt->close();

  // Marcar token como usado
  $stmt = $conn->prepare("UPDATE password_reset_tokens SET used=1 WHERE id=?");
  $stmt->bind_param("i", $tokenData['id']);
  $stmt->execute();
  $stmt->close();

  echo json_encode([
    "msg" => "Contraseña actualizada con éxito.\nSe le redireccionará dentro de 3 segundos.",
    "state" => 0
  ]);
?>
