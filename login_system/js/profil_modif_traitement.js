// login_system/js/profil_modif_traitement.js

$(document).ready(function () {

  // Al enviar el formulario de modificación del perfil
  $("#form_profil_modif").on("submit", function (event) {
    event.preventDefault(); // evitamos recargar

    $("#msg_profil_modif").html("");

    const formData = $(this).serialize();

    $.ajax({
      url: "profil_modif_traitement.php",
      method: "POST",
      data: formData,
      dataType: "json",

      success: function (reponse) {

        // EJEMPLOS de retorno desde el PHP:
        // { "success": true, "message": "Profil mis à jour !" }
        // { "success": false, "message": "Erreur: email déjà utilisé." }

        if (reponse.success) {

          $("#msg_profil_modif")
            .css("color", "green")
            .html(reponse.message || "Profil mis à jour.");

          // Si el PHP devuelve una redirección:
          if (reponse.redirect) {
            window.location.href = reponse.redirect;
          }

        } else {

          $("#msg_profil_modif")
            .css("color", "red")
            .html(reponse.message || "Erreur lors de la mise à jour.");

        }

      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax profil_modif :", status, error);

        $("#msg_profil_modif")
          .css("color", "red")
          .html("Erreur serveur.");
      }

    });

  });

});

