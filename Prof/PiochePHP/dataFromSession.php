<?php

  // Data from session
  include_once("./cfgCookies.php");
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];

  // Check
  if ($idUser == NULL) {
    header("Location: logout.php");
    exit();
  }

?>





<?php

  // Data from session
  include_once("./cfgCookies.php");
  session_start();
  $idUser = NULL;
  if (isset($_SESSION['idUser'])) $idUser = $_SESSION['idUser'];

  // Check
  if ($idUser == NULL) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>
