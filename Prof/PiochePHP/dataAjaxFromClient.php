<?php

  // Data ajax from client
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $login = NULL;
  if (isset($data['login'])) $login = $data['login'];
  $pwd = NULL;
  if (isset($data['pwd'])) $pwd = $data['pwd'];

  // Check
  if ($login == NULL || $pwd == NULL) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>





<?php

  // Data ajax from client (filtered)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $login = NULL;
  if (preg_match("/^.{0,100}$/", $data['login'])) $login = $data['login'];
  $pwd = NULL;
  if (preg_match("/^.{0,100}$/", $data['pwd'])) $pwd = $data['pwd'];

  // Check
  if ($login == NULL || $pwd == NULL) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>





<?php

  // Data ajax from client (filtered + escaped)
  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $login = NULL;
  if (preg_match("/^.{0,100}$/", $data['login'])) $login = $db->real_escape_string($data['login']);
  $pwd = NULL;
  if (preg_match("/^.{0,100}$/", $data['pwd'])) $pwd = $db->real_escape_string($data['pwd']);

  // Check
  if ($login == NULL || $pwd == NULL) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>
