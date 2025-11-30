<?php

  // Data from cookie
  $cookie = NULL;
  if (isset($_COOKIE['cookie'])) $cookie = $_COOKIE['cookie'];

  // Check
  if ($cookie == NULL) {
    header("Location: logout.php");
    exit();
  }

?>





<?php

  // Data from cookie
  $cookie = NULL;
  if (isset($_COOKIE['cookie'])) $cookie = $_COOKIE['cookie'];

  // Check
  if ($cookie == NULL) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>
