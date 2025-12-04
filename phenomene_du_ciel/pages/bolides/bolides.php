<?php
// === bolides.php ===
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Bolides – Phénomènes du Ciel</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-boxplot"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="bolides.css">
    <link rel="stylesheet" href="../../styles/css_banieres.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>



<!-- Fond étoiles -->
<div class="stars"></div>

<div class="container">

    <!-- ============================= -->
    <!--             TITRE             -->
    <!-- ============================= -->
    <header class="main-title">
        <h1>Bolides</h1>
        <br><br>
        <p class="subtitle">
            Les étoiles filantes les plus brillantes du ciel
        </p>
    </header>



    <!-- ============================= -->
    <!--         INTRODUCTION          -->
    <!-- ============================= -->
    <section class="section-block intro">

        <h2 class="section-heading"> Qu’est-ce qu’un bolide ?</h2>

        <p class="big-text">
            Un <strong>bolide</strong>, c’est une <strong>météore extrêmement brillante</strong>, 
            bien plus lumineuse qu’une étoile filante classique.  
            Il s’agit d’un fragment de roche spatiale entrant dans l’atmosphère à très grande vitesse  
            et pouvant <strong>exploser en un flash spectaculaire</strong>, visible sur des centaines de kilomètres !
        </p>

        <p>
            Un bolide ne touche pas toujours le sol : c’est avant tout le 
            <strong>phénomène lumineux</strong> lors de son explosion dans l’atmosphère.
        </p>



        <!-- ============================= -->
        <!--      Comment naît un bolide   -->
        <!-- ============================= -->
        <h2 class="section-heading"> Comment naît un bolide ?</h2>

        <div class="steps-wrapper">

            <div class="steps-column">
                <div class="steps">

                    <div class="step">
                        <div class="step-number">1</div>
                        Un petit fragment d’astéroïde ou de comète s’approche de la Terre.
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        Il entre dans l’atmosphère à 50 000 à 250 000 km/h.
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        Le frottement avec l’air le chauffe à plusieurs milliers de degrés.
                    </div>

                    <div class="step">
                        <div class="step-number">4</div>
                        Il devient plus brillant que Vénus, parfois visible en plein jour.
                    </div>

                    <div class="step">
                        <div class="step-number">5</div>
                        Il explose en altitude → <strong>airburst</strong>.
                    </div>

                </div>
            </div>

            <div class="steps-image">
                <img src="images/schema_bolides.jpg" class="schema" alt="Schéma bolide">
            </div>
        </div>



        <!-- ============================= -->
        <!--   Étoile filante ou bolide ? -->
        <!-- ============================= -->
        <h2 class="section-heading"> Étoile filante ou bolide ?</h2>

        <div class="compare-box">
            <div class="compare-col">
                <h3> Étoile filante</h3>
                <ul>
                    <li>Petite poussière</li>
                    <li>Lueur rapide et discrète</li>
                    <li>Dure ~0,5 seconde</li>
                    <li>Souvent invisible</li>
                </ul>
            </div>

            <div class="compare-col">
                <h3> Bolide</h3>
                <ul>
                    <li>Fragment plus gros</li>
                    <li>Explosion + lumière intense</li>
                    <li>Peut durer plusieurs secondes</li>
                    <li>Visible à des centaines de km</li>
                </ul>
            </div>
        </div>

        <p class="big-text">
     Un bolide, c’est une <strong>super étoile filante</strong>, beaucoup plus énergétique et spectaculaire !
</p>

 <!-- FIN DE INTRO -->



<!-- ============================= -->
<!--   Les types de bolides       -->
<!-- ============================= -->
<div class="bolide-row">

    <div class="bolide-info">
        <div class="bolide-icon">✨</div>
        <div>
            <strong>Bolides classiques</strong><br>
            Lumière vive observée dans le ciel.
        </div>
    </div>

    <div class="bolide-info">
        <div class="bolide-icon">🌟</div>
        <div>
            <strong>Superbolides</strong><br>
            Extrêmement lumineux, visibles à grande distance.
        </div>
    </div>

    <div class="bolide-info">
        <div class="bolide-icon">💥</div>
        <div>
            <strong>Bolides explosifs</strong><br>
            Explosion dans l’atmosphère (airburst).
        </div>
    </div>

    <div class="bolide-info">
        <div class="bolide-icon">🧩</div>
        <div>
            <strong>Bolides fragmentés</strong><br>
            Plusieurs morceaux visibles dans la descente.
        </div>
    </div>

