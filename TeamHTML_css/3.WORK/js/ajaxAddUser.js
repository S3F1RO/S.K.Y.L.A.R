$(document).ready(function(){
  //==============================================================================

  /*==============================================================================
  Send ajax to server
  ==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", ".btn-continue", function() {
    var firstName = jQuery("input[name='firstName']").val();
    var lastName = jQuery("input[name='lastName']").val();
    var nickname = jQuery("input[name='nickname']").val();
    var passphrase = jQuery("input[name='password']").val();

    
    sendAjax("ajaxAddUser.php", {
      'firstName': firstName,
      'lastName': lastName,
      'nickname': nickname,
      'passphrase': passphrase
    });
  });

  jQuery("body").on("keyup", "input[name='nickname']", function(key) {
    if (key.which == 13) {
      var firstName = jQuery("input[name='firstName']").val();
      var lastName = jQuery("input[name='lastName']").val();
      var nickname = jQuery("input[name='nickname']").val();
      var passphrase = jQuery("input[name='password']").val();
      
      sendAjax("ajaxAddUser.php", {
        'firstName': firstName,
        'lastName': lastName,
        'nickname': nickname,
        'passphrase': passphrase
      });
    }
  });

  /*==============================================================================
  Receive ajax
  ==============================================================================*/
  function redirect(serverUrl) {
    window.location.href = serverUrl;
  }

  function receiveAjax(data) {
    if (data['success']) {
      var idUser = data["idUser"];
      jQuery("body").html("ID utilisateur reçu : " + idUser);
    } else {
      var html = data["html"];
      jQuery("span").html(html);
    }
  };



  // --- Send AJAX data to server
  function sendAjax(serverUrl, data) {
    jsonData = JSON.stringify(data);
    jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + jsonData,
      success: function(data) {
        //receiveAjax(data);

        if (data.success) {
          // Redirige vers étape 2 avec idUser en GET
          window.location.href = "addSkill.php?idUser=" + data.idUser;
        } else {
          alert(data.html || "Erreur inconnue !");
        }
      },
      error: function(xhr, status, error) {
        console.error("AJAX Error:", error);
        alert("Erreur serveur !");
      }
    });
  }
});