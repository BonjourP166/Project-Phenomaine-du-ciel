// js/curiosite.js

$(document).ready(function () {

  $("#btn_random_curiosite").click(function () {

    $.ajax({
      url: "curiosite.php",
      method: "GET",
      data: { ajax: 1, action: "random" },
      dataType: "html",

      success: function (html) {
        $("#zone_curiosite").html(html);
      },

      error: function (xhr, status, error) {
        console.error("Erreur Ajax curiosite :", status, error);
      }
    });

  });

});

