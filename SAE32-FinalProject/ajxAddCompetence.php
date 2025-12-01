<?php
include_once('./utils.php');

// Vérifier si on a bien reçu les données JSON
if (!isset($_POST['data'])) {
  echo json_encode([
    "success" => false,
    "message" => "Aucune donnée reçue"
  ]);
  exit();
}

// Décoder JSON reçu depuis sendAjax()
$data = json_decode($_POST['data'], true);

// Récupération des champs envoyés par le JS
// $idUTeacher     = $data["idUTeacher"]     ?? "";
// $idUStudent     = $data["idUStudent"]     ?? "";
// $idSkill        = $data["idSkill"]        ?? "";
$currentDate    = $data["currentDate"]    ?? "";
$revokedDate    = $data["revokedDate"]    ?? "";
$masteryLevel   = $data["masteryLevel"]   ?? "";

// Envoi vers le webservice serveur
$response = sendAjax(
  "http://localhost/SAE32/TeamAjax/3.WORK/svcAddCompetence.php",
  [
    // "idUTeacher"   => $idUTeacher,
    // "idUStudent"   => $idUStudent,
    // "idSkill"      => $idSkill,
    "currentDate"  => $currentDate,
    "revokedDate"  => $revokedDate,
    "masteryLevel" => $masteryLevel
  ]
);

// Retour au JS
echo json_encode($response);
?>
