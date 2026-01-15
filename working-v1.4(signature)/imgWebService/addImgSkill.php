<?php

  // Includes
  include_once('./utils.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");
  
  // Data from WebService (ajax)
  $imgFile = $_FILES['file'];
  
  // Check
  if (!isset($imgFile) || $imgFile['error'] !== UPLOAD_ERR_OK) {
    fail();
  } 
  
  // Save file 
  $newFilename = generateRandomString($length=20);
  
  $imgPath = "uploads/$newFilename.png";

  if (file_exists($imgPath)) {
    fail();
  } else {
    $success = move_uploaded_file($imgFile["tmp_name"], $imgPath);
  }

  // JSON send back
  if (!$success) fail();
  success(["imgPath" => $imgPath]);
  
?>