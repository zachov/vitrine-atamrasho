<?php
require_once __DIR__ . '/inc/config.php';
include __DIR__ . '/data/dessins.php';
include __DIR__ . '/data/cinema.php';

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
$base   = $scheme . '://' . $host . '/';

function abs_url(string $path): string {
  $path = ltrim($path, '/');
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . '/' . $path;
}

header('Content-Type: application/xml; charset=UTF-8');

$static = [
  url(''),
  url('dessins'),
  url('cinema'),
  url('contact'),
  url('a-propos'),
  url('boutique'),
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach ($static as $u): ?>
  <url>
    <loc><?= htmlspecialchars(abs_url($u)) ?></loc>
  </url>
  <?php endforeach; ?>

  <?php foreach ($DESSINS as $w): ?>
  <url>
    <loc><?= htmlspecialchars(abs_url(url('dessin/' . $w['slug']))) ?></loc>
  </url>
  <?php endforeach; ?>

  <?php if (!empty($FILMS)): foreach ($FILMS as $f): ?>
  <url>
    <loc><?= htmlspecialchars(abs_url(url('film/' . $f['slug']))) ?></loc>
  </url>
  <?php endforeach; endif; ?>
</urlset>
