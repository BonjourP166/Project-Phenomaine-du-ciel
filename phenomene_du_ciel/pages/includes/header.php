<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===========================
   IMAGE DE PROFIL – DEUX NIVEAUX (../../)
   =========================== */

$defaultImg = "../uploads/default.png";
$img = $defaultImg;

if (!empty($_SESSION['utilisateur']['image_profil'])) {

    $candidate = $_SESSION['utilisateur']['image_profil'];  // ex: ../uploads/photo.jpg

    // 🔥 Enlève les "../" inutiles
    if (strpos($candidate, "../") === 0) {
        $candidate = substr($candidate, 3);
    }

    // 🔥 Chemin absolu serveur
    $absolute = $_SERVER['DOCUMENT_ROOT'] . "/phenomene_du_ciel/" . $candidate;

    if (file_exists($absolute)) {
        // 🔥 Bon chemin pour un fichier à 2 niveaux
        $img = "../" . $candidate;
    }
}
?>


<header class="site-header">

  <div class="logo">
    <img src="../images/logo.jpg" alt="Logo" class="cercle1"> 
    <a href="../index.php" class="a_h2">Phénomènes du ciel</a>
  </div>

  <nav class="header">

    <!-- Menu déroulant Phénomènes -->
    <div class="dropdown">
      <a href="javascript:void(0);" class="dropbtn">Phénomènes ▼</a>
      <div class="dropdown-content">
        <a href="meteorites/meteorites.php" class="no-underline">Météorites</a>
        <a href="bolides/bolides.php" class="no-underline">Bolides</a>
        <a href="eclipses_solaires/eclipses_solaires.php" class="no-underline">Éclipses Solaires</a>
        <a href="eclipses_lunaires/eclipses_lunaires.php" class="no-underline">Éclipses Lunaires</a>
      </div>
    </div>

    <a href="carte/carte.php">Carte</a>
    <a href="frise/frise.php">Frise</a>
    <a href="forum/forum.php">Forum</a>
    <a href="curiosite.php">Curiosite</a>
    <a href="quizz.php">Quiz</a>

    <!-- 🔥 Connexion / Profil dynamique -->
    <?php if (!isset($_SESSION['utilisateur'])): ?>
        <a href="../login_system/formulaire_connextions.php">Connexion</a>
    <?php else: ?>
        <a href="../login_system/profil.php">
            <img src="<?= $img ?>" alt="Profil" class="cercle3">
        </a>
    <?php endif; ?>

  </nav>

</header>



<script>
const dropbtn = document.querySelector('.dropbtn');
const dropdownMenu = document.querySelector('.dropdown-content');

// Ouvrir/fermer le menu au clic
dropbtn.addEventListener('click', (e) => {
  e.stopPropagation(); // empêche de déclencher le clic sur window
  dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
});

// Fermer si on clique en dehors
window.addEventListener('click', () => {
  dropdownMenu.style.display = 'none';
});
</script>