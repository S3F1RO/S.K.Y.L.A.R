<?php

  // Asym generate keys : () --> (privA, pubA)
  $keysA = openssl_pkey_new(array('private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA));
  openssl_pkey_export($keysA, $privA);                                          // Private key
  $pubA = openssl_pkey_get_details($keysA)['key'];                              // Public key

  // Encode
  $privA = base64_encode($privA);
  $pubA = base64_encode($pubA);

?>
