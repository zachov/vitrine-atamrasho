<?php
// inc/config.php

$site_name = "Atam Rasho";

/* Base path */
$base_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$base_path = rtrim($base_path, '/');
if ($base_path === '' || $base_path === '.') {
  $base_path = '';
}

/* Helper URL */
if (!function_exists('url')) {
  function url(string $path = ''): string {
    global $base_path;
    $path = ltrim($path, '/');
    // renvoie toujours une URL absolue à partir de la racine du vhost
    return ($base_path ? $base_path . '/' : '/') . $path;
  }
}

/* Menu principal */
$nav_items = [
  url('')         => "L'artiste",
  url('dessins')  => "Dessins",
  url('cinema')   => "Cinéma d'animation",
  url('boutique') => "Boutique",
  url('contact')  => "Contact",
  url('a-propos') => "À propos"
];
