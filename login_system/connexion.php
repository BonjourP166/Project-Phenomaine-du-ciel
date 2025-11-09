<?php
session_start();
require_once '../includes/bd.php';

// Génération d’un token CSRF unique si non existant
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Ma Santé d’Abord</title>
  <link rel="stylesheet" href="../styles/style.css">

  <style>
    body {
      background-color: #d9f0e0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .container {
      max-width: 400px;
      margin: 60px auto;
      padding: 25px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    button {
      background-color: #5ca26e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background-color: #4a8a5b;
    }
    .alert-success {
      background: #d4f6e2;
      padding: 10px;
      border-radius: 8px;
      margin-top: 10px;
    }
    .alert-error {
      background: #ffd6d6;
      padding: 10px;
      border-radius: 8px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>🔐 Connexion</h2>

    <form id="formConnexion" method="POST" action="connexion_traitement.php">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

      <label for="email">Adresse e-mail :</label>
      <input type="email" name="email" id="email" placeholder="ex: stacy@example.com" required>

      <label for="mot_de_passe">Mot de passe :</label>
      <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="••••••••" required>

      <button type="submit">Se connecter</button>
    </form>

    <div id="message"></div>

    <p style="margin-top:15px;">Pas encore de compte ? 
      <a href="inscription.php">Créer un compte</a>
    </p>
  </div>



</body>
</html>
