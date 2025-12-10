<?php
  include_once('./cfgDbWebClient.php');
  
  //Open DB
  $db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
  $db->set_charset("utf8");
  $html = "Prénom, nom ou pseudo invalide";

  // Asym generate keys : () --> (privA, pubA)
  $keysA = openssl_pkey_new(array('private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA));
  openssl_pkey_export($keysA, $privA);                                          // Private key
  $pubA = openssl_pkey_get_details($keysA)['key'];                              // Public key

  // Encode
  $privA = base64_encode($privA);
  $pubA = base64_encode($pubA);

  //OTHER PROGRAM
  $passphrase = "password";
  $keysU = openssl_pkey_new(array('private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA));
  openssl_pkey_export($keysU, $privU);                                          // Private key
  $pubU = openssl_pkey_get_details($keysU)['key'];
  
  //Encode to be lisible
  $privU = base64_encode($privU);
  $pubU = base64_encode($pubU);   

  //Encrypt Key 
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));   // Generate initialization vector
  $encryptedPrivKey = openssl_encrypt($privU, "aes-256-gcm", $passphrase, $options=0, $iv, $tag); // Encrypt data and generate authentication tag
  $encryptedPrivKey = base64_encode($encryptedPrivKey);
  $iv = base64_encode($iv);
  $tag = base64_encode($tag);

  //Get Crypted Key from DB
  $query="SELECT * FROM tblUsers WHERE idUser='26'";
  $result = $db->query($query);
  while($row = $result->fetch_assoc()){
    $privUCryptPassU = $row['privUCryptPassU'];
    $privUCryptIv = $row['privUCryptIv'];
    $privUCryptTag  = $row['privUCryptTag'];
  }
  $key = base64_decode($privUCryptPassU);
  $iv = base64_decode($privUCryptIv);
  $tag = base64_decode($privUCryptTag);
  echo "$key,$iv,$tag";
  // //TRYING TO DECRYPT KEY
  // $encryptedData = base64_decode($encryptedPrivKey);
  // $iv = base64_decode($iv);
  // $tag = base64_decode($tag);

  // $passphrase = "falsepass";
  //Decrypt data
  $data = openssl_decrypt($key, "aes-256-gcm", $passphrase, $options=0, $iv, $tag); // 
  if (empty($data)) echo "Not decoded";
  else echo "Data decoded : $data";


?>
