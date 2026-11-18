<?php
session_start();
$_SESSION['canListen'] = true;
?>

<section class="beat-list">
  <h1>Catalogue de prods</h1>

  <div class="filters">
    <a href="beats" class="<?= !$typeSelected ? 'active' : '' ?>">Tous</a>
    <a href="beats&type=Drill" class="<?= $typeSelected === 'Drill' ? 'active' : '' ?>">Drill</a>
    <a href="beats&type=Afro" class="<?= $typeSelected === 'Afro' ? 'active' : '' ?>">Afro</a>
    <a href="beats&type=Trap" class="<?= $typeSelected === 'Trap' ? 'active' : '' ?>">Trap</a>
    <a href="beats&type=Club" class="<?= $typeSelected === 'Club' ? 'active' : '' ?>">Club</a>
  </div>

  <?php foreach ($beats as $beat): ?>
    <div class="beat-card">
      <h2 style="color: #005698;"><?= htmlspecialchars($beat["nom"]) ?></h2>
      <p><?= $beat["bpm"] ?> BPM - Clé : <?= htmlspecialchars($beat["cle"]) ?></p>
      <span class="tag">Type : <?= htmlspecialchars($beat["type"]) ?></span>

      <div class="player">
        <input type="range" class="track" min="0" value="0">
        <span class="elapsed">00:00</span> / <span class="track-time">00:00</span>

        <audio src="serveAudio.php?file=<?= urlencode(basename($beat['chemin'])) ?>" type="audio/mpeg"></audio>

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
  <?php endforeach; ?>
</section>

