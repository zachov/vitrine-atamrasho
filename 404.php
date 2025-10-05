<?php
// 404.php
http_response_code(404);
$page_title = "Page introuvable — Atam Rasho";
$page_description = "La page que vous recherchez n’existe pas ou a été déplacée.";
include __DIR__ . "/inc/head.php";
?>

<main class="container section text-center">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      <div class="card border-0 shadow-sm p-4 p-md-5">
        <h1 class="mb-2">Page introuvable</h1>
        <p class="text-body-secondary mb-4">
          La page demandée n’existe pas ou a été déplacée.
          Vous pouvez retourner à l’accueil ou explorer les œuvres.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="<?= url('') ?>" class="btn btn-outline-secondary">Accueil</a>
          <a href="<?= url('dessins') ?>" class="btn btn-brand">Voir les œuvres</a>
          <a href="<?= url('cinema') ?>" class="btn btn-outline-secondary">Cinéma d’animation</a>
        </div>

        <hr class="my-4">

        <div class="text-start small text-muted">
          <p class="mb-1"><strong>URL demandée :</strong> <?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') ?></p>
          <p class="mb-0"><strong>Référence :</strong> 404 / <?= date('Y-m-d H:i:s') ?></p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
