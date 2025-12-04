<?php
// === eclipses_solaires.php ===
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Éclipses Solaires – Phénomènes du Ciel</title>

    <!-- Chart.js -->
    <!-- Leaflet (obligatoire pour la carte) -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="eclipses_solaires.css">
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
        <h1>Éclipses Solaires</h1>
        <br><br>
        <p class="subtitle">
            Quand la Lune s’aligne parfaitement entre la Terre et le Soleil
        </p>
    </header>



    <!-- ============================= -->
    <!--         INTRODUCTION          -->
    <!-- ============================= -->
    <section class="section-block intro">

        <h2 class="section-heading"> Qu’est-ce qu’une éclipse solaire ?</h2>

        <p class="big-text">
            Une <strong>éclipse solaire</strong>, c’est lorsque la <strong>Lune passe devant le Soleil</strong>
            et projette son ombre sur la Terre.  
            Pendant quelques minutes, le jour devient crépuscule, le vent tombe,
            la température baisse… un phénomène rare et magique !
        </p>

        <p>
            Cela n’arrive que lorsque le Soleil, la Lune et la Terre
            sont parfaitement <strong>alignés</strong>.
        </p>



        <!-- ============================= -->
        <!--      Comment se forme une éclipse -->
        <!-- ============================= -->
        <h2 class="section-heading"> Comment se forme une éclipse solaire ?</h2>

<div class="steps-wrapper">

    <!-- Colonne Steps -->
    <div class="steps-column">
        <div class="steps">

            <div class="step">
                <div class="step-number">1</div>
                La Lune passe entre la Terre et le Soleil.
            </div>

            <div class="step">
                <div class="step-number">2</div>
                Elle projette une ombre sur la surface terrestre.
            </div>

            <div class="step">
                <div class="step-number">3</div>
                Dans la zone centrale : on observe une <strong>éclipse totale</strong>.
            </div>

            <div class="step">
                <div class="step-number">4</div>
                Autour : l’éclipse est <strong>partielle</strong>.
            </div>

            <div class="step">
                <div class="step-number">5</div>
                Lorsque l’alignement se rompt → la lumière revient progressivement.
            </div>

        </div>
    </div>

    <!-- Colonne IMAGE -->
    <div class="steps-image">
        <img src="images/schema_eclipses_solaires.jpg" class="schema" alt="Schéma éclipse solaire">
    </div>

</div>


        <!-- ============================= -->
        <!--      Types d’éclipses        -->
        <!-- ============================= -->
        <h2 class="section-heading"> Les types d'éclipses solaires</h2>

        <div class="eclipse-box-container">

    <div class="eclipse-box">
        <div class="icon">🌑</div>
        <div>
            <strong>Éclipse totale</strong>  
            Soleil totalement caché par la Lune.
        </div>
    </div>

    <div class="eclipse-box">
        <div class="icon">🌗</div>
        <div>
            <strong>Éclipse partielle</strong>  
            Une partie seulement du disque solaire est occultée.
        </div>
    </div>

    <div class="eclipse-box">
        <div class="icon">🌕</div>
        <div>
            <strong>Éclipse annulaire</strong>  
            Apparition d’un <em>anneau de feu</em> autour de la Lune.
        </div>
    </div>

</div>


        <!-- ============================= -->
        <!--           Où les voir ?       -->
        <!-- ============================= -->
        <h2 class="section-heading"> Où observe-t-on les éclipses ?</h2>

        <div class="eclipse-info-box">


    <p class="eclipse-box-text">
        La bande de totalité est très étroite : quelques dizaines de kilomètres seulement.
    </p>

    <ul class="eclipse-box-list">
        <li><strong> Traversées de continents</strong></li>
        <li><strong> Zones désertiques</strong> — ciel très clair et stable.</li>
        <li><strong>Îles isolées</strong> — peu de pollution lumineuse.</li>
        <li><strong>Montagnes</strong> — altitude favorable + horizon dégagé.</li>
    </ul>

    <p class="eclipse-box-footer">
        Une même ville peut ne vivre une éclipse totale que tous les 
        <strong>300 à 400 ans</strong> !
    </p>

</div>
    </section>

    <!-- ============================= -->
<!--     SEPARATOR TEXT BLOCK     -->
<!-- ============================= -->
<div class="transition premium-separator">
     Plongeons maintenant dans les données récoltées à travers le monde.
