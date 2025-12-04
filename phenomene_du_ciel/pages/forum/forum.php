<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../../bd.php";
$bdd = getBD();

$sql = "SELECT m.*, u.prenom, u.nom, u.image_profil,
        (SELECT COUNT(*) 
         FROM forum_messages 
         WHERE parent_id = m.id) AS nb_reponses
        FROM forum_messages m
        JOIN utilisateurs u ON m.id_utilisateur = u.id
        WHERE m.parent_id IS NULL OR m.parent_id = 0
        ORDER BY date_publication DESC";

$stmt = $bdd->query($sql);
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Forum - Phénomènes du Ciel</title>
<link rel="stylesheet" href="forum.css">
<link rel="stylesheet" href="../../styles/css_banieres.css">
</head>
<body>
<?php include "includes/header.php"; ?>
<div class="page-container">
    <div class="section-title">
        <h1>Forum</h1>
        <p>Echangez autour des phénomènes du ciel</p>
    </div>


<div class="forum-container">
<?php foreach($topics as $t): ?>
    <div class="forum-card">
        <div class="forum-header">
            <img class="avatar" src="../<?= $t['image_profil'] ?: 'uploads/default.png' ?>">
            <strong><?= htmlspecialchars(($t['prenom'] ?? '') . ' ' . ($t['nom'] ?? '')) ?></strong>
            <span class="date"><?= $t['date_publication'] ?></span>
        </div>

        <h3><?= htmlspecialchars($t['theme'] ?? 'Sujet sans titre') ?></h3>

        <p><?= nl2br(htmlspecialchars($t['message'])) ?></p>

        <?php if (!empty($t['image'])): ?>
    <img class="forum-img" src="../<?= $t['image'] ?>">

<?php endif; ?>

        <div class="forum-footer">
    <span class="reply-count">
        💬 <?= $t['nb_reponses'] ?> réponse<?= ($t['nb_reponses'] > 1 ? 's' : '') ?>
    </span>

    <a class="btn-blue" href="topic.php?id=<?= $t['id'] ?>">
        Voir la discussion ➜
    </a>
</div>
    </div>
<?php endforeach; ?>
</div>
</div>
<div class="quick-post-box">
    <h3> Nouveau message</h3>

    <?php if (isset($_SESSION['utilisateur'])): ?>
        
        <form action="poster.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="titre" placeholder="Titre du sujet..." required>
            <textarea name="message" placeholder="Votre message..." required></textarea>
            <input type="file" name="image" accept="image/*">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit" class="btn-gold-small">Publier ➜</button>
        </form>

    <?php else: ?>

        <p style="color:#ffdd8a; text-align:center;">
            Vous devez être connecté pour publier un message.
        </p>
        <a href="../../login_system/formulaire_connextions.php" class="btn-blue" style="width:100%; text-align:center;">
    🔑 Se connecter
</a>


    <?php endif; ?>

</div>


<br>

<?php include "includes/footer.php"; ?>
</body>
</html>
