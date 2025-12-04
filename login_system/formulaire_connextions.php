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
  
     <h1>Connexion:</h1>


<form id="form_connexion" method="POST">

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="input-block">
        <label>Email</label>
        <input type="email" name="email" id="email_connexion">
        <small class="error"></small>
    </div>

    <div class="input-block">
        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" id="mdp_connexion">
        <small class="error"></small>
    </div>

    <button type="submit">Se connecter</button>

    <div id="msg_connexion_general"></div>
</form>

    <p><a href="formulaire_inscriptions.php">Vous n’avez pas de compte ? Inscrivez-vous !</a></p>
</div>

  <?php include 'includes/footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="connexion_traitement.js"></script>
</body>

</html>