</div>



    <!-- ============================= -->
<!--     1. APERÇU DU DATASET      -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading">Données récentes des éclipses solaires</h2>

    <div class="card graph-wide">
        <p class="small">
            Voici un aperçu des éclipses solaires enregistrées récemment.  
            Ces données proviennent de catalogues astronomiques et d’observations internationales.
        </p>

        <div id="loading-solaire">Chargement…</div>

        <table id="table-solaire">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>central_duration</th>
                    <th>pays</th>
                    <th>ville</th>
                    <th>path_width_km</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="legend small" style="margin-top: 15px; opacity: 0.85;">

    <p><strong>Mois / Année</strong> → date à laquelle l’éclipse solaire a eu lieu ou a été observée.</p>

    <p><strong>Durée centrale</strong> → durée maximale de la phase d’occultation au centre de la bande d’éclipse 
    (là où l’éclipse est la plus intense).</p>

    <p><strong>Pays / Ville</strong> → lieu principal d’observation de l’éclipse.</p>

    <p><strong>Largeur de la bande (km)</strong> → largeur du « chemin d’ombre » projeté sur la Terre.
    Plus la bande est large, plus la zone où l’éclipse est visible est étendue.</p>

</div>

        <a href="data/eclipses_solaire.csv" download class="download-button" style="margin-top:20px;">
            Télécharger le dataset (CSV)
        </a>
    </div>
</section>




    <!-- ⭐ Transition vers les graphiques -->
    <div class="transition premium-separator">
         Les éclipses solaires révèlent la mécanique céleste de manière fascinante.
    </div>



<section class="section-block">
    <h2 class="section-heading glow-title">Répartition des types d’éclipses solaires</h2>

    <div class="card graph-wide graph-premium donut-wrapper">

        <div class="donut-container">

            <!-- Donut à gauche -->
            <div class="donut-left">
                <canvas id="donutEclipse"></canvas>
            </div>

            <!-- Texte explicatif -->
<div class="donut-text">
    <h3>Comprendre les codes</h3>

    <p>
        Les lettres autour du graphique représentent les <strong>types d’éclipses solaires</strong>.
        C’est le langage abrégé utilisé par les astronomes.
    </p>

    <p>
        • <strong>T</strong>, <strong>T+</strong>, <strong>T−</strong> → éclipses <strong>totales</strong>  <br>
        • <strong>A</strong>, <strong>A+</strong>, <strong>A−</strong>, <strong>Am</strong> → éclipses <strong>annulaires</strong>  <br>
        • <strong>H</strong>, <strong>H2</strong>, <strong>H3</strong> → éclipses <strong>hybrides</strong>  <br>
        • <strong>P</strong>, <strong>Pb</strong>, <strong>Pe</strong> → éclipses <strong>partielles</strong> <br>
    </p>

    <p>
        Les variantes (+, −, chiffres) indiquent simplement la 
        <strong>durée</strong> ou la <strong>forme</strong> de l’éclipse.
    </p>

    <p>
        Le graphique montre la répartition de tous ces types dans notre base d’observation.
    </p>
</div>


        </div>

    </div>
</section>




<!-- ===================================================== -->
<!-- 2. GRAPH : LARGEUR DE LA BANDE D’OMBRE                 -->
<!-- ===================================================== -->
<section class="section-block">
    <h2 class="section-heading glow-title"> Largeur de la bande d’ombre (km)</h2>

    <div class="card graph-wide graph-premium">

        <h3 class="graph-subtitle">Courbe brute & tendance lissée</h3>

        <div class="pathwidth-wrapper">
            <canvas id="pathWidthChart"></canvas>

            <div class="pathwidth-text">

    <h3> Comprendre ces largeurs</h3>

    <p>
        Chaque point représente la <strong>largeur de la bande d’ombre</strong>
        laissée par la Lune sur la Terre pendant une éclipse solaire.
        En gros : c’est la taille de la “zone d’éclipse”.
    </p>

    <p>
        🔸 Une <strong>grande largeur</strong> = une partie de la Terre plongée dans l’ombre sur
        plusieurs centaines de kilomètres. <br> 
        🔸 Une <strong>petite largeur</strong> = une éclipse visible seulement dans une zone très fine.
    </p>

    <p>
        🔸 La <strong>courbe bleue</strong> montre les valeurs <strong>brutes</strong> :
        elles montent et descendent tout le temps, car chaque éclipse dépend
        de beaucoup de facteurs (distance Terre–Lune, saison, inclinaison…).
    </p>

    <p>
        🔸 La <strong>courbe dorée</strong> est la version <strong>lissée</strong> :
        elle retire le “bruit” pour montrer la tendance générale.
    </p>

    <p>
        🔸 On voit que la plupart des éclipses tournent autour de
        <strong>150 à 300 km</strong>, <br> 
        🔸 mais certaines dépassent les <strong>600 km</strong> : ce sont les éclipses les plus spectaculaires.
    </p>

