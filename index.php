<?php
$page_title = "Accueil — Atam Rasho";
$page_description = "Découvrez les dessins, animations et la boutique d’Atam Rasho.";
include __DIR__ . "/inc/head.php"; // charge aussi url()
?>

<main>
  <!-- Hero -->
  <section class="position-relative overflow-hidden" style="min-height:60vh;">
    <img
      src="<?= url('assets/img/bandeau.png') ?>"
      alt="Visuel d’une œuvre de l’artiste"
      class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
    >
    <div class="position-relative container text-center py-5" style="z-index:2;">
      <div class="bg-white bg-opacity-75 p-4 rounded shadow-lg d-inline-block">
        <h1 class="display-5 fw-bold mb-3">Accueil - Atam Rasho</h1>
        <p class="lead mb-3">Entre art contemporain et cinéma d’animation,<br> explorez mes dernières créations.</p>
        <a href="<?= url('dessins') ?>" class="btn btn-brand btn-lg">Voir les dessins</a>
      </div>
    </div>
  </section>

  <!-- Sections clés -->
  <section class="container py-5">
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <a href="<?= url('dessins') ?>">
            <img src="<?= url('assets/img/creation_L.jpg') ?>" class="card-img-top object-fit-cover" style="height:220px;" alt="Aperçu des dessins">
            <div class="card-body">
              <h3 class="h5 fw-semibold">Dessins</h3>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <a href<?= '="' . url('cinema') . '"' ?>>
            <img src="<?= url('assets/img/Narek_L.jpg') ?>" class="card-img-top object-fit-cover" style="height:220px;" alt="Aperçu cinéma d’animation">
            <div class="card-body">
              <h3 class="h5 fw-semibold">Cinéma d’animation</h3>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <a href="<?= url('boutique') ?>">
            <img src="<?= url('assets/img/charnier_L.jpg') ?>" class="card-img-top object-fit-cover" style="height:220px;" alt="Aperçu boutique">
            <div class="card-body">
              <h3 class="h5 fw-semibold">Boutique</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- À propos -->
  <section class="bg-light border-top border-bottom py-5">
    <div class="container text-center">
      <h2 class="mb-4">À propos de l’artiste</h2>
      <p class="lead text-muted mb-4">
        Atam Rasho est artiste, réalisateur de films d’animation et dessinateur. Son œuvre mêle dessin pur et images animées.
        Ses films, entièrement réalisés à la main, se présentent comme de véritables tableaux poétiques.
        Puisant dans les arts médiévaux et les traditions sacrées millénaires, il unit dessin, texte et musique, à la fois sur écran et dans le cadre de ses expositions.
      </p>
      <a href="<?= url('contact') ?>" class="btn btn-outline-dark">Me contacter</a>
    </div>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
