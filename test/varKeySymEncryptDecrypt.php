<?php

  // Load key
  include_once("./varKey1.php");

  // Sym encrypt data : (data, key) --> (encryptedData, iv, tag)
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));   // Generate initialization vector
  $encryptedData = openssl_encrypt($data, "aes-256-gcm", KEY1, $options=0, $iv, $tag); // Encrypt data and generate authentication tag

  // Encode
  $encryptedData = base64_encode($encryptedData);
  $iv = base64_encode($iv);
  $tag = base64_encode($tag);

?>





<?php

  // Load key
  include_once("./varKey1.php");

  // Decode
  $encryptedData = base64_decode($encryptedData);
  $iv = base64_decode($iv);
  $tag = base64_decode($tag);

  // Sym decrypt data : (encryptedData, iv, tag, key) --> (data)
  $data = openssl_decrypt($encryptedData, "aes-256-gcm", KEY1, $options=0, $iv, $tag); // Decrypt data

?>
