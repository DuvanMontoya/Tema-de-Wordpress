<?php
/** Footer del tema - Diseño simple y elegante */
if (!defined('ABSPATH')) { exit; }
?>
</main>

<footer class="site-footer" role="contentinfo">
  <div class="footer-container">
    <div class="footer-content">
      <h3 class="footer-title">Math Academy</h3>
      <p class="footer-meta">
        <span class="footer-year"><?php echo date('Y'); ?></span>
        <span class="footer-separator">•</span>
        <span class="footer-created">Creado por <strong>Academia Pro</strong></span>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
