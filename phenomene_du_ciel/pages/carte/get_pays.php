<?php
header("Content-Type: application/json");
require_once "../../bd.php";

if (!isset($_GET["type"])) {
    echo json_encode(["success" => false, "error" => "Type manquant"]);
    exit;
}

$type = $_GET["type"];
$bdd = getBD();

// ===============================
// 🎯 Définition des tables
// ===============================
$tables = [
    "bolides" => [
        "table" => "bolides",
        "join"  => "INNER JOIN localisations l ON b.id_localisation = l.id_localisation",
        "alias" => "b"
    ],
    "meteorites" => [
        "table" => "meteorites",
        "join"  => "INNER JOIN localisations l ON m.id_localisation = l.id_localisation",
        "alias" => "m"
    ],
    "solaire" => [
        "table" => "eclipses_solaire",
        "join"  => "INNER JOIN lieux_observation l ON e.id_lieu = l.id_lieu",
        "alias" => "e"
    ],
    "lunaire" => [
        "table" => "eclipses_lunaires",
        "join"  => "INNER JOIN lieux_observation l ON e.id_lieu = l.id_lieu",
        "alias" => "e"
    ]
];

if (!isset($tables[$type])) {
    echo json_encode(["success" => false, "error" => "Type inconnu"]);
    exit;
}

$config = $tables[$type];

// ===============================
// 📌 Requête dynamique
// ===============================
$sql = "
    SELECT DISTINCT l.pays
    FROM {$config['table']} {$config['alias']}
    {$config['join']}
    WHERE l.pays IS NOT NULL AND l.pays != ''
";

try {
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode([
        "success" => true,
        "countries" => $result
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
?>
