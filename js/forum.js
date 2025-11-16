// js/forum.js

$(document).ready(function () {

  function chargerMessages() {
    $.ajax({
      url: "forum.php",
      method: "GET",
      data: { ajax: 1, action: "list" },
      dataType: "html",

      success: function (html) {
        $("#forum_messages").html(html);
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax forum list :", status, error);
        $("#forum_messages").html("<p>Erreur lors du chargement des messages.</p>");
      }
    });
  }

  // cargar al entrar
  chargerMessages();

  $("#form_forum").on("submit", function (event) {
    event.preventDefault();

    $("#message_forum").html("");

    const formData = $(this).serialize();

    $.ajax({
      url: "forum.php",
      method: "POST",
      data: formData + "&ajax=1&action=add",
      dataType: "json",

      success: function (reponse) {
        if (reponse.success) {
          $("#message_forum")
            .css("color", "green")
            .html(reponse.message || "Message publié.");
          $("#form_forum")[0].reset();
          chargerMessages();
        } else {
          $("#message_forum")
            .css("color", "red")
            .html(reponse.message || "Erreur lors de la publication.");
        }
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax forum add :", status, error);
        $("#message_forum")
          .css("color", "red")
          .html("Erreur serveur.");
      }
    });

  });

});

