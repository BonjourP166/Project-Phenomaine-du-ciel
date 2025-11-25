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

    <h1 class="titre">Création de compte</h1>
    <p><a href="formulaire_connextions.php">Déjà un compte ? Se connecter</a></p>


    <form id="formCompte">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <p>Nom : <input type="text" name="n" value="<?php echo $_GET['n'] ?? ''; ?>"><br>
            <span class="error-message"></span>
        </p>
        <p>Prénom : <input type="text" name="p" value="<?php echo $_GET['p'] ?? ''; ?>"><br>
            <span class="error-message"></span>
        </p>
        <p>Adresse : <input type="text" name="adr" value="<?php echo $_GET['adr'] ?? ''; ?>"><br>
            <span class="error-message"></span>
        </p>
        <p>Numéro : <input type="text" name="num" value="<?php echo $_GET['num'] ?? ''; ?>"><br>
            <span class="error-message"></span>
        </p>
        <p>Email : <input type="email" name="mail" value="<?php echo $_GET['mail'] ?? ''; ?>"><br>
            <span class="error-message"></span>
        </p>
        <p>Mot de passe : <input type="password" name="mdp1"><br>
            <span class="error-message"></span>
        </p>
        <p>Confirmation : <input type="password" name="mdp2"><br>
            <span class="error-message"></span>
        </p>

        <p><input type="submit" value="S'inscrire" id="submitBtn"></p>
    </form>


  <?php include 'includes/footer.php'; ?>
</body>
</html>