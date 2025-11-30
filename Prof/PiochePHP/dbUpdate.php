<?php

  // DB update
  $query = "UPDATE tblUsers SET theVal = '4', theVar = '$theVar' WHERE id = 10;";
  $success = $db->query($query);

  // Check
  if (!$success) {
    header("Location: logout.php");
    exit();
  }

?>





<?php

  // DB update
  $query = "UPDATE tblUsers SET theVal = '4', theVar = '$theVar' WHERE id = 10;";
  $success = $db->query($query);

  // Check
  if (!$success) {
    echo json_encode(["success"=>false]);
    exit();
  }

?>
