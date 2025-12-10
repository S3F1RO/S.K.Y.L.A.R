<?php

  // Decode
  $pubA = base64_decode($pubA);

  // Asym encrypt data : (dataB, pubA) --> (dataBCryptPubA)
  openssl_public_encrypt($dataB, $dataBCryptPubA, $pubA);

  // Encode
  $dataBCryptPubA = base64_encode($dataBCryptPubA);

?>





<?php

  // Decode
  $dataBCryptPubA = base64_decode($dataBCryptPubA);
  $privA = base64_decode($privA);

  // Asym decrypt data : (dataBCryptPubA, privA) --> (dataB)
  openssl_private_decrypt($dataBCryptPubA, $dataB, $privA);

?>
