<?php
/**
 * tools/make_thumbs.php
 * Génère des vignettes 600px et 1200px (JPG + WebP si dispo) à partir des originaux.
 * Sortie: assets/thumbs/600/*.jpg(.webp) et assets/thumbs/1200/*.jpg(.webp)
 * Requis: extension gd (et exif recommandé)
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');
@ini_set('memory_limit', '1024M'); // plus de mémoire pour les gros PNG
@set_time_limit(0);

// --- Dossiers sources à scanner (mets tes originaux ici) ---
$SOURCE_DIRS = [
  __DIR__ . '/../assets/img/dessins',
  __DIR__ . '/../assets/img/oeuvres',
  __DIR__ . '/../img/dessins',
  __DIR__ . '/../img/oeuvres',
];

// --- Dossiers de sortie ---
$DEST_BASE    = __DIR__ . '/../assets/thumbs';
$SIZES        = [600, 1200];
$QUALITY_JPG  = 82;
$QUALITY_WEBP = 82;

@mkdir($DEST_BASE, 0777, true);
foreach ($SIZES as $sz) { @mkdir($DEST_BASE . '/' . $sz, 0777, true); }

// ------------------------- Helpers -------------------------

function th_find_images(array $dirs) {
  $out = [];
  foreach ($dirs as $d) {
    if (!is_dir($d)) continue;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($d, FilesystemIterator::SKIP_DOTS));
    foreach ($it as $file) {
      if ($file->isDir()) continue;
      $ext = strtolower($file->getExtension());
      if (in_array($ext, ['jpg','jpeg','png','webp'])) {
        $out[] = $file->getPathname();
      }
    }
  }
  return $out;
}

function th_exif_orientation($path) {
  if (!function_exists('exif_read_data')) return 1;
  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  if (!in_array($ext, ['jpg','jpeg'])) return 1;
  $exif = @exif_read_data($path);
  return isset($exif['Orientation']) ? (int)$exif['Orientation'] : 1;
}

function th_image_create($path) {
  $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
  switch ($ext) {
    case 'jpg':
    case 'jpeg': return @imagecreatefromjpeg($path);
    case 'png':  return @imagecreatefrompng($path);
    case 'webp': return function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : null;
    default:     return null;
  }
}

function th_rotate_by_exif($im, $orientation) {
  if (!$im || !function_exists('imagerotate')) return $im;
  switch ((int)$orientation) {
    case 3: return imagerotate($im, 180, 0);
    case 6: return imagerotate($im, -90, 0);
    case 8: return imagerotate($im, 90, 0);
    default: return $im;
  }
}

function th_resize_to_width($srcIm, $targetW) {
  if (!$srcIm) return null;
  $w = imagesx($srcIm); $h = imagesy($srcIm);
  if ($w <= 0 || $h <= 0) return null;

  // garde-fou: éviter d’exploser la mémoire (estim ~4 B/px)
  $estBytes = $w * $h * 4;
  if ($estBytes > 800 * 1024 * 1024) { // ~800 MB
    return null; // on skippe, trop gros pour GD
  }

  $ratio = $h / $w;
  $newW  = max(1, (int)$targetW);
  $newH  = max(1, (int)round($newW * $ratio));

  $dstIm = imagecreatetruecolor($newW, $newH);

  // fond blanc (pour aplatir la transparence PNG → JPG)
  $white = imagecolorallocate($dstIm, 255,255,255);
  imagefilledrectangle($dstIm, 0, 0, $newW, $newH, $white);

  // activer l’interpolation de qualité si dispo
  if (function_exists('imageantialias')) { @imageantialias($dstIm, true); }

  imagecopyresampled($dstIm, $srcIm, 0, 0, 0, 0, $newW, $newH, $w, $h);
  return $dstIm;
}

function th_save_jpg($im, $path, $quality) { return imagejpeg($im, $path, (int)$quality); }
function th_save_webp($im, $path, $quality) {
  if (!function_exists('imagewebp')) return false;
  return imagewebp($im, $path, (int)$quality);
}

// ------------------------- Traitement -------------------------

$images = th_find_images($SOURCE_DIRS);
$report = [];
$total  = 0;

foreach ($images as $abs) {
  $base = pathinfo($abs, PATHINFO_FILENAME);

  // ouvre + auto orientation EXIF
  $src = th_image_create($abs);
  if (!$src) { $report[] = "SKIP (format non supporté): $abs"; continue; }
  $src = th_rotate_by_exif($src, th_exif_orientation($abs));

  foreach ($SIZES as $sz) {
    $resized = th_resize_to_width($src, $sz);
    if (!$resized) { $report[] = "SKIP (trop gros / erreur) $sz: $abs"; continue; }

    $dstJpg  = $DEST_BASE . "/$sz/$base.jpg";
    $dstWebp = $DEST_BASE . "/$sz/$base.webp";
    @mkdir(dirname($dstJpg), 0777, true);

    th_save_jpg($resized, $dstJpg,  $QUALITY_JPG);
    th_save_webp($resized, $dstWebp, $QUALITY_WEBP);

    imagedestroy($resized);
    $report[] = "OK $sz → " . basename($dstJpg);
    $total++;
    // flush périodique pour mémoire
    if ($total % 10 === 0) { if (function_exists('gc_collect_cycles')) gc_collect_cycles(); }
  }

  imagedestroy($src);
}

// ------------------------- Sortie -------------------------
header('Content-Type: text/plain; charset=utf-8');
echo "Thumbnails générés dans assets/thumbs/{600,1200}\n";
echo "Total miniatures: $total\n\n";
echo implode("\n", $report), "\n";