</div>
        </div>

    </div>
</section>



<!-- ===================================================== -->
<!-- 3. GRAPH : MAGNITUDE vs DURÉE                          -->
<!-- ===================================================== -->
<section class="section-block">
    <h2 class="section-heading glow-title">Relation magnitude / durée</h2>

    <div class="card graph-wide graph-premium">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Magnitude vs temps d’occultation</h3>

        <canvas id="scatterEclipseChart"></canvas>

        <p class="interpretation">

    🔸 La <strong>magnitude</strong> indique à quel point la Lune recouvre le Soleil
    pendant l’éclipse.

    <br><br>

    🔸 <strong>Magnitude < 1</strong> → la Lune ne cache qu’une partie du Soleil.  <br>
    🔸 <strong>Magnitude ≈ 1</strong> → elle recouvre pile le diamètre du Soleil.  <br>
    🔸 <strong>Magnitude > 1</strong> → la Lune dépasse un peu le disque solaire : 
    ce sont les éclipses les plus “profondes”.

</p>

<p class="interpretation">

    🔸 Pour les petites magnitudes, la durée varie beaucoup :  
    tout dépend de l’angle d’alignement entre la Terre, la Lune et le Soleil.

    <br><br>

    🔸 Autour de <strong>1.00</strong>, les éclipses sont étonnamment plus courtes :  
    la Lune ne fait que “frôler” le bord du Soleil.

    <br><br>

    🔸 Dès que la magnitude dépasse <strong>1.02</strong>, les durées augmentent :  
    la Lune plonge davantage dans le Soleil → l’occultation dure plus longtemps.

</p>

<p class="interpretation">

    🔸 En bref : la magnitude mesure la <strong>profondeur</strong> de l’éclipse,  
    mais la <strong>durée</strong> dépend surtout de la façon dont la Lune
    traverse le disque solaire.

</p>


    </div>
</section>





    <!-- ============================= -->
    <!--           FUN FACTS           -->
    <!-- ============================= -->
    <section class="section-block">
    <h2 class="section-heading glow-title"> Le savais-tu ?</h2>
    
    <div class="card graph-wide graph-premium">
        <?php include "funfacts.php"; ?>
    
    </div>
</section>




    <!-- ============================= -->
    <!--       POUR ALLER PLUS LOIN    -->
    <!-- ============================= -->
    <section class="section-block">
        <h2 class="section-heading"> Pour aller plus loin</h2>

        <p class="small" style="text-align:center; max-width:780px; margin:18px auto 0;">
    Les éclipses solaires ne sont qu’un des rares instants où le Soleil révèle
    ses secrets. Poursuis ton voyage et découvre d’autres phénomènes célestes
    qui transforment la façon dont nous observons la lumière et le cosmos.
        </p>


        <div class="more-container">

            <a href="../bolides/bolides.php" class="more-card">
                <img src="images/bolides.jpg">
                <div class="more-title">Bolides</div>
            </a>

            <a href="../meteorites/meteorites.php" class="more-card">
                <img src="images/meteorites.jpg">
                <div class="more-title">Météorites</div>
            </a>

            <a href="../eclipses_lunaires/eclipses_lunaires.php" class="more-card">
                <img src="images/eclipses_lunaires.jpg">
                <div class="more-title">Éclipses Lunaires</div>
            </a>

        </div>
    </section>

</div>




<!-- ============================= -->
<!--     SCRIPTS GRAPHIQUES        -->
<!-- ============================= -->
<script src="types.js"></script>
<script src="pathwidth.js"></script>
<script src="scatter.js"></script>
<script src="sample.js"></script>

<?php include 'includes/footer.php'; ?>

</body>
</html>