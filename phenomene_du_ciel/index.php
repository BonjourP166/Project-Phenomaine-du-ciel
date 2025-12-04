<?php
require_once 'securite/session_secure.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="styles/css_page_acceuil.css">
  <link rel="stylesheet" href="styles/css_banieres.css">
  <link rel="icon" type="image/jpg" href="images/logo.jpg">
</head>
<body>
  <?php 
  session_start();

  include 'includes/header.php';
  require_once 'securite/session_secure.php'; ?>

  <main class="hero">
    <h1>Phénomène du Ciel</h1>
    <p>Découvrez les phénomènes célestes : météorites, bolides, éclipses solaires et lunaires.</p>
  

  <div class="images-droite">
    <a href="pages/meteorites/meteorites.php"><img src="images/meteorites.jpg"></a>
    <a href="pages/bolides/bolides.php"><img src="images/bolides.jpg"></a>
    <a href="pages/eclipses_solaires/eclipses_solaires.php"><img src="images/eclipses_solaires.jpg"></a>
    <a href="pages/eclipses_lunaires/eclipses_lunaires.php"><img src="images/eclipses_lunaires.jpg"></a>
  </div>


    <h2>Grâce à nous, vous pouvez observer et comprendre 
les phénomènes offerts par le ciel.</h2>
    
  </main>

  

  <?php include 'includes/footer.php'; ?>
</body>
</html>