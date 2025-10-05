<?php
require_once __DIR__ . '/inc/config.php';
include __DIR__ . "/data/cinema.php";
$uses_video = true;

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

// route: film.php?slug=...  OU  /film/<slug>
$slug  = isset($_GET['slug']) ? strtolower(trim($_GET['slug'])) : '';
$index = array_search($slug, array_column($FILMS, 'slug'));
$film  = ($index !== false) ? $FILMS[$index] : null;

if (!$film) {
  http_response_code(404);
  $page_title = "Film introuvable — Atam Rasho";
  $page_description = "Ce film n'existe pas ou a été déplacé.";
  include __DIR__ . "/inc/head.php";
  echo "<main class='page-header section container'><h1>Film introuvable</h1><p><a class='link' href='" . url('cinema') . "'>&larr; Retour</a></p></main>";
  include __DIR__ . "/inc/footer.php"; exit;
}

/* SEO */
$thumb           = resolve_thumb($film);
$page_title      = $film['title'] . " — Cinéma — Atam Rasho";
$page_description= $film['desc'];
$page_og_image   = $thumb;

include __DIR__ . "/inc/head.php";
?>

<main class="container section">
  <nav class="mb-4">
    <a href="<?= url('cinema') ?>" class="link-primary">&larr; Retour aux films</a>
  </nav>

  <article class="row g-5">
    <!-- Lecteur / Vignette -->
    <div class="col-12 col-lg-7">
      <?php $placeholder = url('assets/img/cinema/placeholder-16x9.png'); ?>
      <div class="ratio ratio-16x9 video-embed bg-light-subtle border rounded position-relative"
           data-platform="<?= htmlspecialchars($film['platform']) ?>"
           data-id="<?= htmlspecialchars($film['video_id']) ?>">
        <img
          src="<?= htmlspecialchars($thumb) ?>"
          alt="Miniature du film <?= htmlspecialchars($film['title']) ?>"
          class="w-100 h-100 js-thumb"
          style="object-fit:cover; display:block;"
          loading="eager" decoding="async"
          data-placeholder="<?= $placeholder ?>"
        >
        <!-- ⚠️ SPAN (pas button) + pas de classes Bootstrap qui ajoutent un fond -->
        <span class="play-badge" aria-hidden="true">▶</span>
      </div>
      <small class="text-muted d-block mt-2">Cliquez pour lancer la vidéo</small>
    </div>

    <!-- Infos -->
    <div class="col-12 col-lg-5">
      <h1 class="mb-1"><?= htmlspecialchars($film['title']) ?></h1>
      <div class="text-muted mb-3"><?= intval($film['year']) ?> • <?= htmlspecialchars($film['duration_human']) ?></div>

      <ul class="list-unstyled lh-lg small text-body-secondary mb-4">
        <?php if (!empty($film['cast'])): ?><li><strong>Interprète :</strong> <?= htmlspecialchars($film['cast']) ?></li><?php endif; ?>
        <?php if (!empty($film['music'])): ?><li><strong>Bande originale :</strong> <?= htmlspecialchars($film['music']) ?></li><?php endif; ?>
      </ul>

      <?php if (!empty($film['desc'])): ?>
        <p class="text-secondary"><?= nl2br(htmlspecialchars($film['desc'])) ?></p>
      <?php endif; ?>

      <a class="btn btn-outline-secondary mt-3" href="<?= htmlspecialchars($film['link']) ?>" target="_blank" rel="noopener">Voir sur la plateforme</a>

      <div class="d-flex justify-content-between mt-5 pt-3 border-top">
        <?php if (isset($FILMS[$index-1])): ?>
          <a class="link-primary small" href="<?= url('film/' . urlencode($FILMS[$index-1]['slug'])) ?>">← <?= htmlspecialchars($FILMS[$index-1]['title']) ?></a>
        <?php else: ?><span></span><?php endif; ?>
        <?php if (isset($FILMS[$index+1])): ?>
          <a class="link-primary small" href="<?= url('film/' . urlencode($FILMS[$index+1]['slug'])) ?>"><?= htmlspecialchars($FILMS[$index+1]['title']) ?> →</a>
        <?php endif; ?>
      </div>
    </div>
  </article>

  <!-- JSON-LD VideoObject -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "VideoObject",
    "name": <?= json_encode($film['title']) ?>,
    "description": <?= json_encode($film['desc']) ?>,
    "thumbnailUrl": <?= json_encode($thumb) ?>,
    "uploadDate": "<?= intval($film['year']) ?>-01-01",
    "duration": "<?= $film['duration'] ?>",
    "embedUrl": <?= json_encode($film['platform'] === 'youtube'
      ? "https://www.youtube.com/embed/" . $film['video_id'] . "?rel=0"
      : "https://player.vimeo.com/video/" . $film['video_id']) ?>,
    "url": <?= json_encode(url('film/' . $film['slug'])) ?>
  }
  </script>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
