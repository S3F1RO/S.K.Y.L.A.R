<?php
include_once('./utils.php');
include_once('./params.php');


$html = "<span>Prénom, nom ou pseudo invalide</span>";

// Vérifier si on a reçu des données
if (!isset($_POST['data'])) {
    echo json_encode([
        "success" => false,
        "html" => $html
    ]);
    exit();
}

// Décoder les données JSON envoyées
$data = json_decode($_POST['data'], true);

// Initialiser les variables
$firstName = NULL;
$lastName  = NULL;
$nickname = NULL;

if (isset($data['firstName'])) {
    $firstName = $data['firstName'];
}
if (isset($data['lastName'])) {
    $lastName = $data['lastName'];
}
if (isset($data['nickname'])) {
    $nickname = $data['nickname'];
}

if ($firstName == NULL || $lastName == NULL || $nickname == NULL) {
    echo json_encode([
        "success" => false,
        "html" => $html
    ]);
    exit();
}

// Réponse AJAX envoyée au JavaScript
$data = sendAjax($URL . "svcAddUser.php", ["firstName" => $firstName, "lastName"  => $lastName, "nickname" => $nickname]);
echo json_encode(["success" => true, "id" => $data["id"]]);

?>
