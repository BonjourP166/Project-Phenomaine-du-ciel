// login_system/js/deconnexion.js

$(document).ready(function () {

  $("#btn_deconnexion").click(function (event) {
    event.preventDefault();

    $.ajax({
      url: "deconnexion.php",
      method: "GET",
      dataType: "json",

      success: function (reponse) {
        if (reponse.success && reponse.redirect) {
          window.location.href = reponse.redirect;
        } else {
          window.location.reload();
        }
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax déconnexion :", status, error);
        alert("Erreur lors de la déconnexion.");
      }
    });
  });

});

