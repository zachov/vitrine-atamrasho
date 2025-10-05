<?php
// inc/header.php
// Menu principal + responsive (Bootstrap Offcanvas)

$current_path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

// Permet de détecter la page active (par rapport à l'URL actuelle)
function is_active(string $link, string $current_path): bool {
    // Ex : /Vitrine-AtamRasho/dessins doit activer /dessins
    return rtrim($link, '/') === rtrim($current_path, '/');
}
?>
<header class="border-bottom">
  <nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= url() ?>">Atam Rasho</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainMenu"
              aria-controls="mainMenu" aria-label="Ouvrir le menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="mainMenu" aria-labelledby="mainMenuLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="mainMenuLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php foreach ($nav_items as $link => $label): ?>
            <li class="nav-item">
              <a class="nav-link <?= is_active($link, $current_path) ? 'active fw-semibold' : '' ?>"
                href="<?= htmlspecialchars($link) ?>">
                <?= htmlspecialchars($label) ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>

        </div>
      </div>
    </div>
  </nav>
</header>
