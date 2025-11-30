<?php

  // Session open
  include_once("./cfgCookies.php");
  session_start();

  // Unset session vars
  session_unset();

  // Session close, go to index page
  if (session_destroy()) {
    header("Location: index.php");
  }

?>