</div>

<br>



        <!-- ============================= -->
        <!--           Où les voir ?       -->
        <!-- ============================= -->
        <h2 class="section-heading">Où observe-t-on des bolides ?</h2>

<div class="nice-box">

    <p>
        Les bolides peuvent apparaître <strong>partout sur Terre</strong>,  
        mais certains environnements sont particulièrement favorables :
    </p>

    <ul class="nice-list">
        <li><span class="arrow">→</span> <strong>Déserts</strong> — ciel clair, aucune pollution lumineuse.</li>
        <li><span class="arrow">→</span> <strong>Régions polaires</strong> — atmosphère très stable.</li>
        <li><span class="arrow">→</span> <strong>Zones rurales</strong> — loin des lumières des villes.</li>
        <li><span class="arrow">→</span> <strong>Observatoires en altitude</strong> — visibilité optimale.</li>
    </ul>

    <p>
        Des bolides apparaissent <strong>chaque jour</strong>,  
        mais la majorité passe inaperçue.
    </p>

</div>

    </section>



<!-- ============================= -->
<!--     1. APERÇU DU DATASET      -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading">Données récentes de bolides</h2>

    <div class="card graph-wide">
        <p class="small">
            Voici quelques bolides enregistrés ces dernières années.  
            Ces données proviennent d’observations satellitaires et de stations automatiques.
        </p>

        <div id="loading-bolides">Chargement…</div>

        <table id="table-bolides">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>ville </th>
                    <th>pays</th>
                    <th>Vitesse (km/s)</th>
                    <th>Énergie (J)</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="legend-box small">

    <p><strong>Date</strong> → mois et année d’observation du bolide.</p>

    <p><strong>Latitude / Longitude</strong> → position estimée du phénomène dans l’atmosphère terrestre.</p>

    <p><strong>Vitesse (km/s)</strong> → vitesse d’entrée du fragment.</p>

    <p><strong>Énergie (J)</strong> → énergie lumineuse libérée lors de l’explosion (si disponible).</p>

</div>

        <a href="data/bolides.csv" download class="download-button">
            Télécharger le dataset (CSV)
        </a>
    </div>

    <!-- ⭐ Transition -->
    <div class="transition premium-separator">
         Les bolides ne sont pas seulement beaux… leurs données révèlent leurs secrets physiques.
    </div>
</section>



<!-- ============================= -->
<!--     2. GRAPH : VITESSE        -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading">Vitesse des bolides</h2>

    <div class="card graph-wide">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Distribution des vitesses (km/s)</h3>

        <canvas id="vitesseChart"></canvas>

        <p class="mini-legend">
    Ce boxplot montre la <strong>répartition complète des vitesses</strong> des bolides
    enregistrés dans notre base.
</p>

<p class="interpretation">

    🔸 La majorité des vitesses se situent entre <strong>14 et 20 km/s</strong> :
    c’est la zone où se trouvent la plupart des bolides.

    <br><br>

    🔸 La <strong>médiane</strong> est autour de <strong>17 km/s</strong> :
    une vitesse typique pour un bolide entrant dans l’atmosphère.

    <br><br>

    🔸 Les valeurs extrêmes vont jusqu’à <strong>30 km/s</strong> :
    ce sont les bolides les plus rapides et les plus énergétiques.

    <br><br>

    🔸 En résumé : la plupart des bolides ont une vitesse “classique” autour de
    <strong>15–20 km/s</strong>, mais certains atteignent des vitesses beaucoup plus élevées.
</p>
    </div>
</section>



