<?php
require 'vendor/autoload.php';
// Funció per registrar els accessos
function logAcces($url, $usuari = null) {
    $uri = getenv('MONGODB_URI');
    if (!$uri && isset($_SERVER['MONGODB_URI'])) {
        $uri = $_SERVER['MONGODB_URI'];
    }
    
    if (!$uri) {
        $uri = "mongodb://mongo:27017";
    }
// Registrar l'acces
    try {
        $client = new MongoDB\Client($uri);
        $collection = $client->gi3p_logs->accessos;
        
        $collection->insertOne([
            'url' => $url,
            'timestamp' => new MongoDB\BSON\UTCDateTime(time() * 1000),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);
        // Opcionalment, també podriem registrar l'usuari pero encara no tenim aquest sistema  
    } catch (Exception $e) {
        error_log("MongoDB error: " . $e->getMessage());
    }
}
?>