<?php

session_start();

include('bd.php');
$bdd = getBD();

$requete = $bdd->prepare("
    SELECT 
        el.*, 
        p.description AS description, 
        d.année AS année,
        d.mois AS mois, 
        l.Coordonnées AS cd,
        t.type as type,
        t.description as des
    FROM eclipse_lunaire el
    LEFT JOIN phenomenes p ON el.id_phénomene = p.id_phénomene
    LEFT JOIN date d ON el.id_date = d.id_date
    LEFT JOIN localisation l ON el.id_localisation = l.id_local
    LEFT JOIN type_eclipse t ON el.type_eclipse = t.id_eclipse
    ORDER BY el.id_eclipse_lunaire ASC
");
$requete->execute();

$elunaire = $requete->fetchAll(PDO::FETCH_ASSOC);

$description = $elunaire[0]['description'] ?? '';

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Éclipses lunaires</title>

    </head>

    <body>
        <h1>Détails des éclipses lunaires :</h1>

        <p>
            <?php echo htmlspecialchars($description); ?>
        </p>
    
        <br>
    

        <table border="1" cellpadding="5">
            <tr>
                <th>Identifiant</th>
                <th>Éclipse solaire de la quinzaine</th>
                <th>Durée de l'éclipse pénombrale (min)</th>
                <th>Durée de l'éclipse partielle (min)</th>
                <th>Durée de l'éclipse totale (min)</th>
                <th>Type</th>
                <th>Description</th>
                <th>Année</th>
                <th>Mois</th>
                <th>Localisation</th>

            </tr>
        


             <?php foreach ($elunaire as $l): ?>

            <tr>
                <td><?= htmlspecialchars($l['id_eclipse_lunaire']) ?></td>
                <td><?= htmlspecialchars($l['Quincena_Solar_Eclipse']) ?></td>
                <td><?= htmlspecialchars($l['Penumbral_Eclipse_Duration_m']) ?></td>
                <td><?= htmlspecialchars($l['Partial_Eclipse_Duration_m']) ?></td>
                <td><?= htmlspecialchars($l['Total_Eclipse_Duration_m']) ?></td>
                <td><?= htmlspecialchars($l['type'] ?? '') ?></td>
                <td><?= htmlspecialchars($l['des'] ?? '') ?></td>
                <td><?= htmlspecialchars($l['année'] ?? '') ?></td>
                <td><?= htmlspecialchars($l['mois'] ?? '') ?></td>
                <td><?= htmlspecialchars($l['cd'] ?? '') ?></td>
        </tr>

        <?php endforeach; ?>
        
        </table>


    </body>
</html>

