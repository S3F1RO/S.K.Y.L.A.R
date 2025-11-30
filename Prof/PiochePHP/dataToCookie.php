<?php

  // Data to cookie
  include_once("./cfgCookies.php");
  setcookie('cookie', "value", time() + COOKIE_LIFETIME, COOKIE_PATH, COOKIE_DOMAIN);

?>





<?php

  // Delete cookie
  include_once("./cfgCookies.php");
  setcookie('cookie', "", time() - 1, COOKIE_PATH, COOKIE_DOMAIN);

?>
