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
$page_description = $work['medium'] . " — " . ($work['size'] ?? "");
$page_og_image = $work['image'];
include __DIR__ . "/inc/head.php";

$prev = $DESSINS[$index-1] ?? null;
$next = $DESSINS[$index+1] ?? null;

/* Chemins images */
$baseName       = pathinfo($work['image'], PATHINFO_FILENAME);
$thumb1200_jpg  = url('assets/thumbs/1200/' . $baseName . '.jpg');
$thumb1200_webp = url('assets/thumbs/1200/' . $baseName . '.webp');
$original       = url($work['image']);

/* Utilitaires prix */
function euro(?float $n): string {
  return number_format((float)$n, 2, ',', ' ') . " €";
}
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
        <?php if (!empty($work['year'])): ?>
          <li><strong>Année :</strong> <?= htmlspecialchars($work['year']) ?></li>
        <?php endif; ?>
        <?php if (!empty($work['medium'])): ?>
          <li><strong>Technique :</strong> <?= htmlspecialchars($work['medium']) ?></li>
        <?php endif; ?>
        <?php if (!empty($work['size'])): ?>
          <li><strong>Dimensions :</strong> <?= htmlspecialchars($work['size']) ?></li>
        <?php endif; ?>
      </ul>

      <!-- Prix original (si disponible) -->
      <?php if (isset($work['prix_ttc'])): ?>
        <div class="mb-4">
          <div class="text-muted small">Prix TTC (œuvre originale)</div>
          <div class="fs-4 fw-semibold text-danger"><?= euro((float)$work['prix_ttc']) ?></div>
        </div>
      <?php elseif (isset($work['prix_ht'])): ?>
        <div class="mb-4">
          <div class="text-muted small">Prix hors taxes (œuvre originale)</div>
          <div class="fs-4 fw-semibold text-danger"><?= euro((float)$work['prix_ht']) ?></div>
        </div>
      <?php endif; ?>

      <!-- Option Lithographie IDEM PARIS -->
      <?php if (!empty($work['litho_prix_ttc'])): ?>
        <div class="border rounded p-3 bg-light-subtle mb-4">
          <div class="fw-semibold mb-1">Lithographie</div>
          <div class="small text-muted mb-1">
            <?= htmlspecialchars($work['editeur'] ?? 'Imprimée chez IDEM PARIS') ?>
          </div>
          <div class="fw-semibold"><?= euro((float)$work['litho_prix_ttc']) ?> TTC</div>
        </div>
      <?php endif; ?>

      <?php if (!empty($work['desc'])): ?>
        <p class="work-desc mt-3"><?= nl2br(htmlspecialchars($work['desc'])) ?></p>
      <?php endif; ?>

      <!-- Navigation entre dessins -->
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

  <!-- JSON-LD Artwork (SEO) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "VisualArtwork",
    "name": <?= json_encode($work['title']) ?>,
    "creator": { "@type": "Person", "name": "Atam Rasho" },
    "artMedium": <?= json_encode($work['medium'] ?? "") ?>,
    "width": <?= json_encode($work['size'] ?? "") ?>,
    "dateCreated": "<?= intval($work['year']) ?>",
    "image": <?= json_encode($original) ?>,
    <?php if (!empty($work['prix_ttc'])): ?>
    "offers": {
      "@type": "Offer",
      "priceCurrency": "EUR",
      "price": "<?= number_format((float)$work['prix_ttc'], 2, '.', '') ?>",
      "availability": "https://schema.org/InStock"
    },
    <?php endif; ?>
    "url": <?= json_encode(url('dessin/' . $work['slug'])) ?>
  }
  </script>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
