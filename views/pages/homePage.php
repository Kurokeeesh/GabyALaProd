<?php
session_start();
$_SESSION['canListen'] = true;
?>

<section class="hero">
  <h1 class="hero-title">🎧 Bienvenue sur le site de Gaby à la prod</h1>

  <form method="GET" action="index.php" class="search-bar">
    <input type="hidden" name="page" value="beats">
    <input type="text" name="q" placeholder="Rechercher par type, nom, cle..." required>
    <button type="submit">🔍</button>
  </form>

  <h2 class="last-prod-title">Dernière prod ajoutée</h2>

  <div class="beat-card">
    <h2>🔥 <?= htmlspecialchars($lastBeat["nom"]) ?></h2>
    <p>
      <?= $lastBeat["bpm"] ?> BPM - Clé : <?= htmlspecialchars($lastBeat["cle"]) ?> - Type : <?= htmlspecialchars($lastBeat["type"]) ?>
    </p>
    <div class="player">
        <input type="range" class="track" min="0" value="0">
        <span class="elapsed">00:00</span> / <span class="track-time">00:00</span>

        <audio src="serveAudio.php?file=<?= urlencode(basename($lastBeat['chemin'])) ?>" type="audio/mpeg"></audio>

        <div class="controls">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play-fill play-button" viewBox="0 0 16 16">
          <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pause-fill pause-button hidden" viewBox="0 0 16 16">
          <path d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5m5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5"/>
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-stop-fill stop-button" viewBox="0 0 16 16">
          <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5"/>
          </svg>
        </div>

        <input type="range" class="volume" min="0" max="1" value="1" step="0.01">
        <span class="volume-value">100%</span>
    </div>
  </div>
</section>

