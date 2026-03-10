<?php
// Activer la bufferisation pour pouvoir faire une redirection interne
ob_start();

// Récupérer le contenu du site cible
$url = "https://cwoste-sba.dz/tree/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36");

$content = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    // Remplacer les URLs absolues dans le contenu pour éviter les liens directs
    $content = str_replace('https://cwoste-sba.dz/tree/', '/', $content);
    $content = str_replace('href="', 'href="https://cwoste-sba.dz/tree/', $content);
    $content = str_replace('src="', 'src="https://cwoste-sba.dz/tree/', $content);
    
    echo $content;
} else {
    // Redirection en cas d'erreur
    header("Location: https://cwoste-sba.dz/tree/");
    exit;
}
?>