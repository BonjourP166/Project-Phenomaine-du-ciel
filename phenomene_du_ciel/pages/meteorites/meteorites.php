<?php
// === meteorites.php ===
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> Météorites – Phénomènes du Ciel</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="meteorites.css">
    <link rel="stylesheet" href="../../styles/css_banieres.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

<!-- Fond étoiles -->
<div class="stars"></div>

<div class="container">

    <!-- ============================= -->
    <!--           TITRE               -->
    <!-- ============================= -->
    <header class="main-title">
        <h1>Météorites</h1>
        <br>
        <br>
        <p class="subtitle">
            Les fragments d'étoiles tombés sur Terre
        </p>
    </header>



    <!-- ============================= -->
    <!--     INTRODUCTION PREMIUM     -->
    <!-- ============================= -->
    <section class="section-block intro">

    <h2 class="section-heading"> Qu’est-ce qu’une Météorite ?</h2>

    <p>
        Une météorite, c’est un petit morceau d’astéroïde ou de comète qui a voyagé
        pendant des millions d’années dans l’espace… jusqu’à finir sa course sur Terre !
    </p>

    <p>
        Lorsqu’elle traverse l’atmosphère, elle s’échauffe fortement et produit une 
        lumière brillante : <strong>la météore</strong> (une étoile filante). 
        Et si un fragment survit à cette traversée, on l’appelle alors 
        <strong>météorite</strong>.
    </p>

    <h2 class="section-heading"> Comment naît une météorite ?</h2>

<div class="steps-wrapper">

    <!-- Colonne Steps -->
    <div class="steps-column">
        <div class="steps">

            <div class="step">
                <div class="step-number">1</div>
                Un morceau se détache d’un astéroïde ou d’une comète.
            </div>

            <div class="step">
                <div class="step-number">2</div>
                Il dérive dans l’espace comme un petit caillou cosmique.
            </div>

            <div class="step">
                <div class="step-number">3</div>
                La Terre l’attire : il entre dans l’atmosphère à plus de 50 000 km/h.
            </div>

            <div class="step">
                <div class="step-number">4</div>
                Il chauffe, s’illumine… parfois explose.
            </div>

            <div class="step">
                <div class="step-number">5</div>
                Et si un fragment survit : il tombe au sol.
            </div>

        </div>
    </div>

    <!-- Colonne IMAGE (celle que tu avais déjà !) -->
    <div class="steps-image">
        <img src="schema_meteorite.jpg" class="schema">
    </div>

</div>

<h2 class="section-heading">Les trois grandes familles</h2>

<ul class="premium-list">
    <li>
        <strong>Chondrites (Classe : C)</strong> → les plus anciennes et les plus nombreuses. 
        Elles contiennent des chondres, de minuscules grains formés il y a plus de 
        <strong>4,5 milliards d’années</strong>. Ce sont de véritables capsules temporelles du système solaire.
    </li>

    <br>

    <li>
        <strong>Achondrites (Classe : A)</strong> → des météorites rocheuses provenant 
        d’astéroïdes qui ont connu du <strong>volcanisme</strong>. Elles ressemblent parfois 
        à des roches terrestres et n'ont plus de chondres.
    </li>

    <br>

    <li>
        <strong>Météorites métalliques (Classe : M)</strong> → riches en <strong>fer</strong> et <strong>nickel</strong>, 
        très lourdes et brillantes. Elles proviennent du <strong>cœur métallique</strong> d’astéroïdes brisés.
    </li>
</ul>


<h2 class="section-heading">Où en trouve-t-on ?</h2>

<p>
    On peut trouver des météorites partout sur Terre, mais certains environnements les révèlent 
    beaucoup plus facilement :
</p>

<ul class="premium-list">
    <li> <strong>Les déserts</strong> (Sahara, Oman…) → les pierres sombres ressortent sur les sols clairs.</li>
    <li> <strong>Les glaces de l’Antarctique</strong> → le vent y concentre les météorites sur les champs de glace.</li>
    <li> <strong>Les grands plateaux rocheux</strong> → terrains stables où les météorites se conservent très bien.</li>
</ul>

<p>
    Dans ces paysages dégagés, un fragment venu de l’espace se distingue 
    <strong>bien plus facilement</strong> que dans les villes ou les forêts.
