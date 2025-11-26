
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="../styles/css_principale.css">
  <link rel="stylesheet" href="../styles/css_conteneur.css">
  <link rel="stylesheet" href="../styles/css_banieres.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
</head>
<body>

  <?php include 'includes/header.php'; ?>

  <h1 class='jaune '> Recommandation: </h1>
  <h3 class='jaune '> voici different lieu pouvant satisfaire votre Curiositer</h3>
  

 
<?php
			require_once("../bd.php");
			$bdd = getBD();
			

			// des post
			$sql = "SELECT * FROM lieux_observation ";
			$stmt = $bdd->query($sql);
			$lieux_observation = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


		<?php if (!empty($lieux_observation)): ?>
          <?php foreach ($lieux_observation as $lieux_observations): ?>


<div class='conteneur'>
    <?php if (!empty($lieux_observations['image'])): ?>
        <img src="../images/images_forum/<?= htmlspecialchars($lieux_observations['image']) ?>" alt="pas d'image">
    <?php endif; ?>

    <div class="texte-conteneur">
        <p><a href="<?= htmlspecialchars($lieux_observations['url']) ?>"><?= htmlspecialchars($lieux_observations['nom']) ?></a></p>
        <p>Description: <?= htmlspecialchars($lieux_observations['description']) ?></p> 
        <p>Pays: <?= htmlspecialchars($lieux_observations['pays']) ?></p>
    </div>
</div>

        <?php endforeach; ?>


    <?php else: ?>
        <p colspan="6" style="text-align:center;">Aucun produit trouvé.</p>
    <?php endif; ?>




  <?php include 'includes/footer.php'; ?>
</body>
</html>
