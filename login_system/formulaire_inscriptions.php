<?php
session_start();
require_once '../securite/csrf.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="../styles/css_principale.css">
  <link rel="stylesheet" href="../styles/css_banieres.css">
  <link rel="stylesheet" href="../styles/css_Formulaire.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="i_c">

<h1>Création de compte :</h1>
<p><a href="formulaire_connextions.php">Déjà un compte ? Se connecter</a></p>

<form id="form_inscription" method="POST" enctype="multipart/form-data">

    <div class="input-block">
        <label>Prénom <span class="req">*</span></label>
        <input type="text" name="prenom" id="prenom">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Nom <span class="req">*</span></label>
        <input type="text" name="nom" id="nom">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Email <span class="req">*</span></label>
        <input type="email" name="email" id="email">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Ville <span class="req">*</span></label>
        <input type="text" name="ville" id="ville">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Mot de passe <span class="req">*</span></label>
        <input type="password" name="mot_de_passe" id="mot_de_passe">
        <small class="error"></small>
    </div>

    <!-- 🔽 CHAMPS FACULTATIFS SANS ASTÉRISQUE 🔽 -->

    <div class="input-block">
        <label>Date de naissance</label>
        <input type="date" name="date_naissance" id="date_naissance">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Bio</label>
        <textarea name="bio" id="bio" rows="4"></textarea>
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Photo de profil</label>
        <input type="file" name="image_profil" id="image_profil" accept="image/*">
        <small class="error"></small>
    </div>

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <button type="submit">S'inscrire</button>

    <div id="msg_inscription_general"></div>

</form>


<!-- Réponse AJAX -->
<div id="msg_inscription"></div>

</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="inscription_traitement.js"></script>

</body>
</html>
