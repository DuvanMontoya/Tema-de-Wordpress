<?php
/** Parte de plantilla: Quiz LearnDash */
if (!defined('ABSPATH')) { exit; }
$quiz_id = get_the_ID();
?>
<section id="ld-quiz-<?php echo esc_attr($quiz_id); ?>" <?php post_class('ld-quiz'); ?>>
  <header class="quiz-header">
    <h1 class="quiz-title"><?php the_title(); ?></h1>
    <p class="quiz-subtitle"><?php _e('Evaluación','academia-pro'); ?></p>
  </header>
  <div class="quiz-contenedor">
    <?php the_content(); ?>
  </div>
</section>