<!-- ============================= -->
<!--     3. GRAPH : ÉNERGIE        -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading"> Énergie totale rayonnée</h2>

    <div class="card graph-wide">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Énergie des bolides (Joules)</h3>

        <canvas id="energieChart"></canvas>

        <p class="mini-legend">
    Cet histogramme utilise des classes en <strong>échelle logarithmique</strong> 
    pour visualiser les énergies rayonnées par les bolides — idéales lorsque 
    les valeurs vont de <strong>10⁹ à plus de 10¹¹ Joules</strong>.
</p>

<p class="interpretation">

    🔸 La majorité des bolides libèrent entre 
    <strong>10 et 100 milliards de Joules</strong> :
    c’est l’énergie de plusieurs milliers de tonnes d’explosifs.

    <br><br>

    🔸 Le pic entre <strong>30 et 100 × 10⁹ J</strong> montre la classe 
    la plus représentée dans notre base.

    <br><br>

    🔸 Quelques bolides dépassent les <strong>100 milliards de Joules</strong> :
    ce sont les événements les plus puissants et les plus rares.

    <br><br>

    🔸 En résumé : la plupart des bolides dégagent une énergie déjà énorme,
    mais certains atteignent des niveaux vraiment exceptionnels.
</p>
    </div>
</section>



<!-- ============================= -->
<!-- 4. GRAPH : SCATTER 2D         -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading"> Relation vitesse / énergie</h2>

    <div class="card graph-wide">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Corrélation entre la vitesse et l’énergie</h3>

        <canvas id="scatterChart"></canvas>

        <p class="mini-legend">
    Chaque point représente un bolide : sa <strong>vitesse</strong> (axe horizontal) 
    et l’<strong>énergie libérée</strong> lors de l’explosion (axe vertical).
</p>

<p class="interpretation">

    🔸 Le nuage de points est très dispersé :  
    deux bolides allant à la même vitesse peuvent libérer des énergies totalement différentes.

    <br><br>

    🔸 Certains bolides rapides restent <strong>peu énergétiques</strong>,  
    tandis que d’autres, plus lents, produisent des explosions <strong>très puissantes</strong>.

    <br><br>

    🔸 Cela montre un point essentiel :  
    <strong>la vitesse ne suffit pas</strong> à prédire l’énergie d’un impact.  
    La <strong>masse</strong> du bolide joue un rôle majeur dans la violence de l’explosion.

    <br><br>

    🔸 En résumé : un bolide lent mais massif peut être bien plus destructeur
    qu’un bolide rapide mais léger.
</p>

    </div>
</section>



<!-- ============================= -->
<!--           FUN FACTS           -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading">Le savais-tu ?</h2>
<div class="card graph-wide">
    <?php include "funfacts.php"; ?>
</div>
</section>




<!-- ============================= -->
<!--       POUR ALLER PLUS LOIN    -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading"> Pour aller plus loin</h2>

    <p class="small" style="text-align:center; max-width:780px; margin:18px auto 0;">
        Les bolides ne sont qu’un des nombreux spectacles lumineux du ciel.  
        Continue ton exploration pour découvrir d’autres phénomènes fascinants.
    </p>

    <div class="more-container">

        <a href="../meteorites/meteorites.php" class="more-card">
            <img src="images/meteorites.jpg">
            <div class="more-title">Météorites</div>
        </a>

        <a href="../eclipses_solaires/eclipses_solaires.php" class="more-card">
            <img src="images/eclipses_solaires.jpg">
            <div class="more-title">Éclipses Solaires</div>
        </a>

        <a href="../eclipses_lunaires/eclipses_lunaires.php" class="more-card">
            <img src="images/eclipses_lunaires.jpg">
            <div class="more-title">Éclipses Lunaires</div>
        </a>

    </div>
</section>




<!-- ============================= -->
<!--     SCRIPTS GRAPHIQUES        -->
<!-- ============================= -->
<script src="sample.js"></script>
<script src="vitesse.js"></script>
<script src="energie.js"></script>
<script src="scatter.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
