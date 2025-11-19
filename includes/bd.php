<?php
function getBD() {
    $host = "localhost";
    $port = "3306";              // <- ton port MySQL
    $dbname = "phenomenes_du_ciel";
    $user = "root";
    $pass = "root";              // si ton phpMyAdmin demande bien 'root'

    try {
        $bdd = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd;
    } catch (PDOException $e) {
        die("<p style='color:red;'>Erreur de connexion : " . ($e->getMessage()) . "</p>");
    }
}
?>
