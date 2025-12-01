<?php session_start();  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Univers en Direct</title>
  <link rel="stylesheet" href="styles/css_frise.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/css_banieres.css?v=<?php echo time(); ?>">

</head>
<?php include 'header.php'; ?>

<body>
<h1>Voyage à travers le temps : les grands événements astronomiques</h1>

<p>
    Depuis des siècles, les phénomènes célestes fascinent les observateurs du ciel.
    Des chutes de météorites spectaculaires aux éclipses rares, chaque événement a marqué notre histoire
    et enrichi nos connaissances sur l'univers. Cette frise chronologique retrace les grandes dates 
    marquantes liées aux météorites, bolides, éclipses solaires et lunaires.
</p>
<p>
    Cliquez sur les points lumineux pour en savoir plus sur chaque phénomène.
</p>


<div class="popup-tabs">
    <button class="tab-btn active" data-type="all">Tous</button>
    <button class="tab-btn" data-type="meteorite">Meteorites</button>
    <button class="tab-btn" data-type="bolide">Bolides</button>
    <button class="tab-btn" data-type="solaire">Eclipses Solaires</button>
    <button class="tab-btn" data-type="lunaire">Eclipses Lunaires</button>
</div>

<?php include 'frisebase.php'; ?>

<div id="timelinePopup" class="popup" style="display:none;">
    <span class="closePopup">&times;</span>
    <h3 id="popupDate"></h3>

    <div class="tab-content">
        <table id="meteoriteTable" class="tab-table">
            <thead><tr><th>Nom</th><th>Masse (g)</th></tr></thead>
            <tbody></tbody>
        </table>

        <table id="bolideTable" class="tab-table" style="display:none;">
            <thead><tr><th>Vitesse (km/s)</th><th>Energie (J)</th></tr></thead>
            <tbody></tbody>
        </table>

        <table id="solaireTable" class="tab-table" style="display:none;">
            <thead><tr><th>Type</th><th>Durée (min)</th></tr></thead>
            <tbody></tbody>
        </table>

        <table id="lunaireTable" class="tab-table" style="display:none;">
            <thead><tr><th>Type</th><th>Durée (s)</th></tr></thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<p>
    Cette frise illustre à quel point les phénomènes astronomiques rythment notre histoire. 
    Chaque observation, chaque chute, chaque éclipse est une fenêtre ouverte sur l'univers.
    Continuez votre exploration en découvrant les pages dédiées à chaque phénomène !
</p>

<?php include 'footer.php'; ?>

<script src="frise.js?v=<?php echo time(); ?>"></script>

</body>
</html>
