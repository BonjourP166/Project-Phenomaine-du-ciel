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
 

    <form id="formConnexion">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <p>pseudonyme/Email: <input type="email" name="mail" value="<?php echo $_GET['mail'] ?? ''; ?>"><br></p>
        <p>Mot de passe : <input type="password" name="mdp"><br></p>
        <p><input type="submit" value="Se connecter"></p>
    </form>

    <p><a href="formulaire_inscriptions.php">Vous n’avez pas de compte ? Inscrivez-vous !</a></p>


  <?php include 'includes/footer.php'; ?>
</body>
</html>