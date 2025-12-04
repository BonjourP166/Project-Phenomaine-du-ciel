<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ========================================
//  🌍 Page pays.php — liée à la carte & aux filtres
// ========================================

// 1) Vérifier que le code ISO3 est présent
if (!isset($_GET['code'])) {
    die("Aucun pays sélectionné.");
}

$paysNames = [
    "AFG" => "Afghanistan",
    "ALB" => "Albanie",
    "DZA" => "Algérie",
    "AND" => "Andorre",
    "AGO" => "Angola",
    "ATG" => "Antigua-et-Barbuda",
    "ARG" => "Argentine",
    "ARM" => "Arménie",
    "AUS" => "Australie",
    "AUT" => "Autriche",
    "AZE" => "Azerbaïdjan",
    "BHS" => "Bahamas",
    "BHR" => "Bahreïn",
    "BGD" => "Bangladesh",
    "BRB" => "Barbade",
    "BLR" => "Biélorussie",
    "BEL" => "Belgique",
    "BLZ" => "Belize",
    "BEN" => "Bénin",
    "BTN" => "Bhoutan",
    "BOL" => "Bolivie",
    "BIH" => "Bosnie-Herzégovine",
    "BWA" => "Botswana",
    "BRA" => "Brésil",
    "BRN" => "Brunei",
    "BGR" => "Bulgarie",
    "BFA" => "Burkina Faso",
    "BDI" => "Burundi",
    "CPV" => "Cap-Vert",
    "KHM" => "Cambodge",
    "CMR" => "Cameroun",
    "CAN" => "Canada",
    "CAF" => "République centrafricaine",
    "TCD" => "Tchad",
    "CHL" => "Chili",
    "CHN" => "Chine",
    "COL" => "Colombie",
    "COM" => "Comores",
    "COG" => "République du Congo",
    "COD" => "République démocratique du Congo",
    "CRI" => "Costa Rica",
    "CIV" => "Côte d'Ivoire",
    "HRV" => "Croatie",
    "CUB" => "Cuba",
    "CYP" => "Chypre",
    "CZE" => "Tchéquie",
    "DNK" => "Danemark",
    "DJI" => "Djibouti",
    "DMA" => "Dominique",
    "DOM" => "République dominicaine",
    "ECU" => "Équateur",
    "EGY" => "Égypte",
    "SLV" => "Salvador",
    "GNQ" => "Guinée équatoriale",
    "ERI" => "Érythrée",
    "EST" => "Estonie",
    "SWZ" => "Eswatini",
    "ETH" => "Éthiopie",
    "FJI" => "Fidji",
    "FIN" => "Finlande",
    "FRA" => "France",
    "GAB" => "Gabon",
    "GMB" => "Gambie",
    "GEO" => "Géorgie",
    "DEU" => "Allemagne",
    "GHA" => "Ghana",
    "GRC" => "Grèce",
    "GRD" => "Grenade",
    "GTM" => "Guatemala",
    "GIN" => "Guinée",
    "GNB" => "Guinée-Bissau",
    "GUY" => "Guyana",
    "HTI" => "Haïti",
    "HND" => "Honduras",
    "HUN" => "Hongrie",
    "ISL" => "Islande",
    "IND" => "Inde",
    "IDN" => "Indonésie",
    "IRN" => "Iran",
    "IRQ" => "Irak",
    "IRL" => "Irlande",
    "ISR" => "Israël",
    "ITA" => "Italie",
    "JAM" => "Jamaïque",
    "JPN" => "Japon",
    "JOR" => "Jordanie",
    "KAZ" => "Kazakhstan",
    "KEN" => "Kenya",
    "KIR" => "Kiribati",
    "PRK" => "Corée du Nord",
    "KOR" => "Corée du Sud",
    "KWT" => "Koweït",
    "KGZ" => "Kirghizistan",
    "LAO" => "Laos",
    "LVA" => "Lettonie",
    "LBN" => "Liban",
    "LSO" => "Lesotho",
    "LBR" => "Libéria",
    "LBY" => "Libye",
    "LIE" => "Liechtenstein",
    "LTU" => "Lituanie",
    "LUX" => "Luxembourg",
    "MDG" => "Madagascar",
    "MWI" => "Malawi",
    "MYS" => "Malaisie",
    "MDV" => "Maldives",
    "MLI" => "Mali",
    "MLT" => "Malte",
    "MHL" => "Îles Marshall",
    "MRT" => "Mauritanie",
    "MUS" => "Maurice",
    "MEX" => "Mexique",
    "FSM" => "Micronésie",
    "MDA" => "Moldavie",
    "MCO" => "Monaco",
    "MNG" => "Mongolie",
    "MNE" => "Monténégro",
    "MAR" => "Maroc",
    "MOZ" => "Mozambique",
    "MMR" => "Myanmar",
    "NAM" => "Namibie",
    "NRU" => "Nauru",
    "NPL" => "Népal",
    "NLD" => "Pays-Bas",
    "NZL" => "Nouvelle-Zélande",
    "NIC" => "Nicaragua",
    "NER" => "Niger",
    "NGA" => "Nigéria",
    "MKD" => "Macédoine du Nord",
    "NOR" => "Norvège",
    "OMN" => "Oman",
    "PAK" => "Pakistan",
    "PLW" => "Palaos",
    "PAN" => "Panama",
    "PNG" => "Papouasie-Nouvelle-Guinée",
    "PRY" => "Paraguay",
    "PER" => "Pérou",
    "PHL" => "Philippines",
    "POL" => "Pologne",
    "PRT" => "Portugal",
    "QAT" => "Qatar",
    "ROU" => "Roumanie",
    "RUS" => "Russie",
    "RWA" => "Rwanda",
    "KNA" => "Saint-Christophe-et-Niévès",
    "LCA" => "Sainte-Lucie",
    "VCT" => "Saint-Vincent-et-les-Grenadines",
    "WSM" => "Samoa",
    "SMR" => "Saint-Marin",
    "STP" => "Sao Tomé-et-Principe",
    "SAU" => "Arabie saoudite",
    "SEN" => "Sénégal",
    "SRB" => "Serbie",
    "SYC" => "Seychelles",
    "SLE" => "Sierra Leone",
    "SGP" => "Singapour",
    "SVK" => "Slovaquie",
    "SVN" => "Slovénie",
    "SLB" => "Îles Salomon",
    "SOM" => "Somalie",
    "ZAF" => "Afrique du Sud",
    "SSD" => "Soudan du Sud",
    "ESP" => "Espagne",
    "LKA" => "Sri Lanka",
    "SDN" => "Soudan",
    "SUR" => "Suriname",
    "SWE" => "Suède",
    "CHE" => "Suisse",
    "SYR" => "Syrie",
    "TWN" => "Taïwan",
    "TJK" => "Tadjikistan",
    "TZA" => "Tanzanie",
    "THA" => "Thaïlande",
    "TLS" => "Timor oriental",
    "TGO" => "Togo",
    "TON" => "Tonga",
    "TTO" => "Trinité-et-Tobago",
    "TUN" => "Tunisie",
    "TUR" => "Turquie",
    "TKM" => "Turkménistan",
    "TUV" => "Tuvalu",
    "UGA" => "Ouganda",
    "UKR" => "Ukraine",
    "ARE" => "Émirats arabes unis",
    "GBR" => "Royaume-Uni",
    "USA" => "États-Unis",
    "URY" => "Uruguay",
    "UZB" => "Ouzbékistan",
    "VUT" => "Vanuatu",
    "VAT" => "Vatican",
    "VEN" => "Venezuela",
    "VNM" => "Vietnam",
    "YEM" => "Yémen",
    "ZMB" => "Zambie",
    "ZWE" => "Zimbabwe"
];


