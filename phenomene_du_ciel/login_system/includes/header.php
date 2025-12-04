<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===========================
   DÉTERMINATION DE L’IMAGE 
   =========================== */

$img = '../uploads/default.png'; // image par défaut

if (!empty($_SESSION['utilisateur']['image_profil'])) {

    $imageCandidate = $_SESSION['utilisateur']['image_profil'];

    // Vérification robuste : chemin non vide et fichier existant
    if (!empty($imageCandidate) && file_exists($imageCandidate)) {
        $img = $imageCandidate;
    }
}
?>

<header class="site-header">

  <!-- LOGO -->
  <div class="logo">
    <img src="../images/logo.jpg" alt="Logo" class="cercle1"> 
    <a href="../index.php" class="a_h2">Phénomènes du ciel</a>
  </div>

  <!-- NAVIGATION -->
  <nav class="header">

    <!-- MENU DÉROULANT PHÉNOMÈNES -->
    <div class="dropdown">
      <a href="javascript:void(0);" class="dropbtn">Phénomènes ▼</a>

      <div class="dropdown-content">
        <a href="../pages/meteorites/meteorites.php" class="no-underline">Météorites</a>
        <a href="../pages/bolides/bolides.php" class="no-underline">Bolides</a>
        <a href="../pages/eclipses_solaires/eclipses_solaires.php" class="no-underline">Éclipses Solaires</a>
        <a href="../pages/eclipses_lunaires/eclipses_lunaires.php" class="no-underline">Éclipses Lunaires</a>
      </div>
    </div>

    <a href="../pages/carte/carte.php">Carte</a>
    <a href="../pages/frise/frise.php">Frise</a>
    <a href="../pages/forum.php">Forum</a>
    <a href="../pages/curiosite.php">Curiosité</a>
    <a href="../pages/quizz.php">Quiz</a>

    <!-- SI UTILISATEUR NON CONNECTÉ -->
    <?php if (!isset($_SESSION['utilisateur'])): ?>

        <a href="../login_system/formulaire_connextions.php">Connexion</a>

    <!-- SI CONNECTÉ -> IMAGE PROFIL -->
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