<?php
$page_title = "À propos — Atam Rasho";
$page_description = "Biographie de l’artiste, mentions légales et réalisation du site (développement web & SEO par Sahag RACHO).";
include __DIR__ . "/inc/head.php";
?>

<main>
  <!-- En-tête -->
  <section class="page-header section container text-center">
    <h1 class="mb-2">À propos</h1>
    <p class="text-muted mb-0">
      Biographie de l’artiste, mentions légales et crédits de réalisation (développement & SEO).
    </p>
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
            <p class="mb-3">
              <strong>Éditeur du site :</strong><br>
              Atam Rasho — Artiste, réalisateur de films d’animation et dessinateur.
            </p>
            <p class="mb-3">
              <strong>Directeur de la publication :</strong><br>
              Atam Rasho
            </p>
            <p class="mb-3">
              <strong>Hébergement :</strong><br>
              Environnement de développement local (WAMP) et déploiement de démonstration sur plateforme cloud.<br>
              <em>Le site pourra être migré vers un hébergement de production ultérieurement.</em>
            </p>
            <p class="mb-0">
              <strong>Contact :</strong><br>
              <a href="mailto:contact@atamrasho.com" class="link-primary">contact@atamrasho.com</a>
            </p>
          </div>
        </div>

        <!-- CRÉDITS & RÉALISATION -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body p-4 p-md-5">
            <h2 class="h4 mb-3">Réalisation & référencement</h2>

            <div class="mb-3">
              <strong>Conception, développement web & SEO :</strong><br>
              <span class="h6 mb-0 d-inline-block">Sahag <span class="text-uppercase">RACHO</span></span><br>
              <span class="text-muted small">Développeur web & consultant référencement</span>
            </div>

            <ul class="list-unstyled lh-lg mb-3">
              <li>• Intégration responsive <strong>mobile-first</strong> (Bootstrap 5), design optimisé pour la lecture et les visuels.</li>
              <li>• Performance front : <strong>images optimisées</strong> (miniatures WebP/JPG, <code>srcset</code>, <code>sizes</code>, lazy-loading), JS léger.</li>
              <li>• Référencement : balises <strong>méta</strong> propres, données structurées <strong>JSON-LD</strong> (œuvres, vidéos, site), URLs lisibles.</li>
              <li>• Accessibilité : contrastes, focus visible, alternative textuelle, hiérarchie de titres cohérente.</li>
            </ul>

            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <div class="p-3 rounded border bg-white h-100">
                  <div class="fw-semibold mb-1">Stack technique</div>
                  <div class="text-muted small">PHP • Bootstrap 5 • GLightbox • Routing .htaccess • Thumbs auto (GD)</div>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="p-3 rounded border bg-white h-100">
                  <div class="fw-semibold mb-1">Optimisation SEO</div>
                  <div class="text-muted small">Titres & métas, JSON-LD, maillage interne, performances, sémantique</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CRÉDITS GÉNÉRAUX -->
        <div class="card shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <h2 class="h4 mb-3">Crédits</h2>
            <p class="mb-2">
              Direction artistique & contenus : <strong>Atam Rasho</strong><br>
              Développement web & référencement : <strong>Sahag RACHO</strong><br>
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

<?php
// ————————————————————————————————
// JSON-LD (développeur + site) pour SEO
// ————————————————————————————————
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Person",
      "name": "Sahag RACHO",
      "jobTitle": "Développeur web & consultant SEO",
      "worksFor": {
        "@type": "Organization",
        "name": "Studio Axxess"
      }
    },
    {
      "@type": "WebSite",
      "name": "Atam Rasho — Site officiel",
      "inLanguage": "fr-FR",
      "author": { "@type": "Person", "name": "Atam Rasho" },
      "creator": { "@type": "Person", "name": "Sahag RACHO" },
      "publisher": { "@type": "Person", "name": "Atam Rasho" }
    }
  ]
}
</script>

<?php include __DIR__ . "/inc/footer.php"; ?>
