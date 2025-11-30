<?php

  // Data ajax from server
  header('Content-Type: application/json');
  $data = json_decode(file_get_contents('php://input'), true);
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

  // Data ajax from server (filtered)
  header('Content-Type: application/json');
  $data = json_decode(file_get_contents('php://input'), true);
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

  // Data ajax from server (filtered + escaped)
  header('Content-Type: application/json');
  $data = json_decode(file_get_contents('php://input'), true);
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
