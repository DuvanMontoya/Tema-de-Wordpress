<?php
/** Parte de plantilla: Quiz TutorLMS personalizado */
if (!defined('ABSPATH')) { exit; }
$quiz_id = get_the_ID();
?>
<section id="quiz-<?php echo esc_attr($quiz_id); ?>" <?php post_class('tutor-quiz'); ?>>
  <header class="quiz-header">
    <h1 class="quiz-title"><?php the_title(); ?></h1>
    <p class="quiz-subtitle"><?php _e('Evaluación del curso','academia-pro'); ?></p>
  </header>
  <div class="quiz-contenedor">
    <?php the_content(); ?>
  </div>
</section>
