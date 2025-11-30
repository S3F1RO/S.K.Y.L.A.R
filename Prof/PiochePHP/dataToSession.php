<?php

  // Data to session
  include_once("./cfgCookies.php");
  session_start();
  $_SESSION['idUser'] = $idUser;

  // Redirect
  header("Location: nexPage.php");
  exit();

?>
