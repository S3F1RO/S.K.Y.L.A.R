<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


include_once('./utils.php');
include_once('./params.php');
include_once('./cfgDbWebClient.php');
include_once('./cfgDb.php');

// DB pour infos tblUsers
$dbUsers = new mysqli(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME);
$dbUsers->set_charset("utf8");
// DB pour tblClientUsers
$db = new mysqli(DBWEBCLIENT_HOST, DBWEBCLIENT_LOGIN, DBWEBCLIENT_PWD, DBWEBCLIENT_NAME);
$db->set_charset("utf8");

$html = "Invalid first name, last name, nickname or password";

// Check POST data
if (!isset($_POST['data'])) fail($html);
$data = json_decode($_POST['data'], true);

// Validate inputs
$firstName = preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ]{1,20}$/", $data['firstName']) ? $dbUsers->real_escape_string($data['firstName']) : null;
$lastName  = preg_match("/^[A-Za-z\-éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ ]{1,20}$/", $data['lastName']) ? $dbUsers->real_escape_string($data['lastName']) : null;
$nickname  = preg_match("/^[A-Za-z0-9\-\'\#éèêëÉÈÊËàâäÀÂÄïìîÏÌÎÿŷỳŸỲŶùûüÙÛÜòôöÒÔÖçÇ& ]{1,20}$/", $data['nickname']) ? $dbUsers->real_escape_string($data['nickname']) : null;
$passphrase = !empty($data['passphrase']) ? $data['passphrase'] : null;

if (!$firstName || !$lastName || !$nickname || !$passphrase) fail($html);

// Insert into tblUsers
$query = "INSERT INTO `tblUsers` (`firstName`, `lastName`, `nickname`) VALUES ('$firstName', '$lastName', '$nickname')";
if (!$dbUsers->query($query)) fail("User insertion error: " . $dbUsers->error);

$idUser = $dbUsers->insert_id;

// Generate keys
$keysU = openssl_pkey_new(['private_key_bits'=>2048,'private_key_type'=>OPENSSL_KEYTYPE_RSA]);
openssl_pkey_export($keysU, $privU);
$pubU = openssl_pkey_get_details($keysU)['key'];

// Encrypt private key
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-gcm"));
$encryptedPrivKey = openssl_encrypt($privU, "aes-256-gcm", $passphrase, 0, $iv, $tag);

// Signature
$pubU = base64_encode($pubU);
openssl_sign($firstName.$lastName.$nickname.$pubU, $userInfosHashCryptPrivU, $privU, OPENSSL_ALGO_SHA256);

// Encode for storage
$userInfosHashCryptPrivU = base64_encode($userInfosHashCryptPrivU);
$encryptedPrivKey = base64_encode($encryptedPrivKey);
$iv = base64_encode($iv);
$tag = base64_encode($tag);

// Insert into tblClientUsers
$query = "INSERT INTO `tblClientUsers` (`id`, `privUCryptPassU`, `privUCryptPassUIv`, `privUCryptPassUTag`) 
          VALUES ($idUser, '$encryptedPrivKey', '$iv', '$tag')";
if (!$db->query($query)) fail("Client user insertion error: ".$db->error);
header('Content-Type: application/json');
echo json_encode([
    "success" => true,
    "idUser" => $idUser
]);
exit();

?>
