<?php

  // Sym generate key : () --> (keyA)
  $keyA = substr(base64_encode(openssl_random_pseudo_bytes(100)), 0, 100);

?>
