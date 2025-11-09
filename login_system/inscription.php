<?php
// === CHARGEMENT DE LA SÉCURITÉ ===
require_once '../securite/session_secure.php'; // crée le token CSRF + démarre la session
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription - Phénomènes du Ciel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8faf9;
      padding: 30px;
    }
    form {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      max-width: 400px;
      margin: auto;
    }
    input, button, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      background-color: #3c948b;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #337a73;
    }
  </style>
</head>
<body>

  <h2 style="text-align:center;">Créer un compte</h2>

  <form action="inscription_traitement.php" method="post" enctype="multipart/form-data">
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <input type="text" name="ville" placeholder="Ville" required>
    <input type="date" name="date_naissance" placeholder="Date de naissance">
    <textarea name="bio" placeholder="Quelques mots sur vous..."></textarea>
    <input type="file" name="image_profil" accept="image/*">

    <!-- 🔒 TOKEN CSRF -->
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    <button type="submit">S’inscrire</button>
  </form>

</body>
</html>
