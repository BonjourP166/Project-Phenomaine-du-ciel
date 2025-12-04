<?php
// === eclipses_lunaires.php ===
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Éclipses Lunaires – Phénomènes du Ciel</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="eclipses_lunaires.css">
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
        <h1>Éclipses Lunaires</h1>
        <br><br>
        <p class="subtitle">
            Quand la Terre projette son ombre sur la Lune
        </p>
    </header>




    <!-- ============================= -->
    <!--         INTRODUCTION          -->
    <!-- ============================= -->
    <section class="section-block intro">

        <h2 class="section-heading"> Qu’est-ce qu’une éclipse lunaire ?</h2>

        <p class="big-text">
            Une <strong>éclipse lunaire</strong>, c’est lorsque la <strong>Lune passe dans l’ombre de la Terre</strong>.  
            La Lune peut alors devenir <strong>orange ou rouge</strong> : c’est la fameuse
            <strong>“Lune de sang”</strong>.
        </p>

        <p>
            À la différence des éclipses solaires, les éclipses lunaires sont visibles
            depuis <strong>toute la moitié de la Terre plongée dans la nuit</strong>.
        </p>



        <!-- ============================= -->
        <!--      Comment naît l’éclipse  -->
        <!-- ============================= -->
        <h2 class="section-heading">Comment se forme une éclipse lunaire ?</h2>

<div class="steps-wrapper">

    <!-- Colonne Steps -->
    <div class="steps-column">
        <div class="steps">

            <div class="step">
                <div class="step-number">1</div>
                La Terre passe entre le Soleil et la Lune.
            </div>

            <div class="step">
                <div class="step-number">2</div>
                L’ombre de la Terre se projette sur la Lune.
            </div>

            <div class="step">
                <div class="step-number">3</div>
                Lorsque la Lune entre totalement dans l’ombre :  
                éclipse total.
            </div>

            <div class="step">
                <div class="step-number">4</div>
                La lumière rouge filtrée par l’atmosphère terrestre  
                colore la Lune → Lune de sang.
            </div>

            <div class="step">
                <div class="step-number">5</div>
                Puis la Lune ressort progressivement de l’ombre.
            </div>

        </div>
    </div>

    <!-- Colonne IMAGE -->
    <div class="steps-image">
        <img src="images/schema_eclipses_lunaires.jpg" class="schema" alt="Schéma éclipse lunaire">
    </div>

</div>




        <!-- ============================= -->
        <!--      Types d’éclipses        -->
        <!-- ============================= -->
        <h2 class="section-heading">Les types d'éclipses lunaires</h2>

<div class="eclipse-lunar-box-container">

    <div class="eclipse-lunar-box">
        <div class="icon">🌘</div>
        <div>
            <strong>Éclipse pénombrale</strong><br>
            Assombrissement léger, parfois à peine perceptible.
        </div>
    </div>

    <div class="eclipse-lunar-box">
        <div class="icon">🌗</div>
        <div>
            <strong>Éclipse partielle</strong><br>
            Une partie de la Lune passe dans l’ombre de la Terre.
        </div>
    </div>

    <div class="eclipse-lunar-box">
        <div class="icon">🌑</div>
        <div>
            <strong>Éclipse totale</strong><br>
            La Lune entière devient rouge cuivrée.
        </div>
    </div>

</div>

<p class="big-text" style="margin-top: 30px;">
    Les éclipses lunaires sont beaucoup plus <strong>fréquentes et visibles</strong> 
    que les éclipses solaires !
</p>


    </section>



    <!-- ============================= -->
<!--     1. APERÇU DU DATASET      -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading"> Données récentes des éclipses lunaires</h2>

    <div class="card graph-wide graph-premium">
        <p class="small">
            Voici un aperçu des éclipses lunaires observées ces dernières années.  
            Ces données proviennent de catalogues astronomiques internationaux
            (NASA, IMCCE, USNO…).
        </p>

        <div id="loading-lunaire">Chargement…</div>

        <table id="table-lunaire">
            <thead>
                <tr>
                    <th>Mois / Année</th>
                    <th>Type</th>
                    <th>pays</th>
                    <th>ville</th>
                    <th>Durée totale (min)</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="legend small" style="margin-top: 15px; opacity: 0.85;">
    <p><strong>Mois / Année</strong> → période durant laquelle l’éclipse lunaire a été observée.</p>
    
    <p><strong>Type</strong> → 
        <em>t</em> : totale · 
        <em>p</em> : partielle · 
        <em>h</em> : pénombrale.
    </p>

    <p><strong>Pays / Ville</strong> → lieu principal depuis lequel l’éclipse a été mesurée ou photographiée.</p>

    <p><strong>Durée totale (min)</strong> → durée complète de la phase totalement éclipsée,
        c’est-à-dire lorsque la Lune se trouve entièrement dans l’ombre de la Terre.
    </p>
</div>

        <a href="lunaire.csv" download class="download-button" style="margin-top:20px;">
            Télécharger le dataset (CSV)
        </a>
    </div>
</section>



   <!-- ===================================================== -->
<!-- 1. GRAPH : DURÉE MOYENNE DES PHASES D’ÉCLIPSE LUNAIRE  -->
<!-- ===================================================== -->
<section class="section-block">
    <h2 class="section-heading glow-title"> Durée moyenne des différentes phases d’éclipse lunaire</h2>

    <div class="card graph-wide graph-premium">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Pénombre · Partielle · Totale</h3>

        <canvas id="lunarDurationChart"></canvas>

        <p class="mini-legend">
    Ce graphique compare les <strong>durées moyennes</strong> des trois grandes étapes d’une
    éclipse lunaire : la <strong>pénombre</strong>, la <strong>phase partielle</strong> et 
    la <strong>phase totale</strong>.
