<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../bd.php";
$pdo = getBD();

header("Content-Type: application/json; charset=utf-8");

$stats = [];

/**
 * Helper : initialise la structure d’un pays
 */
function ensureCountry(&$stats, $iso3) {
    if (!isset($stats[$iso3])) {
        $stats[$iso3] = [
            "iso3"            => $iso3,
            "total_events"    => 0,
            "phenomena"       => [
                "bolides"    => 0,
                "meteorites" => 0,
                "solaire"    => 0,
                "lunaire"    => 0
            ],
            "rare_events"     => 0,
            "recent_events"   => 0,
            "historic_events" => 0,
            "activity_level"  => "none",
            "is_multi"        => false,
            "has_rare"        => false
        ];
    }
}

/**
 * Ajoute les résultats d’un phénomène à la structure
 */
function addPhenomenonData(&$stats, $rows, $phenKey) {

    foreach ($rows as $row) {
        $iso3 = $row["pays"];
        $total = (int)$row["total_events"];
        $rare  = (int)$row["rare_events"];
        $recent = (int)$row["recent_events"];
        $historic = (int)$row["historic_events"];

        if (!$iso3) continue;

        ensureCountry($stats, $iso3);

        $stats[$iso3]["total_events"] += $total;
        $stats[$iso3]["phenomena"][$phenKey] += $total;
        $stats[$iso3]["rare_events"] += $rare;
        $stats[$iso3]["recent_events"] += $recent;
        $stats[$iso3]["historic_events"] += $historic;
    }
}

/**
 * 1️⃣ Bolides
 * Rareté (exemple) : énergie très élevée OU vitesse très élevée
 */
$sql = "
    SELECT 
        l.pays,
        COUNT(*) AS total_events,
        SUM(
            CASE 
                WHEN (t.energie_totale_rayonnee_j IS NOT NULL AND t.energie_totale_rayonnee_j >= 1e11)
                  OR (t.vitesse_kms IS NOT NULL AND t.vitesse_kms >= 40)
                THEN 1 ELSE 0 
            END
        ) AS rare_events,
        SUM(CASE WHEN d.annee >= 2000 THEN 1 ELSE 0 END) AS recent_events,
        SUM(CASE WHEN d.annee < 2000 THEN 1 ELSE 0 END) AS historic_events
    FROM bolides t
    JOIN localisations l ON t.id_localisation = l.id_localisation
    JOIN dates d ON t.id_date = d.id_date
    GROUP BY l.pays
";
$stmt = $pdo->query($sql);
addPhenomenonData($stats, $stmt->fetchAll(PDO::FETCH_ASSOC), "bolides");

/**
 * 2️⃣ Météorites
 * Rareté (exemple) : masse >= 100 000 (à adapter à ton unité réelle)
 */
$sql = "
    SELECT 
        l.pays,
        COUNT(*) AS total_events,
        SUM(CASE WHEN t.masse IS NOT NULL AND t.masse >= 100000 THEN 1 ELSE 0 END) AS rare_events,
        SUM(CASE WHEN d.annee >= 2000 THEN 1 ELSE 0 END) AS recent_events,
        SUM(CASE WHEN d.annee < 2000 THEN 1 ELSE 0 END) AS historic_events
    FROM meteorites t
    JOIN localisations l ON t.id_localisation = l.id_localisation
    JOIN dates d ON t.id_date = d.id_date
    GROUP BY l.pays
";
$stmt = $pdo->query($sql);
addPhenomenonData($stats, $stmt->fetchAll(PDO::FETCH_ASSOC), "meteorites");

/**
 * 3️⃣ Éclipses solaires
 * Rareté (exemple) : magnitude >= 0.99 (éclipses quasiment totales)
 */
$sql = "
    SELECT 
        l.pays,
        COUNT(*) AS total_events,
        SUM(CASE WHEN t.eclipse_magnitude IS NOT NULL AND t.eclipse_magnitude >= 0.99 THEN 1 ELSE 0 END) AS rare_events,
        SUM(CASE WHEN d.annee >= 2000 THEN 1 ELSE 0 END) AS recent_events,
        SUM(CASE WHEN d.annee < 2000 THEN 1 ELSE 0 END) AS historic_events
    FROM eclipses_solaires t
    JOIN localisations l ON t.id_localisation = l.id_localisation
    JOIN dates d ON t.id_date = d.id_date
    GROUP BY l.pays
";
$stmt = $pdo->query($sql);
addPhenomenonData($stats, $stmt->fetchAll(PDO::FETCH_ASSOC), "solaire");

/**
 * 4️⃣ Éclipses lunaires
 * Rareté (exemple) : durée totale >= 60 minutes
 */
$sql = "
    SELECT 
        l.pays,
        COUNT(*) AS total_events,
        SUM(
            CASE 
                WHEN t.total_eclipse_duration_m IS NOT NULL 
                     AND t.total_eclipse_duration_m >= 60 
                THEN 1 ELSE 0 
            END
        ) AS rare_events,
        SUM(CASE WHEN d.annee >= 2000 THEN 1 ELSE 0 END) AS recent_events,
        SUM(CASE WHEN d.annee < 2000 THEN 1 ELSE 0 END) AS historic_events
    FROM eclipses_lunaires t
    JOIN localisations l ON t.id_localisation = l.id_localisation
    JOIN dates d ON t.id_date = d.id_date
    GROUP BY l.pays
";
$stmt = $pdo->query($sql);
addPhenomenonData($stats, $stmt->fetchAll(PDO::FETCH_ASSOC), "lunaire");


/**
 * 5️⃣ Post-traitement : activité, multi-phénomènes, rareté booléenne
 */
foreach ($stats as $iso3 => &$country) {

    $total = $country["total_events"];

    // Activité : à ajuster selon ton dataset
    if ($total === 0) {
        $country["activity_level"] = "none";
    } elseif ($total <= 5) {
        $country["activity_level"] = "low";
    } elseif ($total <= 20) {
        $country["activity_level"] = "medium";
    } elseif ($total <= 50) {
        $country["activity_level"] = "high";
    } else {
        $country["activity_level"] = "very_high";
    }

    // Multi-phénomènes : au moins 2 types avec >= 1 évènement
    $nonZeroPhen = 0;
    foreach ($country["phenomena"] as $k => $v) {
        if ($v > 0) $nonZeroPhen++;
    }
    $country["is_multi"] = ($nonZeroPhen >= 2);

    // Rareté booléenne
    $country["has_rare"] = ($country["rare_events"] > 0);
}

// Sortie JSON
echo json_encode(array_values($stats), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
