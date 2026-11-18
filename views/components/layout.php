<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=<?=$description?>>
    <link rel="icon" type="image/png" href="public/img/Logo.png">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/global.css">
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/beats.css">
    <link rel="stylesheet" href="public/css/about.css">
    <link rel="stylesheet" href="public/css/contact.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <link rel="stylesheet" href="public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="public/js/lecteur.js" defer></script>
    <title><?= $title ?></title>
</head>
<body>
  <div class="page-container">
    <?php require_once("header.php"); ?>

    <main>
      <?= $content ?>
    </main>

    <?php require_once("footer.php"); ?>
  </div>

  <div id="popup-warning" class="popup-overlay">
  <div class="popup-box">
    <h2>⚠️ Avertissement</h2>
    <p>
      Les beats présents sur ce site sont strictement interdits au téléchargement 
      et à toute utilisation professionnelle sans autorisation explicite.
    </p>
    <button id="popup-close">J'ai compris</button>
  </div>
</div>

<script src="public/js/pop-up.js" defer></script>

</body>
</html>