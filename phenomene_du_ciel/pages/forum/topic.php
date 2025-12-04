<?php
session_start();

// Debug (désactiver plus tard)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../bd.php";
require_once "../../securite/csrf.php";

$bdd = getBD();

// Vérifier ID sujet
if (!isset($_GET['id'])) die("Aucun sujet sélectionné");
$topic_id = intval($_GET['id']);

// Sujet principal
$sql = "SELECT m.*, u.prenom, u.nom, u.image_profil
        FROM forum_messages m
        JOIN utilisateurs u ON u.id = m.id_utilisateur
        WHERE m.id = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$topic_id]);
$topic = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$topic) die("Sujet introuvable");

// Fonction récursive affichage des sous-réponses
function displayReplies($parentId, $bdd) {
    $sql = "SELECT m.*, u.prenom, u.nom, u.image_profil
            FROM forum_messages m
            JOIN utilisateurs u ON u.id = m.id_utilisateur
            WHERE parent_id = ?
            ORDER BY date_publication ASC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$parentId]);
    $children = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($children as $rep) {
        echo '<div class="children-container">';
        echo '<div class="reponse-card">';
        echo '<img class="avatar" src="../'.$rep['image_profil'].'">';
        echo '<strong>'.htmlspecialchars($rep['prenom']." ".$rep['nom']).'</strong><br>';
        echo nl2br(htmlspecialchars($rep['message']));
        echo '<div class="date">'.$rep['date_publication'].'</div>';
        echo '<a href="#" class="small-reply-btn" data-repid="'.$rep['id'].'">Répondre</a>';
        echo '</div>';

        displayReplies($rep['id'], $bdd);

        echo '</div>';
    }
}

// Réponses directes au sujet
$sql = "SELECT m.*, u.prenom, u.nom, u.image_profil
        FROM forum_messages m
        JOIN utilisateurs u ON u.id = m.id_utilisateur
        WHERE parent_id = ?
        ORDER BY date_publication DESC";
$stmt = $bdd->prepare($sql);
$stmt->execute([$topic_id]);
$directReplies = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($topic['titre'] ?? "(Sans titre)") ?></title>

<link rel="stylesheet" href="forum.css">
<link rel="stylesheet" href="../../styles/css_banieres.css">

<style>
.children-container {
    margin-left: 35px;
    border-left: 2px solid rgba(255,185,80,0.35);
    padding-left: 12px;
    margin-top: 10px;
}
.appearing { animation: fadeIn .3s ease-in-out; }
@keyframes fadeIn { from{opacity:0;transform:translateY(4px)} to{opacity:1;transform:translateY(0)} }
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<div class="page-container">

    <a href="forum.php" class="btn-blue">⬅ Retour au forum</a>

    <!-- ⭐ Sujet -->
    <div class="forum-card">
        <div class="forum-header">
            <img class="avatar" src="../<?= $topic['image_profil'] ?>" alt="">
            <strong><?= htmlspecialchars($topic['prenom'].' '.$topic['nom']) ?></strong>
            <span class="date"><?= $topic['date_publication'] ?></span>
        </div>

        <h2 class="jaune"><?= htmlspecialchars($topic['titre'] ?? "Sujet sans titre") ?></h2>
        <p><?= nl2br(htmlspecialchars($topic['message'] ?? "(Sans contenu)")) ?></p>

        <?php if (!empty($topic['image'])): ?>
            <img class="forum-img" src="../<?= $topic['image'] ?>">
        <?php endif; ?>

        <!-- 🔹 Répondre au sujet -->
        <a href="#" class="small-reply-btn" data-repid="<?= $topic_id ?>">Répondre au sujet</a>
        <div class="children-container" id="children-<?= $topic_id ?>"></div>
        <div class="reply-form-container" id="reply-form-<?= $topic_id ?>"></div>
    </div>


    <h3 style="margin-top:25px;">💬 Réponses</h3>

    <?php foreach($directReplies as $rep): ?>
        <div class="reponse-card appearing">
            <img class="avatar" src="../<?= $rep['image_profil'] ?>">
            <strong><?= htmlspecialchars($rep['prenom']." ".$rep['nom']) ?> :</strong><br>
            <?= nl2br(htmlspecialchars($rep['message'])) ?>
            <div class="date"><?= $rep['date_publication'] ?></div>
            <a href="#" class="small-reply-btn" data-repid="<?= $rep['id'] ?>">Répondre</a>

            <?php displayReplies($rep['id'], $bdd); ?>

            <div class="reply-form-container" id="reply-form-<?= $rep['id'] ?>"></div>
        </div>
    <?php endforeach; ?>

</div>


<!-- JS réponse inline -->
<script>
document.addEventListener("click", function(e){
    if (!e.target.classList.contains("small-reply-btn")) return;
    e.preventDefault();
    
    const repId = e.target.dataset.repid;
    const container = document.getElementById("reply-form-" + repId);

    if (container.innerHTML.trim() !== "") {
        container.innerHTML = "";
        return;
    }

    container.innerHTML = `
        <div class="reply-form-box">
            <form method="POST">
                <textarea name="message" required></textarea>
                <input type="hidden" name="id_parent" value="${repId}">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <button type="submit" class="btn-blue">Envoyer</button>
            </form>
        </div>
    `;
});

// Envoi AJAX
document.addEventListener("submit", async function(e){
    if (!e.target.closest(".reply-form-box")) return;
    e.preventDefault();

    const form = e.target;
    const data = new FormData(form);
    const parentId = data.get("id_parent");
    const response = await fetch("repondre.php", { method:"POST", body:data });
    const result = await response.json();

    if(result.success) {
        location.reload(); // 🌟 REFRESH auto pour afficher bien ordonné !
    }
});
</script>

</body>
</html>
