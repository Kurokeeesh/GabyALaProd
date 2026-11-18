<?php
session_start();

if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'gabyalaprod.alwaysdata.net')) {
    http_response_code(403);
    http_response_code(403);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accès interdit</title>
    <style>
        body {
            background-color: #111;
            color: #f44336;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        h1 {
            font-size: 4em;
            margin-bottom: 0.2em;
        }
        p {
            font-size: 1.5em;
        }
        .emoji {
            font-size: 5em;
            margin-bottom: 0.2em;
        }
    </style>
</head>
<body>
    <div class="emoji">🚫</div>
    <h1>403 - Accès interdit</h1>
    <p>Vous n'avez pas l'autorisation d'accéder directement à ce fichier.</p>
</body>
</html>
<?php
exit;
}



if (!isset($_GET['file'])) {
    http_response_code(400);
    exit("Fichier non spécifié.");
}

$filename = basename($_GET['file']);
$filepath = __DIR__ . '/private/prod/' . $filename;

if (!file_exists($filepath)) {
    http_response_code(404);
    exit("Fichier introuvable.");
}

$size = filesize($filepath);
$range = 0;

header("Content-Type: audio/mpeg");
header("Accept-Ranges: bytes");

if (isset($_SERVER['HTTP_RANGE'])) {
    // Lecture partielle demandée
    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    $range = explode('-', $range);
    $start = intval($range[0]);
    $end = ($range[1] !== "") ? intval($range[1]) : $size - 1;

    header("HTTP/1.1 206 Partial Content");
    header("Content-Length: " . ($end - $start + 1));
    header("Content-Range: bytes $start-$end/$size");

    $fp = fopen($filepath, 'rb');
    fseek($fp, $start);
    while (!feof($fp) && ftell($fp) <= $end) {
        echo fread($fp, 1024 * 8);
        flush();
    }
    fclose($fp);
} else {
    // Lecture complète
    header("Content-Length: " . $size);
    readfile($filepath);
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");


exit;
