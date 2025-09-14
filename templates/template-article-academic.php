<?php
/**
 * Template Name: Artículo Académico (Math)
 * Template Post Type: post, page
 */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<article <?php post_class('article--academic'); ?>>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <header class="article-header">
    <div class="article-container">
      <h1 class="article-title"><?php the_title(); ?></h1>
      <div class="article-meta">
        <span class="article-author"><?php the_author(); ?></span>
        <span class="sep">·</span>
        <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
      </div>
      <?php if (has_excerpt()) : ?>
        <section class="article-abstract" aria-label="Resumen">
          <h2 class="sr-only"><?php esc_html_e('Resumen','academia-pro'); ?></h2>
          <p><?php echo esc_html( get_the_excerpt() ); ?></p>
        </section>
      <?php endif; ?>
    </div>
  </header>

  <div class="article-body">
    <div class="article-container">
      <div class="article-content typeset">
        <?php the_content(); ?>
      </div>
    </div>
  </div>

  <footer class="article-footer">
    <div class="article-container">
      <?php if (comments_open() || get_comments_number()) { comments_template(); } ?>
    </div>
  </footer>
  <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?>
