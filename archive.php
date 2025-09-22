<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<header class="archive-header">
  <h1 class="archive-title"><?php the_archive_title(); ?></h1>
  <p class="archive-description"><?php the_archive_description(); ?></p>
</header>

<?php if (have_posts()) : ?>
  <div class="posts-grid">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
        <?php if (has_post_thumbnail()) : ?>
          <div class="post-image">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            </a>
          </div>
        <?php endif; ?>

        <div class="post-content">
          <div class="post-meta">
            <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>" class="post-category">
              <?php echo esc_html(get_the_category()[0]->name); ?>
            </a>
            <time class="post-date" datetime="<?php echo get_the_date('c'); ?>">
              📅 <?php echo get_the_date(); ?>
            </time>
          </div>

          <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <div class="post-excerpt">
            <?php the_excerpt(); ?>
          </div>

          <div class="post-footer">
            <a href="<?php the_permalink(); ?>" class="read-more">
              Leer más →
            </a>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>

  <nav class="blog-pagination">
    <?php the_posts_pagination(array(
      'mid_size' => 2,
      'prev_text' => '← Anterior',
      'next_text' => 'Siguiente →',
    )); ?>
  </nav>

<?php else: ?>
  <div class="no-posts">
    <div class="no-posts-icon">🔍</div>
    <h2 class="no-posts-title">No se encontraron entradas</h2>
    <p class="no-posts-message">No hay contenido en esta categoría.</p>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
