<?php
// Si aucune session n'est encore démarrée, on la démarre
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    // 1. Empêche l’accès JavaScript aux cookies
    ini_set('session.cookie_httponly', 1);

    // 2. Empêche les envois cross-site (CSRF basique)
    ini_set('session.cookie_samesite', 'Strict');

    // 3. Si tu es en HTTPS, active aussi ceci :
    ini_set('session.cookie_secure', 0); // mets 1 si HTTPS
}
?>
