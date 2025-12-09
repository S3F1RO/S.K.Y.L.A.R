<?php

  include_once('./utils.php');
  include_once('./params.php');
  include_once('./cfgDbWebClient.php');
  
  //Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");
  $html = "Prénom, nom ou pseudo invalide";

  // Check
  if (!isset($_POST['data'])) {
    fail($html);
  }

  // JSON decode
  $data = json_decode($_POST['data'], true);

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $firstName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ]{1,20}$/", $data['firstName'])) $firstName = $data['firstName'];
  $lastName = NULL;
  if (preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ ]{1,20}$/", $data['lastName'])) $lastName = $data['lastName'];
  $nickname = NULL;
  if (preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['nickname'])) $nickname = $data['nickname'];
  $passphrase = NULL;
  if (preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['passphrase'])) $passphrase = $data['passphrase'];
  // Check
  if ($lastName == NULL || $nickname == NULL || $firstName == NULL || $passphrase == NULL ) {
    fail($html);
  }
  //Creation dof the Asym key couple
  $keysA = openssl_pkey_new(array('private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA));
  openssl_pkey_export($keysA, $privA);                                          // Private key
  $pubA = openssl_pkey_get_details($keysA)['key'];
  
  //Encode to be lisible
  $privA = base64_encode($privA);
  $pubA = base64_encode($pubA);   
  
  //Encrypt Data 
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));   // Generate initialization vector
  $encryptedData = openssl_encrypt($privA, "aes-256-gcm", $passphrase, $options=0, $iv, $tag); // Encrypt data and generate authentication tag
  $encryptedData = base64_encode($encryptedData);
  $iv = base64_encode($iv);
  $tag = base64_encode($tag);
  
  $data = sendAjax($URL . "svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname,"passphrase"=>$passphrase]);
  //Insert DATA into DB
  // Réponse AJAX envoyée au JavaScript
  success(["idUser" => $data["idUser"]])

?>
