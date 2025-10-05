<?php
$page_title = "Dessins — Atam Rasho";
$page_description = "Découvrez les dessins à la plume et à l’encre de Chine d’Atam Rasho, entre art médiéval et cinéma d’animation.";
include __DIR__ . "/inc/head.php";
include __DIR__ . "/data/dessins.php";
?>

<main>
  <!-- En-tête -->
  <section class="page-header section container">
    <h1 class="mb-2">Dessins</h1>
    <p class="text-muted mb-4">
      Cliquez sur une image pour l’agrandir, ou sur le titre pour découvrir chaque œuvre en détail.
    </p>

    <!-- Texte de présentation -->
    <div class="lead text-body-secondary lh-lg" style="max-width: 800px; margin: 0 auto;">
      <p>
        Réalisés à la plume et à l’encre de Chine, les dessins d’Atam Rasho nécessitent jusqu’à six semaines de travail minutieux.
        À la croisée du cinéma d’animation et du dessin pur, certaines de ses œuvres se retrouvent intégralement dans ses films,
        tandis que l’expérience de l’animation nourrit la vitalité du trait et la poésie des images.
      </p>
      <p>
        Chaque dessin devient ainsi un espace de méditation et de recherche, où s’expriment une lumière, une spiritualité et un imaginaire
        nourris par une tradition millénaire, à la fois orientale et occidentale.
      </p>
    </div>
  </section>

  <!-- Grille harmonisée -->
  <section class="container section">
    <?php if (!empty($DESSINS)): ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 art-grid">
        <?php foreach ($DESSINS as $w): ?>
          <?php
            $baseName = pathinfo($w['image'], PATHINFO_FILENAME);
            // vignettes
            $thumb600_jpg   = url('assets/thumbs/600/'  . $baseName . '.jpg');
            $thumb1200_jpg  = url('assets/thumbs/1200/' . $baseName . '.jpg');
            $thumb600_webp  = url('assets/thumbs/600/'  . $baseName . '.webp');
            $thumb1200_webp = url('assets/thumbs/1200/' . $baseName . '.webp');
            // original pour lightbox
            $original = url($w['image']);
          ?>
          <div class="col">
            <div class="card h-100 shadow-sm art-card">
              <a href="<?= $original ?>"
                 class="glightbox"
                 data-gallery="dessins"
                 data-title="<?= htmlspecialchars($w['title']) ?>"
                 aria-label="Agrandir <?= htmlspecialchars($w['title']) ?>">
                <div class="ratio ratio-4x3">
                  <picture>
                    <source type="image/webp"
                            srcset="<?= $thumb600_webp ?> 600w, <?= $thumb1200_webp ?> 1200w"
                            sizes="(min-width: 992px) 33vw, (min-width: 576px) 50vw, 100vw">
                    <img
                      src="<?= $thumb600_jpg ?>"
                      srcset="<?= $thumb600_jpg ?> 600w, <?= $thumb1200_jpg ?> 1200w"
                      sizes="(min-width: 992px) 33vw, (min-width: 576px) 50vw, 100vw"
                      alt="<?= htmlspecialchars($w['alt']) ?>"
                      loading="lazy" decoding="async">
                  </picture>
                </div>
              </a>

              <div class="card-body text-center">
                <h3 class="h6">
                  <a class="art-title-link" href="<?= url('dessin/' . urlencode($w['slug'])) ?>">
                    <?= htmlspecialchars($w['title']) ?>
                  </a>
                </h3>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info" role="status">Aucun dessin publié pour le moment.</div>
    <?php endif; ?>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
