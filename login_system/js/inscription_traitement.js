// login_system/js/inscription_traitement.js

$(document).ready(function () {

  $("#form_inscription").on("submit", function (event) {
    event.preventDefault();

    $("#msg_inscription").html("");

    const formData = new FormData(this);  // por si hay subida de imágenes

    $.ajax({
      url: "inscription_traitement.php",
      method: "POST",
      data: formData,
      processData: false,   // obligatorio con FormData
      contentType: false,   // idem
      dataType: "html",     // el PHP devuelve HTML

      success: function (html) {
        // mostramos directamente el HTML que devuelve el PHP
        $("#msg_inscription").html(html);
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax inscription :", status, error);
        $("#msg_inscription")
          .css("color", "red")
          .html("Erreur serveur pendant l'inscription.");
      }
    });

  });

});

