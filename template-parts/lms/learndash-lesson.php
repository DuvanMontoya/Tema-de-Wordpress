<?php
/** Parte de plantilla: Lección LearnDash */
if (!defined('ABSPATH')) { exit; }
$lesson_id = get_the_ID();
?>
<article id="ld-leccion-<?php echo esc_attr($lesson_id); ?>" <?php post_class('ld-leccion'); ?>>
  <header class="leccion-header">
    <h1 class="leccion-titulo"><?php the_title(); ?></h1>
    <div class="leccion-meta">
      <span><?php _e('Lección','academia-pro'); ?></span>
    </div>
  </header>
  <div class="leccion-contenido">
    <?php the_content(); ?>
  </div>
  <footer class="leccion-footer">
    <div class="prev"><?php previous_post_link('%link', '← '.__('Anterior','academia-pro')); ?></div>
    <div class="next"><?php next_post_link('%link', __('Siguiente','academia-pro').' →'); ?></div>
  </footer>
</article>
