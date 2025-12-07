<?php

  include_once('./utils.php');
  include_once('./params.php');
  
  // Data from session
  session_start();
  $idUTeacher = NULL;
  if (isset($_SESSION['idUser'])) $idUTeacher = $_SESSION['idUser'];

  // Check
  if ($idUTeacher == NULL) {
    header("Location: logout.php");
    exit();
  }

  $html = "<span>Information(s) incorrecte(s)</span>";

  if (isset($_POST['data'])) $data = json_decode($_POST['data'], true);
  $idSkill = NULL;
  if (preg_match("/^[0-9]+$/", $data['idSkill'])) $idSkill = $data['idSkill'];
  $idUStudent = NULL;
  if (preg_match("/^[0-9]+$/", $data['idUStudent'])) $idUStudent = $data['idUStudent'];
  $masteringLevel = NULL;
  if (preg_match("/^[0-9]$/", $data['masteringLevel'])) $masteringLevel = $data['masteringLevel'];
  $revokedDate = NULL;
  if (preg_match("/^[0-9\-]{10}$/", $data['revokedDate'])) $revokedDate = $data['revokedDate'];

  // Check
  if ($idUStudent == NULL || $masteringLevel == NULL || $idSkill == NULL) {
    echo json_encode(["success"=>false, 'html'=>$html]);
    exit();
  }
  
  $data = ["idSkill" => $idSkill, "idUTeacher" => $idUTeacher, "idUStudent" => $idUStudent, "revokedDate" => $revokedDate, "masteringLevel" => $masteringLevel];

  // ----- Envoi au WebService -----
  $response = sendAjax($URL . "svcAddCompetence.php", $data);

  // Vérifier la réponse du serveur
  if ($response["id"] == NULL) {
    echo json_encode([
      "success" => false,
      'html'=>$html
    ]);
    exit();
  }

  // Réponse finale pour le JS
  echo json_encode([
    "success" => true,
    "id"      => $response["id"]
  ]);
  exit();

?>
