<?php
// --- DATOS DE LA FRISE EN PHP ---
$events = [
    "1492" => [
        "title" => "Météorite d’Ensisheim – 1492",
        "subtitle" => "Une des plus anciennes chutes documentées en Europe",
        "details" => "La météorite d’Ensisheim est tombée en Alsace en 1492. Elle a marqué les esprits de l’époque et est encore conservée aujourd’hui au musée d’Ensisheim.",
        "extra" => "Masse : ~127 kg",
        "image" => "img/frise-ensisheim.png"
    ],
    "1803" => [
        "title" => "Bolide de L’Aigle – 1803",
        "subtitle" => "La chute qui a convaincu les savants de l’origine extraterrestre des météorites",
        "details" => "Des milliers de fragments sont tombés près de L’Aigle, en Normandie. L’enquête de Biot a confirmé que les pierres venaient de l’espace.",
        "extra" => "Plus de 3000 fragments retrouvés",
        "image" => "img/frise-aigle.png"
    ],
    "1908" => [
        "title" => "Explosion de la Tunguska – 1908",
        "subtitle" => "Une gigantesque explosion atmosphérique en Sibérie",
        "details" => "L’explosion a rasé plus de 2000 km² de forêt en Sibérie centrale. On pense qu’un astéroïde ou une comète a explosé dans l’atmosphère.",
        "extra" => "Énergie estimée : 10–15 mégatonnes",
        "image" => "img/frise-tunguska.png"
    ],
    "1919" => [
        "title" => "Éclipse solaire totale – 1919",
        "subtitle" => "L’éclipse qui a confirmé la relativité générale",
        "details" => "Lors de l’éclipse observée depuis Sobral et l’île de Príncipe, Arthur Eddington a mesuré la déviation de la lumière des étoiles par le Soleil, confirmant la théorie d’Einstein.",
        "extra" => "Déviation mesurée : ~1,75\" d’arc",
        "image" => "img/frise-1919.png"
    ],
    "1969" => [
        "title" => "Météorite de Murchison – 1969",
        "subtitle" => "Un trésor pour l’étude des molécules organiques",
        "details" => "La météorite de Murchison, tombée en Australie, contient de nombreux composés organiques. Elle est essentielle pour l’étude de l’origine des molécules de la vie.",
        "extra" => "Type : chondrite carbonée",
        "image" => "img/frise-murchison.png"
    ],
    "2009" => [
        "title" => "Éclipse solaire – 2008/2009",
        "subtitle" => "L’une des éclipses les plus longues du XXIᵉ siècle",
        "details" => "Une éclipse solaire totale, très longue, a été visible en 2008–2009 en Asie. Elle a donné lieu à de nombreuses observations scientifiques et touristiques.",
        "extra" => "Durée maximale : ~6 min 39 s",
        "image" => "img/frise-eclipse2008.png"
    ],
    "2013" => [
        "title" => "Bolide de Tcheliabinsk – 2013",
        "subtitle" => "L’entrée spectaculaire d’un astéroïde au-dessus de la Russie",
        "details" => "Un astéroïde a explosé au-dessus de la région de Tcheliabinsk, brisant des milliers de vitres et blessant plus d’un millier de personnes, surtout par les éclats de verre.",
        "extra" => "Diamètre estimé : ~20 m",
        "image" => "img/frise-tcheliabinsk.png"
    ],
    "2018" => [
        "title" => "Éclipse lunaire du siècle – 2018",
        "subtitle" => "Une très longue éclipse lunaire totale",
        "details" => "L’éclipse lunaire du 27 juillet 2018 a été surnommée « l’éclipse du siècle » en raison de sa durée totale exceptionnelle, visible notamment en Europe, Afrique et Asie.",
        "extra" => "Durée de la totalité : ~1 h 43",
        "image" => "img/frise-lune2018.png"
    ],
    "2024" => [
        "title" => "Éclipse solaire totale – 2024",
        "subtitle" => "Une grande éclipse traversant l’Amérique du Nord",
        "details" => "Le 8 avril 2024, une éclipse totale a traversé le Mexique, les États-Unis et le Canada, attirant des millions d’observateurs et de nombreuses équipes scientifiques.",
        "extra" => "Largeur de la bande de totalité : ~200 km",
        "image" => "img/frise-2024.png"
    ],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Frise Chronologique – Grands Événements Astronomiques</title>
    <style>
        * { box-sizing: border-box; margin:0; padding:0; }
        body {
            font-family: "Georgia", serif;
            background: #000 url("img/fond-espace.jpg") center/cover no-repeat fixed;
            color: #fff;
        }
        a { color: #f7d36a; text-decoration:none; }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0 40px;
        }

        header {
            display:flex;
            justify-content:center;
            gap:40px;
            margin-bottom:20px;
            font-size:18px;
        }
        header a:hover { text-decoration:underline; }

        .title {
            text-align:center;
            font-size:32px;
            color:#f7d36a;
            margin-bottom:20px;
        }

        .glass {
            background: rgba(255,255,255,0.10);
            border-radius:30px;
            padding:24px 40px;
            margin: 0 auto 30px;
            max-width:1000px;
            text-align:center;
            line-height:1.6;
            font-size:18px;
        }

        /* FRISE */
        .timeline-wrapper {
            margin: 20px auto 10px;
            max-width: 1100px;
            position:relative;
        }
        .timeline-line {
            height:6px;
            background:#f4d230;
            border-radius:3px;
            position:relative;
            margin:60px 40px 0;
        }
        .timeline-arrow {
            position:absolute;
            right:10px;
            top:52px;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            border-left: 22px solid #f4d230;
        }

        .timeline-events {
            position:absolute;
            left:40px;
            right:40px;
            top:46px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            pointer-events:none;
        }

        .timeline-event {
            position:relative;
            text-align:center;
            pointer-events:auto;
            cursor:pointer;
        }

        .timeline-dot {
            width:22px;
            height:22px;
            border-radius:50%;
            background:#7427c5;
            border:3px solid #2a0a60;
            margin:0 auto 8px;
        }

        .timeline-year {
            font-size:14px;
            margin-bottom:3px;
        }

        .timeline-label {
            font-size:11px;
            max-width:110px;
        }

        /* TARJETA DEL EVENTO */
        .event-card {
            position:absolute;
            left:50%;
            top:20%;
            transform:translateX(-50%);
            width:380px;
            background:rgba(0,0,0,0.85);
            border-radius:26px;
            padding:18px 20px 20px;
            box-shadow:0 0 25px rgba(0,0,0,0.9);
            display:none;
        }
        .event-title {
            font-size:18px;
            color:#f7d36a;
            margin-bottom:4px;
        }
        .event-subtitle {
            font-size:14px;
            margin-bottom:8px;
        }
        .event-details {
            font-size:13px;
            margin-bottom:8px;
        }
        .event-extra {
            font-size:12px;
            opacity:0.9;
            margin-bottom:10px;
        }
        .event-image {
            width:100%;
            border-radius:18px;
            display:block;
        }
        .event-close {
            position:absolute;
            top:8px;
            right:14px;
            font-size:22px;
            cursor:pointer;
        }

        @media (max-width: 900px) {
            .timeline-label { display:none; }
            .glass { padding:18px 20px; font-size:16px; }
            .event-card { width:90%; }
        }

        footer {
            margin-top:30px;
            text-align:right;
            font-size:14px;
        }
    </style>
</head>
<body>
<div class="page">

    <!-- MENU SUPERIOR -->
    <header>
        <a href="index.php">Phénomène</a>
        <a href="index.php">Carte</a>
        <a href="frise.php"><strong>Frise Chronologique</strong></a>
    </header>

    <!-- TITULO -->
    <div class="title">
        Voyage À Travers Le Temps : Les Grands Événements Astronomiques
    </div>

    <!-- TEXTO INTRO SUPERIOR -->
    <div class="glass">
        Depuis des siècles, les phénomènes célestes fascinent les observateurs du ciel.<br>
        Des chutes de météorites spectaculaires aux éclipses rares, chaque événement a marqué notre histoire
        et enrichi nos connaissances sur l’univers.<br><br>
        Cette frise chronologique retrace quelques grandes dates liées aux météorites, bolides, éclipses solaires et lunaires.<br>
        🌍 Cliquez sur les points lumineux pour en savoir plus sur chaque phénomène.
    </div>

    <!-- FRISE -->
    <div class="timeline-wrapper">
        <div class="timeline-line"></div>
        <div class="timeline-arrow"></div>

        <!-- PUNTOS DE LA FRISE -->
        <div class="timeline-events">
            <div class="timeline-event" data-year="1492">
                <div class="timeline-dot"></div>
                <div class="timeline-year">1492</div>
                <div class="timeline-label">Météorite d’Ensisheim</div>
            </div>
            <div class="timeline-event" data-year="1803">
                <div class="timeline-dot"></div>
                <div class="timeline-year">1803</div>
                <div class="timeline-label">Bolide de L’Aigle</div>
            </div>
            <div class="timeline-event" data-year="1908">
                <div class="timeline-dot"></div>
                <div class="timeline-year">1908</div>
                <div class="timeline-label">Explosion de la Tunguska</div>
            </div>
            <div class="timeline-event" data-year="1919">
                <div class="timeline-dot"></div>
                <div class="timeline-year">1919</div>
                <div class="timeline-label">Éclipse Solaire Totale</div>
            </div>
            <div class="timeline-event" data-year="1969">
                <div class="timeline-dot"></div>
                <div class="timeline-year">1969</div>
                <div class="timeline-label">Météorite de Murchison</div>
            </div>
            <div class="timeline-event" data-year="2009">
                <div class="timeline-dot"></div>
                <div class="timeline-year">2009</div>
                <div class="timeline-label">Éclipse Solaire</div>
            </div>
            <div class="timeline-event" data-year="2013">
                <div class="timeline-dot"></div>
                <div class="timeline-year">2013</div>
                <div class="timeline-label">Bolide de Tcheliabinsk</div>
            </div>
            <div class="timeline-event" data-year="2018">
                <div class="timeline-dot"></div>
                <div class="timeline-year">2018</div>
                <div class="timeline-label">Éclipse Lunaire du Siècle</div>
            </div>
            <div class="timeline-event" data-year="2024">
                <div class="timeline-dot"></div>
                <div class="timeline-year">2024</div>
                <div class="timeline-label">Éclipse Solaire Totale</div>
            </div>
        </div>

        <!-- TARJETA DETALLADA -->
        <div class="event-card" id="eventCard">
            <div class="event-close" id="eventClose">&times;</div>
            <div class="event-title" id="cardTitle"></div>
            <div class="event-subtitle" id="cardSubtitle"></div>
            <div class="event-details" id="cardDetails"></div>
            <div class="event-extra" id="cardExtra"></div>
            <img id="cardImage" class="event-image" src="" alt="">
        </div>
    </div>

    <!-- TEXTO INFERIOR -->
    <div class="glass">
        Cette frise illustre à quel point les phénomènes astronomiques rythment notre histoire.<br>
        Chaque observation, chaque chute, chaque éclipse est une fenêtre ouverte sur l’univers.<br><br>
         Continuez votre exploration en découvrant les pages dédiées à chaque phénomène !
    </div>

    <footer>
        <a href="apropos.php">À Propos De Nous</a> &nbsp; | &nbsp;
        <a href="contact.php">Nous Contacter</a>
    </footer>
</div>

<script>
// Pasamos los datos PHP a JS
const events = <?php echo json_encode($events, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

const card      = document.getElementById('eventCard');
const closeBtn  = document.getElementById('eventClose');
const titleEl   = document.getElementById('cardTitle');
const subtitleEl= document.getElementById('cardSubtitle');
const detailsEl = document.getElementById('cardDetails');
const extraEl   = document.getElementById('cardExtra');
const imgEl     = document.getElementById('cardImage');

document.querySelectorAll('.timeline-event').forEach(evt => {
    evt.addEventListener('click', () => {
        const year = evt.getAttribute('data-year');
        const data = events[year];
        if (!data) return;

        titleEl.textContent    = data.title;
        subtitleEl.textContent = data.subtitle;
        detailsEl.textContent  = data.details;
        extraEl.textContent    = data.extra;
        imgEl.src              = data.image;
        imgEl.alt              = data.title;

        card.style.display = 'block';
    });
});

closeBtn.addEventListener('click', () => {
    card.style.display = 'none';
});
</script>
</body>
</html>
