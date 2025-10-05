<?php
/**
 * tools/make_placeholders.php
 * Génère deux placeholders 16:9 :
 *  - assets/img/cinema/placeholder-16x9.png   (clair)
 *  - assets/img/cinema/placeholder-dark-16x9.png (sombre)
 *
 * Police TTF optionnelle : /assets/fonts/Cinzel-Regular.ttf
 */

error_reporting(E_ALL);
ini_set('display_errors', '1');

$W = 1280;      // largeur
$H = 720;       // hauteur
$text = "Atam Rasho — Cinéma d’animation";
$fontTTF = __DIR__ . '/../assets/fonts/Cinzel-Regular.ttf'; // optionnel

$destDir = __DIR__ . '/../assets/img/cinema';
if (!is_dir($destDir)) {
  @mkdir($destDir, 0777, true);
}

/**
 * Dessine un placeholder.
 * $palette = ['bg'=>[r,g,b], 'border'=>[r,g,b], 'text'=>[r,g,b]]
 * $outFilename = chemin de sortie PNG
 */
function draw_placeholder($W, $H, $text, $outFilename, $palette, $fontTTF) {
  $im = imagecreatetruecolor($W, $H);

  // Couleurs
  $bg     = imagecolorallocate($im, $palette['bg'][0], $palette['bg'][1], $palette['bg'][2]);
  $border = imagecolorallocate($im, $palette['border'][0], $palette['border'][1], $palette['border'][2]);
  $textC  = imagecolorallocate($im, $palette['text'][0], $palette['text'][1], $palette['text'][2]);

  // Fond + bordure
  imagefilledrectangle($im, 0, 0, $W, $H, $bg);
  imagerectangle($im, 0, 0, $W-1, $H-1, $border);

  // Texture douce (facultative, très légère)
  // On trace quelques lignes transparentes pour casser l’à-plat (optionnel)
  // Commenter si vous préférez un fond 100% uni.
  $noise = imagecolorallocatealpha($im, $palette['border'][0], $palette['border'][1], $palette['border'][2], 115);
  for ($i=0; $i<50; $i++) {
    $y = rand(0, $H);
    imageline($im, 0, $y, $W, $y, $noise);
  }

  // Texte centré
  if (is_file($fontTTF)) {
    $fontSize = 36; // plus lisible
    $bbox = imagettfbbox($fontSize, 0, $fontTTF, $text);
    $textW = $bbox[2] - $bbox[0];
    $textH = $bbox[1] - $bbox[7];
    $x = (int)(($W - $textW) / 2);
    $y = (int)(($H + $textH) / 2);
    imagettftext($im, $fontSize, 0, $x, $y, $textC, $fontTTF, $text);
  } else {
    // Fallback GD (police bitmap)
    $font = 5; // taille max GD
    $textW = imagefontwidth($font) * mb_strlen($text);
    $textH = imagefontheight($font);
    $x = (int)(($W - $textW) / 2);
    $y = (int)(($H - $textH) / 2);
    imagestring($im, $font, $x, $y, $text, $textC);
  }

  // Export PNG
  imagepng($im, $outFilename);
  imagedestroy($im);
  return $outFilename;
}

// Palette claire (cohérente avec ton site)
$light = [
  'bg'     => [252, 250, 247], // #fcfaf7
  'border' => [107, 98, 87],   // #6b6257
  'text'   => [ 29, 29, 32],   // #1d1d20
];

// Palette sombre (inverse harmonieuse)
$dark = [
  'bg'     => [ 45, 38, 32],   // brun très sombre
  'border' => [180, 168, 150], // beige doré discret
  'text'   => [247, 244, 239], // ivoire clair
];

$lightOut = __DIR__ . '/../assets/img/cinema/placeholder-16x9.png';
$darkOut  = __DIR__ . '/../assets/img/cinema/placeholder-dark-16x9.png';

$lightFile = draw_placeholder($W, $H, $text, $lightOut, $light, $fontTTF);
$darkFile  = draw_placeholder($W, $H, $text, $darkOut,  $dark,  $fontTTF);

echo "✅ Placeholder clair : $lightFile\n";
echo "✅ Placeholder sombre : $darkFile\n";
