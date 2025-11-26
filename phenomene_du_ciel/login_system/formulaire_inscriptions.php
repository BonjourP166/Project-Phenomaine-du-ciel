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
    
<h1 >Création de compte:</h1>
<p><a href="formulaire_connextions.php">Déjà un compte ? Se connecter</a></p>


<form id="formCompte" method="POST" action="inscription_traitement.php" enctype="multipart/form-data">

    <!-- CSRF -->
    <input type="hidden" name="csrf_token" value="test">

    <p>Prénom : 
        <input type="text" name="prenom" value="<?php echo $_GET['prenom'] ?? ''; ?>">
        <span class="error-message"></span>
    </p>

    <p>Nom : 
        <input type="text" name="nom" value="<?php echo $_GET['nom'] ?? ''; ?>">
        <span class="error-message"></span>
    </p>

    <p>Email : 
        <input type="email" name="email" value="<?php echo $_GET['email'] ?? ''; ?>">
        <span class="error-message"></span>
    </p>

    <p>Ville : 
        <input type="text" name="ville" value="<?php echo $_GET['ville'] ?? ''; ?>">
        <span class="error-message"></span>
    </p>

    <p>Date de Naissance : 
        <input type="date" name="date_naissance" value="<?php echo $_GET['date_naissance'] ?? ''; ?>">
        <span class="error-message"></span>
    </p>

    <p>Bio :
        <textarea name="bio"><?php echo $_GET['bio'] ?? ''; ?></textarea>
        <span class="error-message"></span>
    </p>

    <p>Mot de passe :
        <input type="password" name="mot_de_passe">
        <span class="error-message"></span>
    </p>

    <p>Image de profil :
        <input type="file" name="image_profil" accept="image/*">
    </p>

    <p><input type="submit" value="S'inscrire" id="submitBtn"></p>
</form>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>