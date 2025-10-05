<?php
// merci.php
$page_title = "Merci — Atam Rasho";
$page_description = "Confirmation d’envoi du formulaire de contact sur le site d’Atam Rasho.";
include __DIR__ . "/inc/head.php";
?>

<main class="container section">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
        <h1 class="mb-3">Merci pour votre message</h1>
        <p class="lead text-body-secondary mb-4">
          Votre message a bien été transmis.<br>
          Nous vous répondrons dans les meilleurs délais.
        </p>

        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="<?= url('') ?>" class="btn btn-outline-secondary">Retour à l’accueil</a>
          <a href="<?= url('dessins') ?>" class="btn btn-brand">Voir les œuvres</a>
          <a href="<?= url('cinema') ?>" class="btn btn-outline-secondary">Cinéma d’animation</a>
        </div>

        <hr class="my-4">

        <p class="small text-muted mb-0">
          Besoin d’un complément ? Écrivez-nous à
          <a class="link-primary" href="mailto:contact@atamrasho.com">contact@atamrasho.com</a>.
        </p>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
