<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profil - Test Back & Front</title>
  <link rel="stylesheet" href="styles/style.css">

  <style>
    body {
      background-color: #d9f0e0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .container {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 25px;
      text-align: center;
    }
    img {
      border-radius: 50%;
      border: 2px solid #5ca26e;
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin-bottom: 10px;
    }
    input, textarea {
      width: 90%;
      padding: 10px;
      margin-top: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    button {
      background: #5ca26e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 15px;
    }
    button:hover {
      background: #4a8a5b;
    }
    .message {
      margin-top: 15px;
      padding: 10px;
      border-radius: 8px;
    }
    .success { background: #d4f6e2; color: #0a682e; }
    .error { background: #ffd6d6; color: #a33; }
  </style>
</head>
<body>
  <div class="container">
    <h2>👤 Mon Profil</h2>
    <img id="photo" src="" alt="Image de profil">
    <p><strong>Nom :</strong> <span id="nom"></span></p>
    <p><strong>Email :</strong> <span id="email"></span></p>

    <hr>

    <h3>Modifier mon profil</h3>
    <form id="formProfil" enctype="multipart/form-data">
      <label for="ville">Ville :</label><br>
      <input type="text" id="ville" name="ville"><br>

      <label for="bio">Bio :</label><br>
      <textarea id="bio" name="bio" rows="4"></textarea><br>

      <label for="image_profil">Nouvelle photo :</label><br>
      <input type="file" id="image_profil" name="image_profil"><br>

      <button type="submit">💾 Enregistrer</button>
    </form>

    <div id="message" class="message"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
  // === 1️⃣ Charger les données depuis le back ===
  $(document).ready(function() {
    $.ajax({
      url: "profil_traitement.php", // ton back
      type: "GET",
      dataType: "json",
      success: function(r) {
        if (r.success) {
          const p = r.profil;
          $("#nom").text(p.prenom + " " + p.nom);
          $("#email").text(p.email);
          $("#ville").val(p.ville || "");
          $("#bio").val(p.bio || "");
          $("#photo").attr("src", p.image_profil || "uploads/default.png");
        } else {
          $("#message").addClass("error").text(r.message);
        }
      },
      error: function() {
        $("#message").addClass("error").text("⚠️ Erreur serveur lors du chargement du profil.");
      }
    });
  });

  // === 2️⃣ Envoi des modifications au back ===
  $("#formProfil").on("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    $.ajax({
      url: "profil_modif_traitement.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(r) {
        $("#message").removeClass("error success");
        if (r.success) {
          $("#message").addClass("success").text(r.message);
          if (r.profil.image_profil) {
            $("#photo").attr("src", r.profil.image_profil);
          }
        } else {
          $("#message").addClass("error").text(r.message);
        }
      },
      error: function() {
        $("#message").addClass("error").text("❌ Erreur lors de la mise à jour du profil.");
      }
    });
  });
  </script>
</body>
</html>
