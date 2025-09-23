<?php

  header("Content-Type: application/json; charset=utf-8");

  if ($_SERVER["REQUEST_METHOD"] != "POST"){
    echo json_encode(["msg" => "Método http no válido."]);
    exit();
  }

  require "../db/conection.php";

  if (!isset($_POST["email"])){
    echo json_encode(["msg" => "Correo no proporcionado.", "state" => 1]);
    exit();
  }

  // Recuperar el email del usuario
  $email = $_POST["email"];

  // Validar que el usuario exista
  $sql = "SELECT nro_documento FROM usuarios WHERE correo_institucional = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result();

  if ($result->num_rows < 1)
  {
    echo json_encode([
      "msg" => "No existe un usuario registrado con el correo ingresado.",
      "state" => 1
    ]);
    exit();
  }

  require '../vendor/autoload.php';

  use Brevo\Client\Api\TransactionalEmailsApi;
  use Brevo\Client\Configuration;
  use Brevo\Client\Model\SendSmtpEmail;
  use GuzzleHttp\Client;

  $cafile = "C:\\wamp64\\www\\SSA\\cert\\cacert.pem";

  if (!file_exists($cafile) || !is_readable($cafile)) {
    throw new \RuntimeException("No se encuentra o no es legible el archivo CA en: $cafile");
  }

  // Crear Guzzle indicando la ruta al bundle de CA
  $guzzle = new Client([
    'verify' => $cafile, // aquí forzamos el archivo de certificados
    // opcionalmente, timeout, proxy, etc.
  ]);
  
  // 1. Configurar la API Key
  $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

  // 2. Crear instancia de API
  $apiInstance = new TransactionalEmailsApi(
    $guzzle,
    $config
  );

  $html = file_get_contents("../recoveryPass.html");

  // 3. Definir el correo
  $sendSmtpEmail = new SendSmtpEmail([
      'subject' => 'Enlace de recuperación de contraseña',
      'sender' => ['name' => 'SSA', 'email' => 'ssa@s3b4s-dl.dev'],
      'to' => [
          ['email' => $email, 'name' => 'Usuario']
      ],
      'htmlContent' => $html
  ]);

  try {
      // 4. Enviar
      $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
      echo json_encode([
        "msg" => "Correo de recuperación enviado, por favor revise su correo",
        "state" => 0
      ]);
  } catch (Exception $e) {
      echo json_encode([
        "msg" => 'Error al enviar el correo de recuperación: ' . $e->getMessage(),
        "state" => 1]);
  }
?>