$iso = strtoupper($_GET['code']); // Exemple : FRA, USA, BRA...

// 2) Filtres venant de la carte
$phenomenon = $_GET["phenomenon"] ?? "all";  // bolides, meteorites, solaire, lunaire, all
$period     = $_GET["period"] ?? "all";      // all, recent, historic
$rarity     = $_GET["rarity"] ?? "all";   
$activity = $_GET["activity"] ?? "all";
$multi    = $_GET["multi"] ?? "all";
   // all, rare, no_rare
// activity / multi existent aussi mais on ne les applique pas ici pour simplifier

require_once "../../bd.php";
$bdd = getBD();


// ================================
// Vérifier que le pays existe
// ================================
$sql = "SELECT DISTINCT pays FROM localisations WHERE pays = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$iso]);
$info = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$info) {
    die("❌ Ce pays n'existe pas dans la base de données.");
}

$paysNom = $paysNames[$iso] ?? $iso;



// ================================
// Fonctions utilitaires
// ================================

// 🔹 Compter le nombre total d’événements par table (pour le résumé)
function getCount($bdd, $table, $iso) {
    $sql = "
        SELECT COUNT(*)
        FROM $table t
        JOIN localisations l ON t.id_localisation = l.id_localisation
        WHERE l.pays = ?
    ";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$iso]);
    return (int) $stmt->fetchColumn();
}

