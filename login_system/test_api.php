<?php
$ville = "Montpellier";
$url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($ville);
$data = @file_get_contents($url);
var_dump($data);