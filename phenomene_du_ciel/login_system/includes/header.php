

<header class="site-header">
  <div class="logo">
    <img src="../images/logo.jpg" alt="Logo" class="cercle1"> 
    <a href="../index.php" class="a_h2">Univers en direct</a>
  </div>

  <nav class="header">
    <!-- Menu déroulant Phénomène -->
    <div class="dropdown">
      <a href="javascript:void(0);" class="dropbtn">Phénomène ▼</a>
      <div class="dropdown-content">
        <a href="../pages/phenomene.php?type=1" class="no-underline">Météorites</a>
        <a href="../pages/phenomene.php?type=2" class="no-underline">Bolide</a>
        <a href="../pages/phenomene.php?type=3" class="no-underline">Éclipses Solaires</a>
        <a href="../pages/phenomene.php?type=4" class="no-underline">Éclipses Lunaires</a>
      </div>
    </div>

    <a href="../pages/phenomene.php">Phenomene</a>
    <a href="../pages/carte.php">Carte</a>
    <a href="../pages/frise.php">Frise</a>
    <a href="../pages/forum.php">Forum</a>
    <a href="../pages/curiosite.php">Curiosite</a>
    <a href="../pages/quizz.php">Quizz</a>
    <a href="../login_system/formulaire_connextions.php">connextion</a>
     <a href="../pages/profile.php">
      <img src="../images/profile.png" alt="Profil" class="cercle3">
    </a>
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