<?php

  // DB select
  $query = "SELECT * FROM tblUsers WHERE theVar = '$theVar';";
  $result = $db->query($query);
  $numRows = $result->num_rows;

  // Check
  if ($numRows == 0) {
    header("Location: logout.php");
    exit();
  }

  // Data from DB
  while ($row = $result->fetch_assoc()) {
    $login = $row['login'];
    $pwd = $row['pwd'];
  }
  $result->close();

?>





<?php

  // DB select
  $query = "SELECT * FROM tblUsers WHERE theVar = '$theVar';";
  $result = $db->query($query);
  $numRows = $result->num_rows;

  // Check
  if ($numRows == 0) {
    echo json_encode(["success"=>false]);
    exit();
  }

  // Data from DB
  while ($row = $result->fetch_assoc()) {
    $login = $row['login'];
    $pwd = $row['pwd'];
  }
  $result->close();

?>
