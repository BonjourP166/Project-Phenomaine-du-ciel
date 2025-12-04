$(document).ready(function () {

    /* ============================================================
       🚀 VALIDATION LIVE DES CHAMPS
       ============================================================ */

    // --- Vérification prénom ---
    $("#prenom").on("input", function() {
        let val = $(this).val().trim();
        if (val.length < 2) {
            setInvalid($(this), "Le prénom doit contenir au moins 2 caractères.");
        } else {
            setValid($(this));
        }
    });

    // --- Vérification nom ---
    $("#nom").on("input", function() {
        let val = $(this).val().trim();
        if (val.length < 2) {
            setInvalid($(this), "Le nom doit contenir au moins 2 caractères.");
        } else {
            setValid($(this));
        }
    });

    // --- Vérification email ---
    $("#email").on("input", function() {
        let email = $(this).val().trim();
        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(email)) {
            setInvalid($(this), "Email invalide.");
        } else {
            // Vérifie si email déjà utilisé (AJAX live)
            checkEmailExist(email, $(this));
        }
    });

    // --- Vérification ville ---
    $("#ville").on("input", function() {
        if ($(this).val().trim() === "") {
            setInvalid($(this), "La ville est obligatoire.");
        } else {
            setValid($(this));
        }
    });

    // --- Vérification mot de passe ---
    $("#mot_de_passe").on("input", function() {
        let mdp = $(this).val();
        if (mdp.length < 6) {
            setInvalid($(this), "6 caractères minimum.");
        } else {
            setValid($(this));
        }
    });

    // --- Vérification BIO (optionnel) ---
    $("#bio").on("input", function() {
        let val = $(this).val();
        if (val.length > 300) {
            setInvalid($(this), "La bio doit faire maximum 300 caractères.");
        } else {
            setValid($(this)); // même vide = OK
        }
    });

    // --- Vérification DATE DE NAISSANCE (optionnel) ---
    $("#date_naissance").on("change", function() {
        let val = $(this).val();
        if (!val) {
            setValid($(this)); // vide = ok
            return;
        }

        let date = new Date(val);
        let min = new Date("1900-01-01");
        let now = new Date();

        if (date > now) {
            setInvalid($(this), "La date doit être dans le passé.");
        } else if (date < min) {
            setInvalid($(this), "Date trop ancienne.");
        } else {
            setValid($(this));
        }
    });

    // --- Vérification PHOTO (optionnel) ---
    $("#image_profil").on("change", function() {
        let file = this.files[0];
        if (!file) {
            setValid($(this)); 
            return;
        }

        let allowed = ["image/jpeg", "image/png", "image/webp"];
        if (!allowed.includes(file.type)) {
            setInvalid($(this), "Image JPG, PNG ou WEBP uniquement.");
            return;
        }

        if (file.size > 3 * 1024 * 1024) {
            setInvalid($(this), "Image < 3 Mo.");
            return;
        }

        setValid($(this));
    });

    /* ============================================================
       🧩 FONCTIONS UTILES
       ============================================================ */

    function setValid(input) {
        input.removeClass("invalid").addClass("valid");
        input.next(".error").html("");
    }

    function setInvalid(input, message) {
        input.removeClass("valid").addClass("invalid");
        input.next(".error").html(message);
    }

    // Vérifie email déjà utilisé en direct
    function checkEmailExist(email, inputField) {
        $.post("verif_email.php", { email: email }, function (data) {
            if (data.exists) {
                setInvalid(inputField, "Cet email est déjà utilisé.");
            } else {
                setValid(inputField);
            }
        }, "json");
    }

    /* ============================================================
       ✉️ ENVOI AJAX + REDIRECTION INDEX
       ============================================================ */

    $("#form_inscription").on("submit", function (event) {
        event.preventDefault();

        $(".error").html("");
        $("#msg_inscription_general").html("");

        const formData = new FormData(this);

        $.ajax({
            url: "inscription_traitement.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function (response) {

                // --- Erreurs formulaire ---
                if (response.status === "error") {

                    for (const champ in response.errors) {
                        $("#" + champ).next(".error").html(response.errors[champ]);
                        $("#" + champ).addClass("invalid");
                    }

                    $("#msg_inscription_general")
                        .css("color", "red")
                        .html("Veuillez corriger les erreurs en rouge.");
                    return;
                }

                // --- Succès ---
                if (response.status === "success") {

                    $("#msg_inscription_general")
                        .css("color", "lime")
                        .html("Inscription réussie ! Bienvenue " + response.prenom + " " + response.nom);

                    // Message temporaire pour index.php
                    sessionStorage.setItem("welcome_message",
                        "Bienvenue " + response.prenom + " " + response.nom + " 👋");

                    // Redirection vers index.php après 1,5s
                    setTimeout(function () {
                        window.location.href = "../index.php";
                    }, 1500);
                }
            },

            error: function () {
                $("#msg_inscription_general").css("color", "red").html("Erreur serveur.");
            }
        });

    });

});
