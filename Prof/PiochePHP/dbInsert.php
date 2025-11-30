<?php

  // DB insert
  $query = "INSERT INTO tblUsers (id ,theVar) VALUES (NULL , '$theVar');";
  $success = $db->query($query);

  // Check
  if (!$success) {
    header("Location: logout.php");
    exit();
  }
  $lastInsertedId = $db->insert_id;
  
?>





<?php

  // DB insert
  $query = "INSERT INTO tblUsers (id ,theVar) VALUES (NULL , '$theVar');";
  $success = $db->query($query);

  // Check
  if (!$success) {
    echo json_encode(["success"=>false]);
    exit();
  }
  $lastInsertedId = $db->insert_id;

?>
