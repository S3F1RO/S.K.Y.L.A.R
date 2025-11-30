<?php

  // Data from client
  $login = NULL;
  if (isset($_POST['login'])) $login = $_POST['login'];
  $pwd = NULL;
  if (isset($_POST['pwd'])) $pwd = $_POST['pwd'];

  // Check
  if ($login == NULL || $pwd == NULL) {
    header("Location: logout.php");
    exit();
  }

?>





<?php

  // Data from client (filtered)
  $login = NULL;
  if (preg_match("/^.{0,100}$/", $_POST['login'])) $login = $_POST['login'];
  $pwd = NULL;
  if (preg_match("/^.{0,100}$/", $_POST['pwd'])) $pwd = $_POST['pwd'];

  // Check
  if ($login == NULL || $pwd == NULL) {
    header("Location: logout.php");
    exit();
  }

?>





<?php

  // Data from client (filtered + escaped)
  $login = NULL;
  if (preg_match("/^.{0,100}$/", $_POST['login'])) $login = $db->real_escape_string($_POST['login']);
  $pwd = NULL;
  if (preg_match("/^.{0,100}$/", $_POST['pwd'])) $pwd = $db->real_escape_string($_POST['pwd']);

  // Check
  if ($login == NULL || $pwd == NULL) {
    header("Location: logout.php");
    exit();
  }

?>
