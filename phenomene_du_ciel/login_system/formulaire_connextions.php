<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="../styles/css_Principale.css">
  <link rel="stylesheet" href="../styles/css_Banieres.css">
  <link rel="stylesheet" href="../styles/css_Formulaire.css">
</head>
<body>

  <?php include 'includes/header.php'; ?>

     <h1 class="titre">Connexion</h1>
 
<form id="formConnexion" method="POST" action="connexion_traitement.php">

    <!-- Token CSRF obligatoire -->
    <input type="hidden" name="csrf_token" value="test">

    <p>Email :
        <input type="email" name="email" value="<?php echo $_GET['email'] ?? ''; ?>">
    </p>

    <p>Mot de passe :
        <input type="password" name="mot_de_passe">
    </p>

    <p>
        <input type="submit" value="Se connecter">
    </p>
</form>

    <p><a href="formulaire_inscriptions.php">Vous n’avez pas de compte ? Inscrivez-vous !</a></p>


  <?php include 'includes/footer.php'; ?>
</body>
</html>