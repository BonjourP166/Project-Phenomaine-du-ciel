<?php
echo "<pre>";
if (function_exists('curl_version')) {
    echo "✅ cURL est activé !\n";
    print_r(curl_version());
} else {
    echo "❌ cURL n'est pas activé !\n";
}
?>
