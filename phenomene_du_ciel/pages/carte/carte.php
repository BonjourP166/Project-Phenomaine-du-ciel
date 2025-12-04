<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte interactive des phénomènes du ciel</title>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="carte.css">
    <link rel="stylesheet" href="../../styles/css_banieres.css">
</head>

<body>

<?php include 'includes/header.php'; ?>

<header class="header-banner">
    <h1>Carte interactive des phénomènes du ciel</h1>
    <p class="subtitle">Explore les pays selon l’activité, la rareté des phénomènes et leur diversité.</p>
</header>

<div class="filters-wrapper">

    <div class="filter-panel">
        <label for="phenomenon-filter">Phénomène :</label>
        <select id="phenomenon-filter">
            <option value="all">Tous</option>
            <option value="bolides">Bolides</option>
            <option value="meteorites">Météorites</option>
            <option value="solaire">Éclipses solaires</option>
            <option value="lunaire">Éclipses lunaires</option>
        </select>
    </div>

    <div class="filter-panel">
        <label for="activity-filter">Activité :</label>
        <select id="activity-filter">
            <option value="all">Toutes</option>
            <option value="low">Faible</option>
            <option value="medium">Modérée</option>
            <option value="high">Élevée</option>
            <option value="very_high">Très élevée</option>
        </select>
    </div>

    <div class="filter-panel">
        <label for="rarity-filter">Rareté :</label>
        <select id="rarity-filter">
            <option value="all">Toutes</option>
            <option value="rare">Avec phénomènes rares</option>
            <option value="no_rare">Sans phénomènes rares</option>
        </select>
    </div>

    <div class="filter-panel">
        <label for="multi-filter">Diversité :</label>
        <select id="multi-filter">
            <option value="all">Toutes</option>
            <option value="multi">Multi-phénomènes</option>
            <option value="mono">Mono-phénomène</option>
        </select>
    </div>

    <div class="filter-panel">
        <label for="period-filter">Période :</label>
        <select id="period-filter">
            <option value="all">Toutes périodes</option>
            <option value="recent">Récents</option>
            <option value="historic">Historiques</option>
        </select>
    </div>

    <div class="reset-filters-container">
    <button id="reset-filters" class="reset-btn">
        Réinitialiser les filtres 
    </button>
</div>


</div>

<div id="map"></div>

<script src="carte.js"></script>

<?php include 'includes/footer.php'; ?>

</body>
</html>
