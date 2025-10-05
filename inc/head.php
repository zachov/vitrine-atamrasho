<?php
// inc/head.php
require_once __DIR__ . '/config.php';

// =========================
// Métas de page (fallbacks)
// =========================
$page_title       = $page_title       ?? ($site_name ?? 'Site');
$page_description = $page_description ?? '';
$page_og_image    = $page_og_image    ?? url('assets/img/og-default.jpg'); // 1200x630 conseillé
$page_lang        = 'fr';

// =========================
// Canonical absolu
// =========================
$scheme    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host      = $_SERVER['HTTP_HOST'] ?? 'localhost';
$uri_path  = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$canonical = $scheme . '://' . $host . $uri_path;

// =========================
// Helper: versioning assets
// =========================
if (!function_exists('v')) {
  function v(string $path): string {
    $abs = rtrim($_SERVER['DOCUMENT_ROOT'] ?? __DIR__ . '/..', '/') . '/' . ltrim($path, '/');
    $qs  = is_file($abs) ? ('?v=' . filemtime($abs)) : '';
    return url($path) . $qs;
  }
}

// =========================
// Contexte page (préloads ciblés)
// =========================
$script_name = basename($_SERVER['SCRIPT_NAME'] ?? '');
$is_home     = ($script_name === 'index.php' || rtrim($uri_path, '/') === '');
$uses_video  = $uses_video ?? false; // Tu peux définir $uses_video = true dans cinema.php/film.php si tu veux des préconnects vidéo ciblés
?>
<!doctype html>
<html lang="<?= $page_lang ?>">
<head>
  <!-- Charset/viewport en tout début -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Titre & Description -->
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

  <!-- Indexation -->
  <meta name="robots" content="index,follow">

  <!-- Open Graph / Twitter -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($page_og_image) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
  <!-- (Optionnel) dimensions OG si ton image par défaut est 1200x630 -->
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($page_og_image) ?>">

  <!-- Favicon / PWA -->
  <link rel="icon" href="<?= v('assets/img/favicon.ico') ?>">
  <link rel="apple-touch-icon" href="<?= v('assets/img/apple-touch-icon.png') ?>">
  <link rel="manifest" href="<?= v('assets/manifest.webmanifest') ?>">
  <meta name="theme-color" content="#ffffff">

  <!-- Perf: preconnect (polices & éventuels players vidéo) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <?php if (!empty($uses_video)): ?>
    <!-- Domaines players pour éviter le coût DNS/TLS au clic -->
    <link rel="preconnect" href="https://www.youtube.com" crossorigin>
    <link rel="preconnect" href="https://i.ytimg.com" crossorigin>
    <link rel="preconnect" href="https://img.youtube.com" crossorigin>
    <link rel="preconnect" href="https://player.vimeo.com" crossorigin>
    <link rel="preconnect" href="https://i.vimeocdn.com" crossorigin>
  <?php endif; ?>

  <!-- Polices (display=swap pour éviter les flashes) -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- CSS (preload + feuille) -->
  <link rel="preload" href="<?= v('assets/css/style.css') ?>" as="style">
  <link rel="stylesheet" href="<?= v('assets/css/style.css') ?>">

  <!-- Bootstrap 5 (CSS) -->
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" as="style" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin>

  <!-- GLightbox (CSS) -->
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" as="style" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" crossorigin>

  <!-- Préchargements ciblés (ex: image héro en page d’accueil) -->
  <?php if ($is_home): ?>
    <link rel="preload" as="image" href="<?= url('assets/img/bandeau.png') ?>">
  <?php endif; ?>

  <!-- JS (defer pour ne pas bloquer le rendu) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin></script>
  <script defer src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js" crossorigin></script>

  <!-- Init GLightbox + helper "is-loaded" pour images -->
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      if (window.GLightbox) { GLightbox({ selector: '.glightbox' }); }
      document.querySelectorAll('img').forEach(img => {
        if (img.complete) img.classList.add('is-loaded');
        img.addEventListener('load', () => img.classList.add('is-loaded'));
      });
    });
  </script>
</head>
<body>
  <?php include __DIR__ . '/header.php'; ?>
