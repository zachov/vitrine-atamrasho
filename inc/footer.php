<?php
// inc/footer.php
?>
<footer class="py-4 border-top mt-auto">
  <div class="container d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3 text-center text-sm-start">
    <small class="text-muted mb-0">
      © <?= date('Y') ?> Atam Rasho — Tous droits réservés.
    </small>

    <nav class="d-flex align-items-center justify-content-center gap-3">
      <!-- Instagram officiel -->
      <a class="text-muted" href="https://www.instagram.com/atam.rasho/" target="_blank" rel="noopener" aria-label="Instagram d'Atam Rasho">
        <i class="bi bi-instagram" style="font-size:1.25rem;"></i>
      </a>
      <!-- YouTube placeholder (à remplacer si lien dispo) -->
      <a class="text-muted" href="https://www.youtube.com/" target="_blank" rel="noopener" aria-label="Chaîne YouTube">
        <i class="bi bi-youtube" style="font-size:1.25rem;"></i>
      </a>
      <!-- Facebook placeholder (à remplacer ou retirer si inutile) -->
      <a class="text-muted" href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Page Facebook">
        <i class="bi bi-facebook" style="font-size:1.25rem;"></i>
      </a>
    </nav>
  </div>
</footer>

<script src="<?= $base_path ?>/assets/js/script.js" defer></script>
</body>
</html>
