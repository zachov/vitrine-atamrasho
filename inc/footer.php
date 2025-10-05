<?php
// inc/footer.php
?>
<footer>
  <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($site_name) ?> — Tous droits réservés.</p>
  <div class="socials">
    <a href="#" aria-label="Facebook"><img src="<?= $base_path ?>/assets/img/facebook.svg" alt=""></a>
    <a href="#" aria-label="Instagram"><img src="<?= $base_path ?>/assets/img/instagram.svg" alt=""></a>
    <a href="#" aria-label="YouTube"><img src="<?= $base_path ?>/assets/img/youtube.svg" alt=""></a>
  </div>
</footer>

<script src="<?= $base_path ?>/assets/js/script.js" defer></script>
</body>
</html>
