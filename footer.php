<?php
/** Footer del tema - Diseño premium con múltiples secciones */
if (!defined('ABSPATH')) { exit; }

// Si estamos en el dashboard de TutorLMS, no renderizar footer del tema (100% nativo)
if ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) : ?>
  </main>
  <?php wp_footer(); ?>
  </body>
  </html>
  <?php return; endif; ?>

  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="footer-container">
      <div class="footer-content">
        <div class="footer-logo">
          <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <h3 class="footer-title"><?php bloginfo('name'); ?></h3>
          <?php endif; ?>
        </div>
        <p class="footer-meta">
          <span class="footer-year">&copy; <?php echo date('Y'); ?></span>
          <span class="footer-separator">•</span>
          <span class="footer-created">Desarrollado con ❤️ por Academia Pro</span>
        </p>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
  </body>
  </html>
