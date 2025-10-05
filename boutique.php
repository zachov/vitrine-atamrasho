<?php
$page_title = "Boutique — Atam Rasho";
$page_description = "Découvrez prochainement les tirages, affiches et créations d'Atam Rasho.";
include __DIR__ . "/inc/head.php";
?>

<main>
  <!-- En-tête -->
  <section class="page-header section container text-center">
    <h1 class="mb-2">Boutique</h1>
    <p class="text-muted mb-0">Tirages, affiches et œuvres d’art en édition limitée.</p>
  </section>

  <!-- Contenu principal -->
  <section class="container section text-center">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <div class="card border-0 shadow-sm p-4 p-md-5">
          <div class="card-body">
            <h2 class="h5 mb-3">Bientôt disponible</h2>
            <p class="mb-4">
              La boutique officielle d’<strong>Atam Rasho</strong> ouvrira prochainement.  
              Vous y trouverez une sélection exclusive de <strong>tirages d’art</strong>,  
              d’<strong>affiches numérotées</strong> et de <strong>produits dérivés</strong> autour de son univers graphique.
            </p>
            <div class="text-muted small mb-4">
              Pour être informé du lancement, suivez l’artiste sur ses réseaux sociaux ou inscrivez-vous à la newsletter.
            </div>
            <a href="<?= url('contact') ?>" class="btn btn-outline-dark">
              Me contacter
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
