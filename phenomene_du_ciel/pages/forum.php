
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

  <h1>Forum</h1>
 
<?php
			require_once("../bd.php");
			$bdd = getBD();
			

			// des post
			$sql = "SELECT * FROM forum_messages";
			$stmt = $bdd->query($sql);
			$forum_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


		<?php if (!empty($forum_messages)): ?>
          <?php foreach ($forum_messages as $forum_message): ?>
  
          <p>
            <?= htmlspecialchars($forum_message['id_utilisateur']) ?>
            <?= htmlspecialchars($forum_message['message']) ?>
            <?= htmlspecialchars($forum_message['image']) ?>
            <?= htmlspecialchars($forum_message['date_publication']) ?>
          </p>


        <?php endforeach; ?>


    <?php else: ?>
        <p colspan="6" style="text-align:center;">Aucun produit trouvé.</p>
    <?php endif; ?>




  <?php include 'includes/footer.php'; ?>
</body>
</html>