// 🔹 Construire une requête détaillée selon phénomène / période / rareté
function buildDetailQuery($phenomenon, $period, $rarity) {

    $table  = "";
    $fields = "";
    $joins  = "
        JOIN localisations l ON t.id_localisation = l.id_localisation
        JOIN dates d ON t.id_date = d.id_date
    ";

    switch ($phenomenon) {
        case "bolides":
            $table = "bolides";
            $fields = "
                t.id_bolide       AS id,
                t.vitesse_kms,
                t.energie_totale_rayonnee_j,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            ";
            break;

        case "meteorites":
            $table = "meteorites";
            $fields = "
                t.id_meteo        AS id,
                t.nom,
                t.type_meteorite,
                t.classe_meteo,
                t.masse,
                t.chute_observe,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            ";
            break;

        case "solaire":
            $table = "eclipses_solaires";
            $fields = "
                t.id_eclipse_solaire AS id,
                t.gamma,
                t.eclipse_magnitude,
                t.path_width_km,
                t.central_duration,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            ";
            break;

        case "lunaire":
            $table = "eclipses_lunaires";
            $fields = "
                t.id_eclipse_lunaire AS id,
                t.quincena_solar_eclipse,
                t.penumbral_eclipse_duration_m,
                t.partial_eclipse_duration_m,
                t.total_eclipse_duration_m,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            ";
            break;

        default:
            return "INVALID";
    }

    // Conditions dynamiques
    $conditions = ["l.pays = :iso"];

    // ⏳ Période (optionnelle)
    if ($period === "recent") {
        $conditions[] = "d.annee >= 2000";
    } elseif ($period === "historic") {
        $conditions[] = "d.annee < 2000";
    }

    // ⭐ Rareté (optionnelle)
    if ($rarity === "rare") {
        switch ($phenomenon) {
            case "bolides":
                $conditions[] = "(t.energie_totale_rayonnee_j >= 1e11 OR t.vitesse_kms >= 40)";
                break;
            case "meteorites":
                $conditions[] = "t.masse >= 100000";
                break;
            case "solaire":
                $conditions[] = "t.eclipse_magnitude >= 0.99";
                break;
            case "lunaire":
                $conditions[] = "t.total_eclipse_duration_m >= 60";
                break;
        }
    } elseif ($rarity === "no_rare") {
        // on pourrait théoriquement exclure les rares ici, mais pour rester simple, on affiche tout
    }

    $where = "WHERE " . implode(" AND ", $conditions);

    return "
        SELECT $fields
        FROM $table t
        $joins
        $where
        ORDER BY d.annee DESC, d.mois DESC
    ";
}


// ================================
//  Récupérer les données selon le contexte
// ================================

// Résumé toujours calculé (utile quand phenomenon = all)
$nbBolides    = getCount($bdd, "bolides",           $iso);
$nbMeteorites = getCount($bdd, "meteorites",        $iso);
$nbSol        = getCount($bdd, "eclipses_solaires", $iso);
$nbLun        = getCount($bdd, "eclipses_lunaires", $iso);

