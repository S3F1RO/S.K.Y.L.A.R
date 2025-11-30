<?php

  // Build data
  $html = "<p>My HTML</p>";
  $obj = [];
  $obj[] = "value1";
  $obj[] = "value2";
  $obj[] = "value3";

  // Data ajax to client
  echo json_encode(["success"=>true, "html"=>$html, "obj"=>$obj]);
  exit();

?>
