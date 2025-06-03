<?php
  if (!isset($_SESSION["user"])){
    header("Location: ../auth/login.php");
  }

  $page = $_GET["page"] ?? "fichas/listar_fichas";

  $file = "pages/$page.php";

  if (file_exists($file) && is_file($file)){
    include $file;
  }
  else{
    echo "<p style='color:red'>La página solicitada no existe.</p>";
  }
?>