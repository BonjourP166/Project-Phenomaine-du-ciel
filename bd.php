<?php
function getBD() {
    $host = "localhost";              
    $user = "root";
    $pass = "root"; 
    $dbname = "phenomenes_du_ciel";             

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (PDOException $e) {
        die("<p style='color:red;'>Erreur de connexion : " . htmlspecialchars($e->getMessage()) . "</p>");
    }
}
?>