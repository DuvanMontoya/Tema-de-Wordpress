<?php
/**
 * Template Name: Entrada (Narrow)
 * Template Post Type: post
 */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<div class="pagina-wrapper">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('entrada-simple'); ?> >
      <header class="page-header">
        <div class="page-container page-container--narrow">
          <h1 class="page-header__title"><?php the_title(); ?></h1>
          <div class="meta">
            <span><?php echo get_the_date(); ?></span>
            <span><?php _e('Autor','academia-pro'); ?>: <?php the_author(); ?></span>
          </div>
        </div>
      </header>
      <section class="page-content">
        <div class="page-container page-container--narrow">
          <div class="page-main-content">
            <div class="page-content-wrapper">
              <?php the_content(); ?>
              <?php if (comments_open() || get_comments_number()) { comments_template(); } ?>
              <nav class="navegacion-leccion">
                <div class="prev"><?php previous_post_link('%link', '← '.__('Anterior','academia-pro')); ?></div>
                <div class="next"><?php next_post_link('%link', __('Siguiente','academia-pro').' →'); ?></div>
              </nav>
            </div>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
