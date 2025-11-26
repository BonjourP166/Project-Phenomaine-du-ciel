
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="../styles/css_box.css">
  <link rel="stylesheet" href="../styles/css_principale.css">
  <link rel="stylesheet" href="../styles/css_conteneur.css">
  <link rel="stylesheet" href="../styles/css_banieres.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
</head>
<body>

  <?php include 'includes/header.php'; ?>

  <h1 class='jaune '>Forum :</h1>
 
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

      <div class='conteneur'>
          <?php if (!empty($forum_message['image'])): ?>
              <img src="../images/images_forum/<?= htmlspecialchars($forum_message['image']) ?>" alt="pas d'image"
            <?php endif; ?>>
      
          <div class="texte-conteneur">
            <p><?= htmlspecialchars($forum_message['id_utilisateur']) ?></p>
            <p><?= htmlspecialchars($forum_message['message']) ?></p>
            <p><?= htmlspecialchars($forum_message['date_publication']) ?></p>
      </div>
       </div>

        <?php endforeach; ?>


    <?php else: ?>
        <p colspan="6" style="text-align:center;">Aucun produit trouvé.</p>
    <?php endif; ?>



<div id="fixed-box-bottom"></div>
<link rel="stylesheet" href="styles/css_box.css">
<script>
  // Charger le contenu de la box via AJAX
  fetch("box.php")
      .then(res => res.text())
      .then(html => {
          document.getElementById("fixed-box-bottom").innerHTML = html;
      });
</script>



  <?php include 'includes/footer.php'; ?>
</body>
</html>
