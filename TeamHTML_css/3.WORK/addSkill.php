
<!-- if u wana test blud just pass to .php -->

<!-- <?php  


  // Data to session
 session_start();

// Vérifie si idUser est passé en GET (depuis l'étape 1)
if (isset($_GET['idUser']) && is_numeric($_GET['idUser'])) {
    $_SESSION['idUser'] = intval($_GET['idUser']);
} else {
    // Si pas d'idUser, on renvoie à l'étape 1
    header("Location: addUser.php");
    exit();
}

// Maintenant tu peux utiliser $_SESSION['idUser'] dans tes appels AJAX
$idUser = $_SESSION['idUser'];
$step = 2

?> -->


<!DOCTYPE html>

<html>
  <!-- Head -->
  <head>
    <!-- CSS files -->
    <link rel='stylesheet' type='text/css' href='./css/web.css' media='screen' />
    <!-- <link rel='stylesheet' type='text/css' href='./css/00_reset.css' media='screen' /> -->
    <!-- <link rel='stylesheet' type='text/css' href='./css/01_mobile.css' media='screen' /> -->
    <link rel='stylesheet' type='text/css' href='./css/02_fonts.css' media='screen' />
    <link rel='stylesheet' type='text/css' href='./css/03_icons.css' media='screen' />

    <!-- JS files -->
    <script type='text/javascript' src='./js/jquery-3.7.0.min.js'></script>
    <script type='text/javascript' src='./js/ajxAddSkill.js'></script> 
    <!-- <script type='text/javascript' src='./js/refresh1s.js'></script> -->
    <script type='text/javascript' src='./js/web.js'></script>

    <!-- UTF8 encoding -->
    <meta charset='UTF-8'>

    <!-- Prevent from zooming -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0,  shrink-to-fit=no"> -->

    <!-- Icon -->
    <link rel='icon' type='image/png' href='./medias/iut.png' />

    <!-- Title -->
    <title>Skills</title>
  </head>

  <!-- Body -->
  <body>
    <!-- Wrapper -->
    <div class='wrapper'>

	<h1>Add skills</h1>
	<ul>

    <!-- éléments venant de l'AJAX -->

    <!-- Champ des skills--> 
     <!-- Progress bar -->
    <div class="progress-bar">
        <div class="progress-step <?php echo ($step==1?'completed':'completed'); ?>">
            <div class="circle">1</div>
            <span>Utilisateur</span>
        </div>
        <div class="progress-step <?php echo ($step==2?'active':''); ?>">
            <div class="circle">2</div>
            <span>Compétences</span>
        </div>
        <div class="progress-step locked">
            <div class="circle">3</div>
            <span>Attribution</span>
        </div>
    </div>

    <!-- Formulaire d'ajout de compétence -->
    <form id="addSkillForm">
        <div class="form-group">
            <label for="mainName">Titre <span class="required">*</span></label>
            <input type='text' name='mainName' id='mainName' placeholder='Le titre' required autofocus/>
        </div>
        <div class="form-group">
            <label for="subName">Sous-titre <span class="required">*</span></label>
            <input type='text' name='subName' id='subName' placeholder='Sous-titre' required />
        </div>
        <div class="form-group">
            <label for="domain">Domaine <span class="required">*</span></label>
            <input type='text' name='domain' id='domain' placeholder='Le domaine' required />
        </div>
        <div class="form-group">
            <label for="level">Niveau <span class="required">*</span></label>
            <input type="range" name='level' id='level' min="0" max="8" step="1" value="8"/>
            <div id="levelValue">8</div>
        </div>
        <div class="form-group">
            <label for="file">Image <span class="required">*</span></label>
            <input type='file' name='file' id='file' required />
        </div>
        <div class="form-group">
            <label for="color">Couleur</label>
            <input type="color" name='color' id='color' value="#FF0000"/>
        </div>

        <button type="button" id="btnOK" class="btn-continue">OK</button>
    </form>

</div>

<script>
// Affichage dynamique de la valeur du slider
$(document).ready(function(){
    $("#level").on("input", function(){
        $("#levelValue").text($(this).val());
    });
});
</script>>
  </body>
</html>
