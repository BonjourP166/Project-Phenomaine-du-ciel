// js/contacte.js

$(document).ready(function () {

  $("#form_contacte").on("submit", function (event) {
    event.preventDefault();

    $("#message_contacte").html("");

    const formData = $(this).serialize();

    $.ajax({
      url: "contacte.php",
      method: "POST",
      data: formData + "&ajax=1",
      dataType: "html",

      success: function (html) {
        $("#message_contacte").html(html);
        $("#form_contacte")[0].reset();
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax contacte :", status, error);
        $("#message_contacte")
          .css("color", "red")
          .html("Erreur serveur.");
      }
    });

  });

});

