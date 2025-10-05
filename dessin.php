<?php
include __DIR__ . "/data/dessins.php";

$slug = isset($_GET['slug']) ? strtolower(trim($_GET['slug'])) : '';
$index = array_search($slug, array_column($DESSINS, 'slug'));
$work = ($index !== false) ? $DESSINS[$index] : null;

if (!$work) {
  http_response_code(404);
  $page_title = "Dessin introuvable — Atam Rasho";
  $page_description = "Ce dessin n'existe pas ou a été déplacé.";
  include __DIR__ . "/inc/head.php";
  echo "<main class='page-header section container'><h1>Dessin introuvable</h1><p><a class='link' href='" . url('dessins') . "'>&larr; Retour aux dessins</a></p></main>";
  include __DIR__ . "/inc/footer.php"; exit;
}

$page_title = $work['title'] . " — Dessins — Atam Rasho";
$page_description = $work['desc'] ?? ("Détails du dessin « " . $work['title'] . " ».");
$page_og_image = $work['image'];
include __DIR__ . "/inc/head.php";

$prev = $DESSINS[$index-1] ?? null;
$next = $DESSINS[$index+1] ?? null;

/* Chemins images */
$baseName       = pathinfo($work['image'], PATHINFO_FILENAME);
$thumb1200_jpg  = url('assets/thumbs/1200/' . $baseName . '.jpg');
$thumb1200_webp = url('assets/thumbs/1200/' . $baseName . '.webp');
$original       = url($work['image']);
?>

<main class="container py-4">
  <nav class="mb-4">
    <a href="<?= url('dessins') ?>" class="link-primary">&larr; Retour aux dessins</a>
  </nav>

  <article class="row g-5 align-items-start">
    <!-- IMAGE À GAUCHE -->
    <div class="col-12 col-lg-7">
      <a href="<?= $original ?>" class="glightbox d-block shadow-sm rounded overflow-hidden" data-gallery="work" data-title="<?= htmlspecialchars($work['title']) ?>">
        <picture>
          <source type="image/webp" srcset="<?= $thumb1200_webp ?>">
          <img
            src="<?= $thumb1200_jpg ?>"
            alt="<?= htmlspecialchars($work['alt']) ?>"
            class="img-fluid w-100"
            loading="lazy"
            decoding="async"
            style="display:block;object-fit:cover"
          >
        </picture>
      </a>
      <small class="text-muted d-block mt-2">Cliquez sur l’image pour l’agrandir</small>
    </div>

    <!-- INFOS À DROITE -->
    <div class="col-12 col-lg-5">
      <h1 class="mb-1"><?= htmlspecialchars($work['title']) ?></h1>
      <p class="text-muted mb-3">Atam Rasho</p>

      <ul class="list-unstyled lh-lg small text-body-secondary mb-4">
        <?php if (!empty($work['year'])): ?><li><?= htmlspecialchars($work['year']) ?></li><?php endif; ?>
        <?php if (!empty($work['medium'])): ?><li><?= htmlspecialchars($work['medium']) ?></li><?php endif; ?>
        <?php if (!empty($work['size'])): ?><li><?= htmlspecialchars($work['size']) ?></li><?php endif; ?>
        <?php if (!empty($work['tirage'])): ?><li><?= htmlspecialchars($work['tirage']) ?></li><?php endif; ?>
        <?php if (!empty($work['editeur'])): ?><li class="fw-semibold"><?= htmlspecialchars($work['editeur']) ?></li><?php endif; ?>
        <li class="text-body-secondary">Prix hors taxes</li>
      </ul>

      <?php if (isset($work['prix'])): ?>
        <p class="fs-4 fw-semibold text-danger mb-4"><?= number_format($work['prix'], 2, ',', ' ') ?> €</p>
      <?php endif; ?>

      <form method="post" action="#">
        <div class="mb-3" style="max-width: 180px;">
          <select class="form-select" name="quantite">
            <?php for ($i = 1; $i <= 10; $i++): ?>
              <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-outline-danger w-100">Ajouter au panier</button>
      </form>

      <?php if (!empty($work['desc'])): ?>
        <p class="work-desc mt-4"><?= nl2br(htmlspecialchars($work['desc'])) ?></p>
      <?php endif; ?>

      <div class="d-flex justify-content-between mt-5 pt-3 border-top">
        <?php if ($prev): ?>
          <a class="link-primary small" href="<?= url('dessin/' . urlencode($prev['slug'])) ?>">← <?= htmlspecialchars($prev['title']) ?></a>
        <?php else: ?><span></span><?php endif; ?>
        <?php if ($next): ?>
          <a class="link-primary small" href="<?= url('dessin/' . urlencode($next['slug'])) ?>"><?= htmlspecialchars($next['title']) ?> →</a>
        <?php endif; ?>
      </div>
    </div>
  </article>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
