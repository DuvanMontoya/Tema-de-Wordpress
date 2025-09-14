<?php
/**
 * Template Name: Página (Full Width)
 * Template Post Type: page
 */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<div class="pagina-wrapper">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="page-<?php the_ID(); ?>" <?php post_class('page--full'); ?> >
      <header class="page-header">
        <div class="page-container page-container--full">
          <h1 class="page-header__title"><?php the_title(); ?></h1>
        </div>
      </header>
      <section class="page-content">
        <div class="page-container page-container--full">
          <div class="page-main-content">
            <div class="page-content-wrapper">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </section>
    </article>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
