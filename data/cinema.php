<?php
// data/cinema.php

$FILMS = [
  [
    'slug' => 'le-fils-prodigue',
    'title' => 'Le Fils Prodigue',
    'year' => 2013,
    'duration' => 'PT8M',          // ISO 8601 pour SEO
    'duration_human' => '8 min',
    'platform' => 'youtube',
    'video_id' => 'JVtczOlV2PQ',
    'link' => 'https://www.youtube.com/watch?v=JVtczOlV2PQ',
    // Miniature : pour YouTube on peut générer automatiquement
    'thumb' => null,               // ou url('assets/img/cinema/fils_prodigue.jpg')
    'cast' => 'Jean-Pierre Jorris',
    'music' => null,
    'desc' => "Film de fin d’études à la plume et au brou de noix, librement inspiré de la parabole du Fils prodigue. Une exploration de la mémoire, du retour et de la réconciliation.",
  ],
  [
    'slug' => 'voix-des-soupirs',
    'title' => 'Voix des Soupirs',
    'year' => 2019,
    'duration' => 'PT18M',
    'duration_human' => '18 min',
    'platform' => 'vimeo',
    'video_id' => '388200036',
    'link' => 'https://vimeo.com/388200036',
    // Pour Vimeo, soit tu mets une image locale, soit on affiche un placeholder élégant
    'thumb' => null,
    'cast' => 'Sandrine Bonnaire',
    'music' => 'Gagik Muradian',
    'desc' => "Adaptation du Livre des Lamentations de saint Grégoire de Narek. Un film entièrement réalisé à la main, qui cherche à traduire la profondeur spirituelle du texte.",
  ],
  [
    'slug' => 'jehanne',
    'title' => 'Jehanne',
    'year' => 2021,
    'duration' => 'PT20M',
    'duration_human' => '20 min',
    'platform' => 'youtube',
    'video_id' => 'MLMeDU2JGnQ',
    'link' => 'https://www.youtube.com/watch?v=MLMeDU2JGnQ',
    'thumb' => null,
    'cast' => 'Armance Merles, Marc Mauillon',
    'music' => 'Pierre Hamon',
    'desc' => "Un voyage poétique dans la figure de Jeanne d’Arc, entre miniatures et gravures, où dessin et lumière ouvrent un espace de contemplation.",
  ],
  [
    'slug' => 'nuit-sur-le-mont-clair',
    'title' => 'La nuit sur le Mont Clair',
    'year' => 2024,
    'duration' => 'PT2M',
    'duration_human' => '2 min',
    'platform' => 'youtube',
    'video_id' => 'Poay281qeuk',
    'link' => 'https://www.youtube.com/watch?v=Poay281qeuk',
    'thumb' => null,
    'cast' => null,
    'music' => 'Pierre Hamon',
    'desc' => "Courte animation où traits et musiques dessinent une nuit suspendue sur le Mont Clair.",
  ],
];
