<?php

  // Decode
  $privA = base64_decode($privA);

  // Asym sign data : (dataA, privA) --> (dataAHashSignPrivA)
  openssl_sign($dataA, $dataAHashSignPrivA, $privA, OPENSSL_ALGO_SHA256);

  // Encode
  $dataAHashSignPrivA = base64_encode($dataAHashSignPrivA);

?>





<?php

  // Decode
  $dataAHashSignPrivA = base64_decode($dataAHashSignPrivA);
  $pubA = base64_decode($pubA);

  // Asym verify data : (dataA, dataAHashSignPrivA, pubA) --> (isDataAVerified)
  $isDataAVerified = openssl_verify($dataA, $dataAHashSignPrivA, $pubA, "sha256WithRSAEncryption");
  if ($isDataAVerified) echo "Data A verified.\n";

?>
