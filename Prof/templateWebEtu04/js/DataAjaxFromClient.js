$(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/

  // On page load
  sendAjax("DataAjaxFromClient.php", {});

  // Every 60s
  window.setInterval(sendAjax, 60000, "dataAjaxFromClient.php", {});

  // On click OK button
  jQuery("body").on("click", "#btnOK", function() {

    var firstName = jQuery("input[name='firstName']").val();
    var lastName  = jQuery("input[name='lastName']").val();

    sendAjax("dataAjaxFromClient.php", {
      firstname: firstName,
      lastname: lastName
    });
  });

/*==============================================================================
  Receive ajax
==============================================================================*/

  function receiveAjax(data) {

    if (data['success']) {
      var idUser = data["idUser"];
      jQuery("body").html("ID utilisateur reçu : " + idUser);
    } else {
      redirect("logout.php");
    }
  }

});
