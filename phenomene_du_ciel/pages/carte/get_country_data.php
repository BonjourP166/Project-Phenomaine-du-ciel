<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['code']) || !isset($_GET['phen'])) {
    die("<p>Requête invalide.</p>");
}

$iso  = $_GET['code'];
$phen = $_GET['phen'];

require_once "../../bd.php";
$bdd = getBD();

// Construction requête selon type
switch ($phen) {

    case "bolides":
        $sql = "
            SELECT 
                t.vitesse_kms,
                t.energie_totale_rayonnee_j,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            FROM bolides t
            JOIN localisations l ON t.id_localisation = l.id_localisation
            JOIN dates d ON t.id_date = d.id_date
            WHERE l.pays = ?
            ORDER BY d.annee DESC, d.mois DESC
        ";
        $headers = [
            "Vitesse (km/s)",
            "Énergie (J)",
            "Année",
            "Mois",
            "Ville",
            "Lat",
            "Long"
        ];
        break;

    case "meteorites":
        $sql = "
            SELECT 
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
            FROM meteorites t
            JOIN localisations l ON t.id_localisation = l.id_localisation
            JOIN dates d ON t.id_date = d.id_date
            WHERE l.pays = ?
            ORDER BY d.annee DESC, d.mois DESC
        ";
        $headers = [
            "Nom",
            "Type",
            "Classe",
            "Masse (g)",
            "Chute observée",
            "Année",
            "Mois",
            "Ville",
            "Lat",
            "Long"
        ];
        break;

    case "solaire":
        $sql = "
            SELECT 
                t.gamma,
                t.eclipse_magnitude,
                t.path_width_km,
                t.central_duration,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            FROM eclipses_solaires t
            JOIN localisations l ON t.id_localisation = l.id_localisation
            JOIN dates d ON t.id_date = d.id_date
            WHERE l.pays = ?
            ORDER BY d.annee DESC, d.mois DESC
        ";
        $headers = [
            "Gamma",
            "Magnitude",
            "Largeur (km)",
            "Durée centrale",
            "Année",
            "Mois",
            "Ville",
            "Lat",
            "Long"
        ];
        break;

    case "lunaire":
        $sql = "
            SELECT 
                t.quincena_solar_eclipse,
                t.penumbral_eclipse_duration_m,
                t.partial_eclipse_duration_m,
                t.total_eclipse_duration_m,
                d.annee,
                d.mois,
                l.ville,
                l.latitude,
                l.longitude
            FROM eclipses_lunaires t
            JOIN localisations l ON t.id_localisation = l.id_localisation
            JOIN dates d ON t.id_date = d.id_date
            WHERE l.pays = ?
            ORDER BY d.annee DESC, d.mois DESC
        ";
        $headers = [
            "Quincena",
            "Durée pénombrale (min)",
            "Durée partielle (min)",
            "Durée totale (min)",
            "Année",
            "Mois",
            "Ville",
            "Lat",
            "Long"
        ];
        break;

    default:
        die("<p>Phénomène non reconnu.</p>");
}

$stmt = $bdd->prepare($sql);
$stmt->execute([$iso]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) === 0) {
    die("<p>Aucun enregistrement trouvé pour ce phénomène.</p>");
}

// Génération du tableau HTML
echo "<table class='data-table'>";
echo "<thead><tr>";
foreach ($headers as $h) echo "<th>$h</th>";
echo "</tr></thead><tbody>";

foreach ($rows as $row) {
    echo "<tr>";
    foreach ($row as $val) {
        echo "<td>" . htmlspecialchars($val) . "</td>";
    }
    echo "</tr>";
}
echo "</tbody></table>";
