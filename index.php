<?php
/** Página principal - Índice de entradas con diseño premium */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<?php if (have_posts()) : ?>
  <div class="posts-grid">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
          <?php if (has_post_thumbnail()) : ?>
            <div class="post-image">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              </a>
              <div class="post-image-overlay">
                <div class="overlay-icon">→</div>
              </div>
            </div>
          <?php endif; ?>

          <div class="post-content">
            <div class="post-meta">
              <?php
              $categories = get_the_category();
              if (!empty($categories)) :
                $category = $categories[0];
              ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="post-category">
                  <?php echo esc_html($category->name); ?>
                </a>
              <?php endif; ?>

              <time class="post-date" datetime="<?php echo get_the_date('c'); ?>">
                📅 <?php echo get_the_date(); ?>
              </time>

              <span class="post-reading-time">
                ⏱️ <?php echo estimated_reading_time(); ?>
              </span>
            </div>

            <h2 class="post-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <div class="post-excerpt">
              <?php the_excerpt(); ?>
            </div>

            <div class="post-footer">
              <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="post-author">
                <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 32)); ?>" alt="<?php the_author(); ?>" class="author-avatar">
                <span><?php the_author(); ?></span>
              </a>

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
    <div class="no-posts-icon">📚</div>
    <h2 class="no-posts-title">No hay entradas disponibles</h2>
    <p class="no-posts-message">Actualmente no hay contenido publicado. ¡Vuelve pronto!</p>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
