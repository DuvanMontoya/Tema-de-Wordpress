<?php
/** Plantilla single para quiz (TutorLMS CPT 'quiz') */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="lms-leccion-layout-wrapper lms-pbw">
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <?php get_template_part('template-parts/lms/tutor','quiz'); ?>
  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
