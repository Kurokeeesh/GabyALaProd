<section class="admin">
  <h1>🎛️ Espace Admin - Gestion des prods</h1>

  <div class="admin-section">
    <h2>➕ Ajouter une prod</h2>
    <form method="POST" action="index.php?page=addProd" enctype="multipart/form-data" class="admin-form">
      <input type="text" name="nom" placeholder="Nom de la prod" required>
      <input type="text" name="bpm" placeholder="BPM" required>
      <input type="text" name="cle" placeholder="Clé (ex : Am)" required>
      <input type="text" name="type" placeholder="Type (Drill, Afro...)" required>
      <input type="file" name="chemin" accept=".mp3,.wav" required>
      <button type="submit">Ajouter</button>
    </form>
  </div>

  <div class="admin-section">
    <h2>🎵 Prods existantes</h2>
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>BPM</th>
          <th>Clé</th>
          <th>Type</th>
          <th>Fichier</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($beats as $beat): ?>
          <tr>
            <td><?= $beat["id"] ?></td>
            <td><?= $beat["nom"] ?></td>
            <td><?= $beat["bpm"] ?></td>
            <td><?= $beat["cle"] ?></td>
            <td><?= $beat["type"] ?></td>
            <td><?= basename($beat["chemin"]) ?></td>
            <td>
              <a href="index.php?page=editProd&id=<?= $beat["id"] ?>" class="btn-edit">✏️</a>
              <a href="index.php?page=deleteProd&id=<?= $beat["id"] ?>" class="btn-delete" onclick="return confirm('Supprimer cette prod ?')">❌</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
