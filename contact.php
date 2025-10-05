<?php
$page_title = "Contact — Atam Rasho";
$page_description = "Contactez Atam Rasho pour toute demande (expositions, commandes, informations).";
include __DIR__ . "/inc/head.php";
?>

<main>
  <!-- En-tête -->
  <section class="page-header section container">
    <h1 class="mb-2">Contact</h1>
    <p class="mb-0 text-muted">Utilisez le formulaire ci-dessous pour me contacter.</p>
  </section>

  <!-- Formulaire -->
  <section class="container section">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="card shadow-sm">
          <div class="card-body p-4 p-lg-5">
            <form action="#" method="post" novalidate>
              <div class="row g-3">
                <div class="col-12">
                  <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" required autocomplete="name" placeholder="Votre nom">
                </div>

                <div class="col-12 col-md-6">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required autocomplete="email" placeholder="nom@domaine.com">
                </div>

                <div class="col-12 col-md-6">
                  <label for="subject" class="form-label">Sujet</label>
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet de votre message">
                </div>

                <div class="col-12">
                  <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="message" name="message" rows="6" required placeholder="Votre message..."></textarea>
                </div>

                <!-- Honeypot anti-spam (caché aux humains) -->
                <div class="d-none">
                  <label for="company">Société</label>
                  <input type="text" id="company" name="company" tabindex="-1" autocomplete="off">
                </div>

                <div class="col-12">
                  <button type="submit" class="btn btn-brand px-4">Envoyer</button>
                </div>

                <div class="col-12">
                  <p class="small text-muted mb-0">
                    En soumettant ce formulaire, vous acceptez que vos informations soient utilisées uniquement pour traiter votre demande.
                    <a href="<?= url('a-propos') ?>" class="link-primary">Mentions légales</a>.
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Zone de retour (succès/erreur) si besoin plus tard -->
        <!-- <div class="alert alert-success mt-3">Merci, votre message a bien été envoyé.</div> -->
        <!-- <div class="alert alert-danger mt-3">Une erreur est survenue. Veuillez réessayer.</div> -->
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . "/inc/footer.php"; ?>
