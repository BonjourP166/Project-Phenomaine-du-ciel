<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===========================
   IMAGE DE PROFIL – INDEX.PHP
   =========================== */

$defaultImg = "../uploads/default.png";
$img = $defaultImg;

if (!empty($_SESSION['utilisateur']['image_profil'])) {

    $candidate = $_SESSION['utilisateur']['image_profil'];

    // 🔥 Corrige automatiquement le mauvais "../"
    if (strpos($candidate, "../") === 0) {
        $candidate = substr($candidate, 3);  // enlève "../"
    }

    // 🔥 Construction du chemin ABSOLU pour file_exists()
    $absolute = $_SERVER['DOCUMENT_ROOT'] . "/phenomene_du_ciel/" . $candidate;

    if (file_exists($absolute)) {
        $img = $candidate;
    }
}
?>

<header class="site-header">

  <!-- LOGO / TITRE -->
  <div class="logo">
    <img src="images/logo.jpg" alt="Logo" class="cercle1"> 
    <a href="index.php" class="a_h2">Phénomènes du ciel</a>
  </div>

  <!-- NAVIGATION -->
  <nav class="header">

    <!-- MENU DÉROULANT PHÉNOMÈNES -->
    <div class="dropdown">
      <a href="javascript:void(0);" class="dropbtn">Phénomènes ▼</a>

      <div class="dropdown-content">
        <a href="pages/meteorites/meteorites.php">Météorites</a>
        <a href="pages/bolides/bolides.php">Bolides</a>
        <a href="pages/eclipses_solaires/eclipses_solaires.php">Éclipses Solaires</a>
        <a href="pages/eclipses_lunaires/eclipses_lunaires.php">Éclipses Lunaires</a>
      </div>
    </div>

    <a href="pages/carte/carte.php">Carte</a>
    <a href="pages/frise/frise.php">Frise</a>
    <a href="pages/forum/forum.php">Forum</a>
    <a href="pages/curiosite.php">Curiosité</a>
    <a href="pages/quizz.php">Quiz</a>

    <?php if (!isset($_SESSION['utilisateur'])): ?>

        <a href="login_system/formulaire_connextions.php">Connexion</a>

    <?php else: ?>

        <a href="login_system/profil.php">
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