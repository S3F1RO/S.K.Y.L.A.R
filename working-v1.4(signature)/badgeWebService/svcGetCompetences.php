<?php
  include_once('./utils.php');
  include_once('./dataStorageWrapper.php');

  // Allow JSON content
  header("Content-Type: application/json; charset=UTF-8");
  // Data ajax from server
  $data = json_decode(file_get_contents('php://input'), true);
  $idCompetences = $data['idCompetences'];
  
  // Check
  if (empty($idCompetences)) fail();
  
  //array to stock competences 
  $idC = [];
  // Loop through each competence ID
  foreach ($idCompetences as $idCompetence) {
    
    // filtered + escaped data
    if (preg_match("/^[0-9]+$/", $idCompetence)) $idCompetence = escape_string($idCompetence);
    $idC[] = $idCompetence; 

    // Check
    if (empty($idC)) fail();
  }
  
  // Get competence data
  $competences = getVerifiedCompetences($idC);
  
  // Send back a JSON response
  if ($competences == []) fail();
  success(["competences" => $competences]);
  
?>