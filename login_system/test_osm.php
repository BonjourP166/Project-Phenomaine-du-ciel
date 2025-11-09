<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ville = "Montpellier";

$url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($ville);
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => "TestPhenomeneDuCiel/1.0 (contact@tonsite.com)",
    CURLOPT_TIMEOUT => 10
]);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

echo "<pre>";
echo "HTTP code : $http_code\n";
echo "Erreur cURL : $curl_error\n";
echo "Réponse brute :\n";
var_dump($response);
echo "</pre>";
