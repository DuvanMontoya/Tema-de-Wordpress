<?php
/** Plantilla single para lecciones genéricas (TutorLMS si CPT 'lesson') */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="lms-leccion-layout-wrapper lms-pbw">
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <?php get_template_part('template-parts/lms/tutor','lesson'); ?>
  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
