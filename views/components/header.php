<header>
  <div class="logo">Gaby à la prod</div>
  <nav>
    <a href="home">Accueil</a>
    <a href="beats">Beats</a>
    <a href="about">À propos</a>
    <a href="contact">Contact</a>
    <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true): ?>
      <a href="admin">Admin</a>
      <a href="logout" style="color: #FFD700;">Déconnexion</a>
    <?php endif; ?>
  </nav>
</header>
<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true): ?>
  <div class="admin-welcome">
    👋 Bienvenue <strong>Le boss</strong>
  </div>
<?php endif; ?>