</p>


<h2 class="section-heading">Pourquoi les étudier ?</h2>

<p>
    Les météorites sont de véritables <strong>archives cosmiques</strong>.  
    Elles permettent de comprendre :
</p>

<div class="study-grid">

    <div class="study-card">
        <span class="icon">🌟</span>
        <p><strong>Les matériaux les plus anciens</strong> du système solaire, conservés depuis plus de 4,5 milliards d'années.</p>
    </div>

    <div class="study-card">
        <span class="icon">🪐</span>
        <p><strong>La formation des planètes</strong> et l’évolution interne des astéroïdes grâce à leur composition unique.</p>
    </div>

    <div class="study-card">
        <span class="icon">🧬</span>
        <p><strong>Les molécules organiques</strong> qu’elles transportent parfois, dont certaines liées à l’origine de la vie.</p>
    </div>

</div>

<p>
    Étudier une météorite, c’est observer un fragment du passé tombé du ciel.  
    Une rencontre directe avec l’histoire du système solaire.
</p>

</section>



   <!-- ============================= -->
<!--     SEPARATOR TEXT BLOCK     -->
<!-- ============================= -->
<div class="transition premium-separator">
     Plongeons maintenant dans les données récoltées à travers le monde.
</div>

<!-- ============================= -->
<!--   1. APERÇU DU DATASET        -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading">Aperçu du Dataset</h2>

    <div class="card">
        <p class="small">
            Voici un extrait des météorites recensées dans notre base de données.  
            Chaque ligne correspond à une <strong>météorite réelle observée sur Terre</strong>.
        </p>

        <div id="loading-sample">Chargement…</div>

        <table id="table-meteorites">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Masse (g)</th>
                    <th>Classe</th>
                    <th>Type</th>
                    <th>Pays</th>
                    <th>Année</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- 📌 Légende premium pour la page Météorites -->
<div class="legend-box">
    <p> <strong>Classe</strong> — catégorie pétrologique de la météorite  
        <span class="ex">(ex : L6, H5, LL6, EH4…)</span>
    </p>

    <p><strong>Pays</strong> — code ISO du pays de découverte  
        <span class="ex">(ex : ARG, FRA, USA)</span>
    </p>

    <p><strong>Masse (g)</strong> — masse estimée du fragment récupéré.</p>

    <p> <strong>Type</strong> — statut de validation  
        <span class="valid"><strong>Valid</strong> = confirmé par la Meteoritical Society</span>
    </p>

    <p> <strong>Année</strong> — année d’observation ou de découverte officielle.</p>
</div>

        <a href="meteorite.csv" download class="download-button">
            Télécharger le dataset (CSV)
        </a>
    </div>

    <!--  Transition vers les graphiques -->
    <p class="transition small" style="margin-top: 15px; opacity: 0.9;">
     Au cœur des données se cachent des histoires venues de l’espace… découvrons-les ensemble.
    </p>

</section>



    <!-- ============================= -->
<!--   2. RÉPARTITION DES CLASSES -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading glow-title">Répartition des classes de météorites</h2>

    <div class="card graph-wide graph-premium classes-wrapper">

        <p class="small" style="margin-bottom: 25px; opacity: 0.9;">
            Les classes de météorites indiquent leur composition et leur degré de métamorphisme.
            Ce graphique met en évidence les sous-familles les plus fréquentes observées.
        </p>

        <div class="classes-container">

            <!-- GRAPHIQUE À GAUCHE -->
            <div class="classes-left">
                <h3 class="graph-title">Top classes + Autres</h3>
                <canvas id="classesChart"></canvas>
            </div>

            <!-- TEXTE EXPLICATIF À DROITE -->
            <div class="classes-text">
                <p>
                    Les classes <strong>L6</strong>, <strong>H5</strong> et <strong>H4</strong> 
                    dominent largement le dataset. Elles appartiennent toutes à la famille des 
                    <strong>chondrites ordinaires</strong>, qui représentent environ
                    <strong>80 %</strong> des météorites découvertes.
                </p>

                <p>
                    Les lettres <strong>H</strong>, <strong>L</strong> et <strong>LL</strong>
                    indiquent la quantité de métal contenue :
                </p>

                <ul class="premium-list">
                    <li>🔵 <strong>H</strong> → riches en fer</li>
                    <li>🟢 <strong>L</strong> → fer modéré</li>
                    <li>🟣 <strong>LL</strong> → très pauvres en métal</li>
                </ul>

                <p>
                    Le chiffre <strong>4, 5 ou 6</strong> représente le 
                    <em>degré de métamorphisme</em> : un chiffre élevé signifie que la
                    météorite a été plus chauffée et transformée dans son astéroïde d’origine.
                </p>
            </div>

        </div>

    </div>
