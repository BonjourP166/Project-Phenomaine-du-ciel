$(document).ready(function () {

    $("#form_connexion").on("submit", function (event) {
        event.preventDefault();

        $("#msg_connexion_general").html("");

        const formData = new FormData(this);

        $.ajax({
            url: "connexion_traitement.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function (response) {

                if (!response.success) {
                    $("#msg_connexion_general")
                        .css("color", "red")
                        .html(response.message);
                    return;
                }

                $("#msg_connexion_general")
                    .css("color", "lime")
                    .html(response.message);

                sessionStorage.setItem(
                    "welcome_message",
                    response.message
                );

                setTimeout(function () {
                    window.location.href = "../index.php";
                }, 1200);
            },

            error: function () {
                $("#msg_connexion_general")
                    .css("color", "red")
                    .html("Erreur serveur.");
            }
        });

    });

});
