<?php
require_once __DIR__ . '/inc/config.php';
$page_title = "Cinéma d’animation — Atam Rasho";
$page_description = "Courts-métrages d’animation d’Atam Rasho : Jehanne, Voix des Soupirs, Le Fils Prodigue, La nuit sur le Mont Clair…";
include __DIR__ . "/inc/head.php";
include __DIR__ . "/data/cinema.php";

/** Miniature sûre (YouTube auto, fichier local existant, sinon placeholder) */
function resolve_thumb(array $f): string {
  if (!empty($f['thumb']) && preg_match('~^https?://~i', $f['thumb'])) return $f['thumb'];
  if (!empty($f['thumb'])) {
    $rel = ltrim($f['thumb'], '/');
    $abs = rtrim($_SERVER['DOCUMENT_ROOT'] ?? __DIR__, '/') . '/' . $rel;
    if (is_file($abs)) return url($rel);
  }
  if (($f['platform'] ?? '') === 'youtube' && !empty($f['video_id'])) {
    return "https://img.youtube.com/vi/" . urlencode($f['video_id']) . "/hqdefault.jpg";
  }
  return url('assets/img/cinema/placeholder-16x9.png');
}
?>

<main>
  <section class="page-header section container">
    <h1 class="mb-2">Cinéma d’animation</h1>
    <p class="mb-0 text-muted">Courts-métrages écrits et dessinés à la main.</p>
  </section>

  <section class="container section">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php foreach ($FILMS as $f): ?>
        <?php $thumb = resolve_thumb($f); 
        $placeholder = url('assets/img/cinema/placeholder-16x9.png'); ?>
        <div class="col">
          <article class="card h-100 shadow-sm video-card border-0">
            <a href="<?= url('film/' . urlencode($f['slug'])) ?>" class="video-thumb ratio ratio-16x9">
              <img
                src="<?= htmlspecialchars($thumb) ?>"
                alt="Miniature du film <?= htmlspecialchars($f['title']) ?>"
                loading="lazy" decoding="async"
                class="js-thumb"
                data-placeholder="<?= $placeholder ?>"
              >
              <span class="play-badge" aria-hidden="true">▶</span>
            </a>
            <div class="card-body">
              <h2 class="h5 mb-1">
                <a class="stretched-link text-decoration-none" href="<?= url('film/' . urlencode($f['slug'])) ?>">
                  <?= htmlspecialchars($f['title']) ?>
                </a>
              </h2>
              <div class="text-muted small">
                <?= intval($f['year']) ?> • <?= htmlspecialchars($f['duration_human']) ?>
              </div>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