</section>


    <!-- ============================= -->
    <!--   3. MASSES MOYENNES          -->
    <!-- ============================= -->
    <section class="section-block">
    <h2 class="section-heading"> Masse moyenne par grandes familles</h2>

    <div class="card graph-wide">
        <p class="small">
            Les classes étant très nombreuses, elles sont regroupées ici en
            grandes catégories pour faciliter la comparaison.
        </p>
        
        <br>

        <h3 class="graph-title"> Masse moyenne par famille</h3>

        <canvas id="bigClassesMassChart"></canvas>

        <p class="interpretation">
    Ce graphique montre que toutes les météorites ne se ressemblent pas du tout !  

    <br><br>

    🔸 <strong>Chondrites</strong>  
    Ce sont les « cailloux spatiaux » les plus courants : petits, légers, mais ultra nombreux.

    <br><br>

    🔸 <strong>Carbonées</strong>  
    Un peu plus massives et très anciennes, elles peuvent contenir des molécules organiques.

    <br><br>

    🔸 <strong>Achondrites</strong>  
    Plus lourdes : elles viennent de petits mondes qui ont déjà fondu et se sont transformés.

    <br><br>

    🔸 <strong>Météorites ferreuses</strong>  
    Les championnes du poids !  
    Elles proviennent du cœur métallique d’anciens astéroïdes.

    <br><br>

    Au final :  
    <strong>plus une météorite est issue d’un astéroïde “évolué”, plus elle est lourde</strong> !
</p>
    </div>
</section>





    <!-- ============================= -->
<!--        4. TOP 10 PREMIUM      -->
<!-- ============================= -->
<section class="section-block">
    <h2 class="section-heading"> Top 10 des météorites les plus massives</h2>

    <div class="card">
        <div id="podium" class="podium-container"></div>

        <hr class="separator">

        <ul id="rankingList" class="ranking-list"></ul>
    </div>
</section>




    <!-- ============================= -->
    <!--         5. FUN FACTS          -->
    <!-- ============================= -->
    <section class="section-block">
        <h2 class="section-heading"> Le savais-tu ?</h2>

        <div class="card graph-wide graph-premium">
            <?php include "funfacts.php"; ?>
        </div>
    </section>

    <section class="section-block">
    <h2 class="section-heading">Pour aller plus loin</h2>

    <p class="small" style="text-align:center; max-width:800px; margin:auto;">
        Les météorites ne sont qu'un des nombreux phénomènes fascinants qui relient 
        la Terre au cosmos. Continue ton exploration et découvre d’autres merveilles 
        célestes qui transforment notre vision de l’univers.
    </p>

    <div class="more-container">

        <!-- Carte 1 -->
        <a href="../eclipses_solaires/eclipses_solaires.php" class="more-card">
            <img src="images/eclipses_solaires.jpg" alt="Éclipses Solaires">
            <div class="more-title">Éclipses Solaires</div>
        </a>

        <!-- Carte 2 -->
        <a href="../bolides/bolides.php" class="more-card">
            <img src="images/bolides.jpg" alt="Bolides">
            <div class="more-title">Bolides</div>
        </a>

        <!-- Carte 3 -->
        <a href="../eclipses_lunaires/eclipses_lunaires.php" class="more-card">
            <img src="images/eclipses_lunaires.jpg" alt="Éclipses Lunaires">
            <div class="more-title">Éclipses Lunaires</div>
        </a>

    </div>
</section>

</div>



<!-- ============================= -->
<!--           JS FILES           -->
<!-- ============================= -->
<script src="sample.js"></script>
<script src="classes.js"></script>
<script src="big_classes.js"></script>
<script src="top10.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
