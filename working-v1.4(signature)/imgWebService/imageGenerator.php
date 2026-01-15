<?php

  // Includes
  include_once('./utils.php');

  /// Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");

  // Data ajax from client (filtered + escaped)
  $data = json_decode(file_get_contents('php://input'), true);
  
  $color = NULL;
  if (preg_match("/^.{0,20}$/", $data['color'])) $color = escape_string($data['color']);
  $level = NULL;
  if (preg_match("/^[0-8]$/", $data['level'])) $level = escape_string($data['level']);
  $masteringLevel = NULL;
  if (preg_match("/^[1-4]$/", $data['masteringLevel'])) $masteringLevel = escape_string($data['masteringLevel']);
  $imgUrl = NULL;
  if (preg_match("/^.{1,100}$/", $data['imgUrl'])) $imgUrl = escape_string($data['imgUrl']);
  $mainName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['mainName'])) $mainName = escape_string($data['mainName']);
  $subName = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['subName'])) $subName = escape_string($data['subName']);
  $domain = NULL;
  if (preg_match("/^[A-Za-z0-9\-\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ&\'\.:,! ]{1,20}$/", $data['domain'])) $domain = escape_string($data['domain']);
  
  // Check
  if ($color == NULL || $level == NULL || $masteringLevel == NULL || $imgUrl == NULL || $mainName == NULL || $domain == NULL) {
    fail();
  }

  
  fail($color);
  
  $imgName = pathinfo(parse_url($imgUrl, PHP_URL_PATH), PATHINFO_FILENAME);
  $output = shell_exec("generateSticker.sh $color $level $masteringLevel $imgName");
  
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