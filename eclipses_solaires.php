<?php

session_start();

include('bd.php');
$bdd = getBD();


$requete = $bdd->prepare("
    SELECT 
        es.*, 
        p.description AS description, 
        d.année AS année,
        d.mois AS mois, 
        l.Coordonnées AS cd,
        t.type as type,
        t.description as des
    FROM eclipse_solaire es
    LEFT JOIN phenomenes p ON es.id_phénomene = p.id_phénomene
    LEFT JOIN date d ON es.id_date = d.id_date
    LEFT JOIN localisation l ON es.id_localisation = l.id_local
    LEFT JOIN type_eclipse t ON es.type_eclipse = t.id_eclipse
    ORDER BY es.id_eclipse_solaire ASC
");
$requete->execute();

$esolaire = $requete->fetchAll(PDO::FETCH_ASSOC);

$description = $esolaire[0]['description'] ?? '';

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Éclipses solaires</title>

    </head>

    <body>
        <h1>Détails des éclipses solaires :</h1>

        <p>
            <?php echo htmlspecialchars($description); ?>
        </p>

        <br>
    

        <table border="1" cellpadding="5">
            <tr>
                <th>Identifiant</th>
                <th>Gamma</th>
                <th>Magnitude de l'éclipse</th>
                <th>Largeur de la trajectoire (km)</th>
                <th>Durée centrale</th>
                <th>Type</th>
                <th>Description</th>
                <th>Année</th>
                <th>Mois</th>
                <th>Localisation</th>
            </tr>



             <?php foreach ($esolaire as $s): ?>

            <tr>
                <td><?= htmlspecialchars($s['id_eclipse_solaire']) ?></td>
                <td><?= htmlspecialchars($s['Gamma']) ?></td>
                <td><?= htmlspecialchars($s['Eclipse_Magnitude']) ?></td>
                <td><?= htmlspecialchars($s['Path_Width_km']) ?></td>
                <td><?= htmlspecialchars($s['Central_Duration']) ?></td>
                <td><?= htmlspecialchars($s['type'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['des'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['année'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['mois'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['cd'] ?? '') ?></td>
        </tr>

        <?php endforeach; ?>
        
        </table>


    </body>
</html>