// Détails : uniquement si on a choisi un phénomène précis
$details = [];
if ($phenomenon !== "all") {
    $sqlDetail = buildDetailQuery($phenomenon, $period, $rarity);
    if ($sqlDetail !== "INVALID") {
        $stmt = $bdd->prepare($sqlDetail);
        $stmt->bindValue(':iso', $iso);
        $stmt->execute();
        $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Pour l'affichage du nom lisible
$phenLabels = [
    "bolides"    => "Bolides",
    "meteorites" => "Météorites",
    "solaire"    => "Éclipses solaires",
    "lunaire"    => "Éclipses lunaires",
    "all"        => "Tous phénomènes"
];
$currentPhenLabel = $phenLabels[$phenomenon] ?? "Phénomène inconnu";

function formatFilters($phenomenon, $period, $rarity, $activity, $multi) {
    $labels = [
        "phenomenon" => [
            "all" => "Tous phénomènes",
            "bolides" => "Bolides",
            "meteorites" => "Météorites",
            "solaire" => "Éclipses solaires",
            "lunaire" => "Éclipses lunaires"
        ],
        "period" => [
            "all" => "Toutes périodes",
            "recent" => "Récents",
            "historic" => "Historiques"
        ],
        "rarity" => [
            "all" => "Toutes raretés",
            "rare" => "Uniquement rares",
            "no_rare" => "Sans rares"
        ],
        "activity" => [
            "all" => "Tous niveaux d’activité",
            "low" => "Faible activité",
            "medium" => "Activité modérée",
            "high" => "Activité élevée",
            "very_high" => "Activité très élevée"
        ],
        "multi" => [
            "all" => "Toutes diversités",
            "multi" => "Pays multi-phénomènes",
            "mono" => "Pays mono-phénomène"
        ]
    ];

    $parts = [];

    if ($phenomenon !== "all") $parts[] = "Phénomène : <strong>".$labels["phenomenon"][$phenomenon]."</strong>";
    if ($period !== "all")     $parts[] = "Période : <strong>".$labels["period"][$period]."</strong>";
    if ($rarity !== "all")     $parts[] = "Rareté : <strong>".$labels["rarity"][$rarity]."</strong>";
    if ($activity !== "all")   $parts[] = "Activité : <strong>".$labels["activity"][$activity]."</strong>";
    if ($multi !== "all")      $parts[] = "Diversité : <strong>".$labels["multi"][$multi]."</strong>";

    return count($parts) > 0
        ? implode(" | ", $parts)
        : "Aucun filtre actif (tous les phénomènes affichés)";
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($paysNom) ?> — Phénomènes du ciel</title>
    <link rel="stylesheet" href="pays.css">
    <link rel="stylesheet" href="../../styles/css_banieres.css">
</head>

<body>
<?php include 'includes/header.php'; ?>

<header class="header-banner">
    <h1><?= htmlspecialchars($paysNom) ?></h1>

    <p class="filters-info">
    <?= formatFilters($phenomenon, $period, $rarity, $activity, $multi); ?>
</p>


    <p class="subtitle">
        <?php if ($phenomenon === "all"): ?>
            Pour plus d’informations, veuillez <strong>filtrer vos recherches</strong> sur la carte.
        <?php else: ?>
            Résultats filtrés selon vos critères (pays, phénomène, période, rareté).
        <?php endif; ?>
    </p>
</header>

<!-- ============================= -->
<!--  🌐 Résumé global du pays     -->
<!-- ============================= -->
<section class="stats-grid">
    <div class="stat-card" data-phen="bolides">
        <h3>🌠 Bolides</h3>
        <p class="stat-number"><?= $nbBolides ?></p>
    </div>

    <div class="stat-card" data-phen="meteorites">
        <h3>☄️ Météorites</h3>
        <p class="stat-number"><?= $nbMeteorites ?></p>
    </div>

    <div class="stat-card" data-phen="solaire">
        <h3>🌞 Éclipses solaires</h3>
        <p class="stat-number"><?= $nbSol ?></p>
    </div>

    <div class="stat-card" data-phen="lunaire">
        <h3>🌕 Éclipses lunaires</h3>
        <p class="stat-number"><?= $nbLun ?></p>
    </div>
</section>

<section id="detail-section" class="section-block" style="display:none;">
    <h2 id="detail-title"></h2>
    <input type="text" id="search-input" class="search-input"
           placeholder="🔎 Rechercher dans ces enregistrements...">
    <div id="table-container"></div>
</section>


<?php if ($phenomenon === "all"): ?>

    <!-- Cas où l’utilisateur n’a pas choisi de phénomène précis -->
    <section class="mini-resume">
        <h2>📌 Résumé rapide</h2>
        <p>
            Dans le pays <strong><?= htmlspecialchars($paysNom) ?></strong>, nous avons enregistré :
        </p>
        <ul>
            <li><strong><?= $nbBolides ?></strong> bolides</li>
            <li><strong><?= $nbMeteorites ?></strong> météorites</li>
            <li><strong><?= $nbSol ?></strong> éclipses solaires</li>
            <li><strong><?= $nbLun ?></strong> éclipses lunaires</li>
        </ul>
        <p>
            Pour plus d'informations détaillées, veuillez <strong>filtrer vos recherches</strong> sur la carte 
            (par phénomène, période, rareté...).
        </p>
    </section>

<?php else: ?>

    <!-- ============================= -->
    <!--  🔍 Barre de recherche        -->
    <!-- ============================= -->
    <section class="section-block">
        <h2>
            <?php if ($phenomenon === "bolides"): ?>
                🌠 Bolides observés dans ce pays
            <?php elseif ($phenomenon === "meteorites"): ?>
                ☄️ Météorites observées dans ce pays
            <?php elseif ($phenomenon === "solaire"): ?>
                🌞 Éclipses solaires observées dans ce pays
            <?php elseif ($phenomenon === "lunaire"): ?>
                🌕 Éclipses lunaires observées dans ce pays
            <?php endif; ?>
        </h2>

        <input
            type="text"
            id="search-input"
            class="search-input"
            placeholder="🔎 Rechercher dans ces enregistrements (par année, ville, caractéristiques...)"
        >

        <?php if (count($details) === 0): ?>
            <p>Aucun enregistrement ne correspond aux critères sélectionnés.</p>
        <?php else: ?>

            <table class="data-table" id="data-table">
                <thead>
                <tr>
                    <th>ID</th>

                    <?php if ($phenomenon === "bolides"): ?>
                        <th>Vitesse (km/s)</th>
                        <th>Énergie totale (J)</th>
                    <?php elseif ($phenomenon === "meteorites"): ?>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Classe</th>
                        <th>Masse</th>
                        <th>Chute observée</th>
                    <?php elseif ($phenomenon === "solaire"): ?>
                        <th>Gamma</th>
                        <th>Magnitude</th>
                        <th>Largeur du trajet (km)</th>
                        <th>Durée centrale</th>
                    <?php elseif ($phenomenon === "lunaire"): ?>
                        <th>Quincena</th>
                        <th>Durée pénombrale (min)</th>
                        <th>Durée partielle (min)</th>
                        <th>Durée totale (min)</th>
                    <?php endif; ?>

                    <th>Année</th>
                    <th>Mois</th>
                    <th>Ville</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($details as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>

                        <?php if ($phenomenon === "bolides"): ?>
                            <td><?= htmlspecialchars($row['vitesse_kms']) ?></td>
                            <td><?= htmlspecialchars($row['energie_totale_rayonnee_j']) ?></td>

                        <?php elseif ($phenomenon === "meteorites"): ?>
                            <td><?= htmlspecialchars($row['nom']) ?></td>
                            <td><?= htmlspecialchars($row['type_meteorite']) ?></td>
                            <td><?= htmlspecialchars($row['classe_meteo']) ?></td>
                            <td><?= htmlspecialchars($row['masse']) ?></td>
                            <td><?= htmlspecialchars($row['chute_observe']) ?></td>

                        <?php elseif ($phenomenon === "solaire"): ?>
                            <td><?= htmlspecialchars($row['gamma']) ?></td>
                            <td><?= htmlspecialchars($row['eclipse_magnitude']) ?></td>
                            <td><?= htmlspecialchars($row['path_width_km']) ?></td>
                            <td><?= htmlspecialchars($row['central_duration']) ?></td>

                        <?php elseif ($phenomenon === "lunaire"): ?>
                            <td><?= htmlspecialchars($row['quincena_solar_eclipse']) ?></td>
                            <td><?= htmlspecialchars($row['penumbral_eclipse_duration_m']) ?></td>
                            <td><?= htmlspecialchars($row['partial_eclipse_duration_m']) ?></td>
                            <td><?= htmlspecialchars($row['total_eclipse_duration_m']) ?></td>
                        <?php endif; ?>

                        <td><?= htmlspecialchars($row['annee']) ?></td>
                        <td><?= htmlspecialchars($row['mois']) ?></td>
                        <td><?= htmlspecialchars($row['ville']) ?></td>
                        <td><?= htmlspecialchars($row['latitude']) ?></td>
                        <td><?= htmlspecialchars($row['longitude']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </section>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>

<!-- ============================= -->
<!--  🔎 Script de recherche       -->
<!-- ============================= -->
<?php if ($phenomenon !== "all"): ?>
<script>
function setupSearch(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    if (!input || !table) return;

    const rows = table.querySelectorAll("tbody tr");

    input.addEventListener("input", () => {
        const q = input.value.toLowerCase();

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(q) ? "" : "none";
        });
    });
}

setupSearch("search-input", "data-table");

<script>
document.querySelectorAll(".stat-card").forEach(card => {
    card.addEventListener("click", () => {
        const phen = card.dataset.phen;
        loadPhenomena(phen);
    });
});

function loadPhenomena(phen) {
    const detail = document.getElementById("detail-section");
    const title  = document.getElementById("detail-title");
    const tableC = document.getElementById("table-container");

    detail.style.display = "block";
    title.innerHTML = "📁 " + phen.charAt(0).toUpperCase() + phen.slice(1);

    fetch("get_country_data.php?code=<?= $iso ?>&phen=" + phen)
    .then(r => r.text())
    .then(html => {
        tableC.innerHTML = html;
        activateSearch();
    });
}

function activateSearch() {
    const input = document.getElementById("search-input");
    const rows = document.querySelectorAll("tbody tr");
    if (!input) return;

    input.oninput = () => {
        const q = input.value.toLowerCase();
        rows.forEach(r =>
            r.style.display = r.innerText.toLowerCase().includes(q) ? "" : "none"
        );
    };
}
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".stat-card");
    const tableSection = document.querySelector(".section-block");
    const miniResume = document.querySelector(".mini-resume");

    cards.forEach(card => {
        card.addEventListener("click", () => {

            // Lire le phénomène en fonction du texte
            const map = {
                "🌠 Bolides": "bolides",
                "☄️ Météorites": "meteorites",
                "🌞 Éclipses solaires": "solaire",
                "🌕 Éclipses lunaires": "lunaire"
            };

            const phen = map[card.innerText.trim()];
            if (!phen) return;

            const iso = "<?= $iso ?>";

            // Masquer le mini-résumé
            if (miniResume) miniResume.style.display = "none";

            // Indicateur de chargement
            tableSection.innerHTML = "<p style='text-align:center;'>⏳ Chargement...</p>";

            fetch(`get_country_data.php?code=${iso}&phen=${phen}`)
                .then(res => res.text())
                .then(html => {
                    tableSection.innerHTML = `
                        <h2>${card.querySelector("h3").innerHTML}</h2>
                        <input type='text' id='search-input' class='search-input'
                        placeholder='🔎 Rechercher...' />
                        ${html}
                    `;

                    setupSearch("search-input", "data-table");
                })
                .catch(err => {
                    tableSection.innerHTML = "<p>Erreur lors du chargement.</p>";
                    console.error(err);
                });
        });
    });
});
</script>
</script>
<?php endif; ?>

</body>
</html>