</p>

<p class="interpretation">
    🔸 <strong>Pénombre (~260 min)</strong>  
    C’est la phase la plus longue : la Lune entre doucement dans l’ombre de la Terre.  
    Elle dure en moyenne plus de <strong>4 heures</strong> : un vrai marathon lunaire !

    <br><br>

    🔸 <strong>Phase partielle (~100 min)</strong>  
    La Lune commence à être “croquée” par l’ombre terrestre.  
    Cette étape est deux fois plus courte, avec environ <strong>1h40</strong> d’obscurcissement.

    <br><br>

    🔸 <strong>Phase totale (~20 min)</strong>  
    Le moment magique : la Lune devient rouge sombre.  
    C’est aussi la phase la plus brève — une petite <strong>vingtaine de minutes</strong> —  
    mais c’est elle qui vole la vedette !
</p>

    </div>
</section>


<!-- ===================================================== -->
<!-- 2. GRAPH : SCATTER – TYPE vs DURÉE                     -->
<!-- ===================================================== -->
<section class="section-block">
    <h2 class="section-heading glow-title"> Durée totale selon le type d’éclipse</h2>

    <div class="card graph-wide graph-premium">

        <div class="graph-grid"></div>
        <div class="scan-line"></div>

        <h3 class="graph-subtitle">Comparaison des durées selon le type d’éclipse</h3>

        <canvas id="scatterLuneChart"></canvas>

        <p class="mini-legend">
    Chaque point représente une <strong>éclipse lunaire réelle</strong>.  
    Plus il est haut, plus l’éclipse a duré longtemps.  
    La couleur indique son <strong>type</strong> : pénombrale (jaune), partielle (violet) ou totale (rouge).
</p>

<p class="interpretation">
    🔸 <strong>Éclipses pénombrales</strong>  
    Elles sont nombreuses mais courtes : la plupart durent entre <strong>40 et 90 minutes</strong>.  
    Elles éclaircissent à peine la Lune — c’est la version “soft” de l’éclipse.

    <br><br>

    🔸 <strong>Éclipses partielles</strong>  
    Beaucoup plus dispersées : certaines sont brèves, d’autres dépassent <strong>100 minutes</strong>.  
    Leur durée varie beaucoup, car la Lune n’est jamais totalement plongée dans l’ombre terrestre.

    <br><br>

    🔸 <strong>Éclipses totales</strong>  
    Le grand spectacle !  
    Elles durent souvent plus longtemps que les autres catégories, avec des pics autour de  
    <strong>70 à 110 minutes</strong>.  
    Ce sont généralement les plus intenses — celles qui donnent naissance à la fameuse <strong>Lune rouge</strong>.
</p>

    </div>
</section>


<section class="section-block">
    <h2 class="section-heading glow-title"> Répartition des types d’éclipses lunaires</h2>

    <div class="card graph-wide graph-premium">

        <div class="lunar-container">

            <!-- GRAPHIQUE À GAUCHE -->
            <div class="lunar-left">
                <h3 class="graph-title">Proportion par type</h3>
                <canvas id="lunarTypeChart"></canvas>
            </div>

            <!-- TEXTE EXPLICATIF À DROITE -->
            <div class="lunar-text">

    <p>
        Une éclipse lunaire peut être <strong>pénombrale</strong>, <strong>partielle</strong> ou <strong>totale</strong>.
        Le camembert regroupe ces types, mais en affiche aussi leurs <strong>sous-catégories</strong>
        (indiquées par les petites étiquettes : <em>p, p-, a, t, pp, tp…</em>).
    </p>

    <p>
        🔸 <strong>Pénombrales</strong> (p / p−) — les plus fréquentes.  
        La Lune s’assombrit légèrement sans disparaître : ce sont les plus grosses parts du graphique.
    </p>

    <p>
        🔸 <strong>Partielles</strong> (a / h / hp…) — la Lune entre partiellement dans l’ombre.  
        Elles forment plusieurs couleurs car chaque sous-type correspond à un cas légèrement différent.
    </p>

    <p>
        🔸 <strong>Totales</strong> (t / tp) — les plus rares :  
        la Lune devient entièrement rouge cuivré. Elles apparaissent en petites parts.
    </p>

    <p>
        Le graphique montre donc non seulement la fréquence des trois grands types,
        mais aussi la répartition de leurs <strong>variantes</strong>.
    </p>

</div>


        </div>

    </div>
</section>



    <!-- ============================= -->
    <!--           FUN FACTS           -->
    <!-- ============================= -->
    <section class="section-block">
        <h2 class="section-heading"> Le savais-tu ?</h2>
    <div class="card graph-wide graph-premium">
            <?php include "funfacts.php"; ?>
        </div>
    </section>




    <!-- ============================= -->
    <!--       POUR ALLER PLUS LOIN    -->
    <!-- ============================= -->
    <section class="section-block">
        <h2 class="section-heading"> Pour aller plus loin</h2>

        <br>

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

            <a href="../eclipses_solaires/eclipses_solaires.php" class="more-card">
                <img src="images/eclipses_solaires.jpg">
                <div class="more-title">Éclipses Solaires</div>
            </a>

        </div>
    </section>

</div>




<!-- ============================= -->
<!--     SCRIPTS GRAPHIQUES        -->
<!-- ============================= -->
<script src="durations.js"></script>
<script src="total.js"></script>
<script src="types.js"></script>
<script src="sample.js"></script>
<?php include 'includes/footer.php'; ?>

</body>
</html>




