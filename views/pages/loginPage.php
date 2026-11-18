<section class="admin">
  <h1>🔐 Connexion admin</h1>

  <?php if (!empty($message)): ?>
    <p style="color: red;"><?= $message ?></p>
  <?php endif; ?>

  <form method="POST" action="index.php?page=login" class="admin-form">
    <input type="text" name="user" placeholder="Identifiant" required>
    <input type="password" name="pass" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
  </form>
</section>
