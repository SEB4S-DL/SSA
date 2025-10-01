<?php
session_start();
require_once "../db/conection.php";

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE usuarios SET is_logged_in = 0 WHERE nro_documento = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Limpiar sesión y cookies
session_unset();
setcookie(session_name(), "", time() - 3600);
session_destroy();

header("Location: ./login.php");
exit();
?>
