// login_system/js/profil_traitement.js

$(document).ready(function () {

  // Cargar datos del perfil
  $.ajax({
    url: "profil_traitement.php",
    method: "GET",
    dataType: "json",

    success: function (reponse) {
      $("#profil_prenom").val(reponse.prenom || "");
      $("#profil_nom").val(reponse.nom || "");
      $("#profil_email").val(reponse.email || "");
    },

    error: function (xhr, status, error) {
      console.error("Erreur Ajax profil (GET) :", status, error);
      $("#msg_profil")
        .css("color", "red")
        .html("Impossible de charger le profil.");
    }
  });

  // Guardar cambios
  $("#form_profil").on("submit", function (event) {
    event.preventDefault();

    $("#msg_profil").html("");

    const formData = $(this).serialize();

    $.ajax({
      url: "profil_modif_traitement.php",
      method: "POST",
      data: formData,
      dataType: "json",

      success: function (reponse) {
        if (reponse.success) {
          $("#msg_profil")
            .css("color", "green")
            .html(reponse.message || "Profil mis à jour.");
        } else {
          $("#msg_profil")
            .css("color", "red")
            .html(reponse.message || "Erreur lors de la mise à jour.");
        }
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax profil (POST) :", status, error);
        $("#msg_profil")
          .css("color", "red")
          .html("Erreur serveur.");
      }
    });

  });

});

