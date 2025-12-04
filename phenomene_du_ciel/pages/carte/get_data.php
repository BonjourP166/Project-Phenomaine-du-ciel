<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../bd.php";
$pdo = getBD();

header("Content-Type: application/json; charset=utf-8");

$phenomenon = $_GET['phenomenon'] ?? 'all';
$intensity  = $_GET['intensity'] ?? 'all';
$continent  = $_GET['continent'] ?? 'all';

/* ============================================================
   Fonction générique de récupération
   ============================================================ */
function fetchData($pdo, $table, $fields)
{
    $sql = "
        SELECT 
            p.nom AS type,
            l.latitude,
            l.longitude,
            l.pays,
            l.ville,
            d.annee,
            d.mois,
            $fields
        FROM $table AS t
        JOIN localisations AS l ON t.id_localisation = l.id_localisation
        JOIN dates AS d ON t.id_date = d.id_date
        JOIN phenomenes AS p ON t.id_phenomene = p.id_phenomene
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ============================================================
   Switch sur le phénomène
   ============================================================ */

switch ($phenomenon) {

    case "bolides":
        $result = fetchData(
            $pdo,
            "bolides",
            "t.vitesse_kms,
             t.energie_totale_rayonnee_j"
        );
        break;

    case "meteorites":
        $result = fetchData(
            $pdo,
            "meteorites",
            "t.nom AS nom_meteo,
             t.type_meteorite,
             t.classe_meteo,
             t.masse,
             t.chute_observe"
        );
        break;

    case "solaire":
        $result = fetchData(
            $pdo,
            "eclipses_solaires",
            "t.eclipse_magnitude,
             t.gamma,
             t.path_width_km,
             t.central_duration"
        );
        break;

    case "lunaire":
        // ✔️ Version CORRECTE avec les bons noms de colonnes
        $result = fetchData(
            $pdo,
            "eclipses_lunaires",
            "t.quincena_solar_eclipse,
             t.penumbral_eclipse_duration_m AS penumbral,
             t.partial_eclipse_duration_m AS partial,
             t.total_eclipse_duration_m AS total_dur"
        );
        break;

    case "all":
    default:
        $result = array_merge(
            fetchData($pdo, "bolides",
                "t.vitesse_kms, t.energie_totale_rayonnee_j"),
            fetchData($pdo, "meteorites",
                "t.nom AS nom_meteo, t.type_meteorite, t.classe_meteo, t.masse, t.chute_observe"),
            fetchData($pdo, "eclipses_solaires",
                "t.eclipse_magnitude, t.gamma, t.path_width_km, t.central_duration"),
            fetchData($pdo, "eclipses_lunaires",
                "t.quincena_solar_eclipse,
                 t.penumbral_eclipse_duration_m AS penumbral,
                 t.partial_eclipse_duration_m AS partial,
                 t.total_eclipse_duration_m AS total_dur")
        );
        break;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
