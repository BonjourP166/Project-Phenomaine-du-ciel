// login_system/js/connexion_traitement.js

$(document).ready(function () {

  $("#form_connexion").on("submit", function (event) {
    event.preventDefault(); // no recarga la página

    $("#msg_connexion").html("");

    const formData = $(this).serialize();

    $.ajax({
      url: "connexion_traitement.php",  // mismo directorio que le formulaire
      method: "POST",
      data: formData,
      dataType: "json",

      success: function (reponse) {

        if (reponse.success) {
          $("#msg_connexion")
            .css("color", "green")
            .html(reponse.message || "Connexion réussie.");

          // si más tarde añadís redirect en el PHP:
          if (reponse.redirect) {
            window.location.href = reponse.redirect;
          }
        } else {
          $("#msg_connexion")
            .css("color", "red")
            .html(reponse.message || "Erreur de connexion.");
        }
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax connexion :", status, error);
        $("#msg_connexion")
          .css("color", "red")
          .html("Erreur serveur, veuillez réessayer plus tard.");
      }
    });
  });

});

