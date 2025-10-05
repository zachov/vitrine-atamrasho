<?php
$page_title = "À propos — Atam Rasho";
$page_description = "Biographie, mentions légales et informations du site officiel de l’artiste Atam Rasho.";
include __DIR__ . "/inc/head.php";
?>

<main>
  <!-- En-tête -->
  <section class="page-header section container text-center">
    <h1 class="mb-2">À propos</h1>
    <p class="text-muted mb-0">Biographie, mentions légales et informations relatives à ce site.</p>
  </section>

  <!-- Contenu principal -->
  <section class="container section">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">

        <!-- BIOGRAPHIE -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body p-4 p-md-5">
            <h2 class="h4 mb-3">Biographie</h2>
            <p>
              Né le <strong>21 janvier 1985 à Senlis</strong> (Oise), <strong>Atam Rasho</strong> est un artiste franco-arménien
              qui grandit à Clermont. Autodidacte à ses débuts, il commence le dessin à <strong>20 ans</strong> en suivant
              des cours du soir, puis intègre la classe préparatoire de l’<strong>Atelier de Sèvres</strong> à Paris avant
              d’obtenir son diplôme à l’<strong>École des Métiers du Cinéma d’Animation d’Angoulême (EMCA)</strong> en <strong>2013</strong>.
            </p>
            <p>
              Son travail se situe à la <strong>croisée du dessin et du cinéma d’animation</strong>. À la plume et à l’encre,
              il développe un univers nourri par les <strong>arts médiévaux</strong> et la tradition manuscrite, où la narration
              visuelle et la spiritualité occupent une place centrale. Il est lauréat du <strong>Premier prix de dessin
              Pierre David-Weill – Académie des Beaux-Arts (2020)</strong>.
            </p>
            <p class="text-muted small mb-0">
              (Extraits biographiques synthétisés d’après des publications institutionnelles et de formation.)
            </p>
          </div>
        </div>

        <!-- MENTIONS LÉGALES -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body p-4 p-md-5">
            <h2 class="h4 mb-3">Mentions légales</h2>
            <p>
              <strong>Éditeur du site :</strong><br>
              Atam Rasho — Artiste, réalisateur de films d’animation et dessinateur.
            </p>
            <p>
              <strong>Hébergeur :</strong><br>
              Environnement de développement local (WAMP).<br>
              <em>Le site pourra être migré vers un hébergement de production ultérieurement.</em>
            </p>
            <p>
              <strong>Contact :</strong><br>
              <a href="mailto:contact@atamrasho.com" class="link-primary">contact@atamrasho.com</a>
            </p>
          </div>
        </div>

        <!-- CRÉDITS -->
        <div class="card shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <h2 class="h4 mb-3">Crédits</h2>
            <p class="mb-2">
              Design & développement : <strong>Atam Rasho</strong> et <strong>Studio Axxess</strong><br>
              Technologies : PHP, Bootstrap 5, GLightbox<br>
              Typographie : Cinzel (Google Fonts)
            </p>
            <p class="text-muted small mb-0">
              © <?= date('Y') ?> Atam Rasho. Tous droits réservés. Toute reproduction, représentation ou diffusion du
              contenu du site, totale ou partielle, sans autorisation préalable, est interdite.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
