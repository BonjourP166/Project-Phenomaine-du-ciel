
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="../styles/css_Principale.css">
  <link rel="stylesheet" href="../styles/css_Banieres.css">
</head>
<body>

  <?php include 'includes/header.php'; ?>

  <h1>Recommandation</h1>
  <p>voici different lieu pouvant satisfaire votre Curiositer</p>
  

 
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
  
          <p>
            <?= htmlspecialchars($lieux_observations['nom']) ?>
            <?= htmlspecialchars($lieux_observations['decription']) ?>
            <?= htmlspecialchars($lieux_observations['url']) ?>
            <?= htmlspecialchars($lieux_observations['pays']) ?>
          </p>


        <?php endforeach; ?>


    <?php else: ?>
        <p colspan="6" style="text-align:center;">Aucun produit trouvé.</p>
    <?php endif; ?>




  <?php include 'includes/footer.php'; ?>
</body>
</html>
