<section class="admin">
  <h1>✏️ Modifier une prod</h1>

  <form method="POST" action="index.php?page=updateProd" enctype="multipart/form-data" class="admin-form">
    <input type="hidden" name="id" value="<?= $prod["id"] ?>">
    <input type="hidden" name="ancien_chemin" value="<?= $prod["chemin"] ?>">

    <input type="text" name="nom" value="<?= htmlspecialchars($prod["nom"]) ?>" placeholder="Nom" required>
    <input type="text" name="bpm" value="<?= htmlspecialchars($prod["bpm"]) ?>" placeholder="BPM" required>
    <input type="text" name="cle" value="<?= htmlspecialchars($prod["cle"]) ?>" placeholder="Clé" required>
    <input type="text" name="type" value="<?= htmlspecialchars($prod["type"]) ?>" placeholder="Type" required>

    <label for="chemin" style="width: 100%; margin-top: 1rem; text-align: left; color: #005698;">
      🎧 Fichier actuel : <?= basename($prod["chemin"]) ?><br>
      Remplacer le fichier (optionnel) :
    </label>
    <input type="file" name="chemin" accept=".mp3,.wav">

    <button type="submit">💾 Enregistrer les modifications</button>
  </form>
</section>
