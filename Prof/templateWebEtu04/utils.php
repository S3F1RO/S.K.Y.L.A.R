<?php
////////////////////////////////////////////////////////////////////////////////
// Utils library
////////////////////////////////////////////////////////////////////////////////



  // Generate random string
  function generateRandomString($length=100) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    for ($i = 0 ; $i < $length ; $i++) {
      $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
  }



  // SUCCESS / FAIL functions
  function success($db=NULL, $result=NULL, $html=NULL, $obj=NULL, $fields=[]) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Merge
    $out = array_merge(["success"=>true, "html"=>$html, "obj"=>$obj], $fields);

    // Data ajax to client
    echo json_encode($out);
    exit();
  }
  function fail($db=NULL, $result=NULL, $errorMsg=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Data ajax to client
    echo json_encode(["success"=>false, "errorMsg"=>$errorMsg]);
    exit();
  }
  function logout($db=NULL, $result=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Logout
    header("Location: logout.php");
    exit();
  }
  function redirect($page, $db=NULL, $result=NULL) {
    // DB close
    if ($db != NULL) $db->close();

    // Result close
    if ($result != NULL) $result->close();

    // Logout
    header("Location: $page");
    exit();
  }



  // Send ajax to server
  function sendAjax($url, $data) {
    // Init cURL
    $curl = curl_init();
    
    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);                                          // Server URL
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));                     // Data
    curl_setopt($curl, CURLOPT_POST, true);                                         // Send POST data
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                               // Get data instead of displaying
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);     // Use JSON format
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);                                        // Set timeout
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                              // Self-signed SSL for HTTPS : do not check the CA auth chain
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);                              // Self-signed SSL for HTTPS : do not check if hostname/certname matches
    curl_setopt($curl, CURLOPT_COOKIESESSION, false);                               // Do not use cookies from previous sessions
    
    // Exec cURL
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
    // FAIL
    if ($response === false || $httpCode >= 400) return NULL;
    $decoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) return NULL;

    return $decoded;
  }

?>
