<?php
/** Página principal - Índice de entradas simple */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<div class="pagina-wrapper">
  <div class="page-container">
    <div class="page-content">
      <div class="page-content-wrapper">
        <?php if (have_posts()) : ?>
          <div class="posts-list">
            <?php while (have_posts()) : the_post(); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <header class="post-header">
                  <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                      <?php echo get_the_date(); ?>
                    </time>
                    <span>Por <?php the_author(); ?></span>
                  </div>
                </header>
                
                <div class="post-excerpt">
                  <?php the_excerpt(); ?>
                </div>
                
                <footer class="post-footer">
                  <a href="<?php the_permalink(); ?>" class="read-more">
                    Leer más →
                  </a>
                </footer>
              </article>
            <?php endwhile; ?>
          </div>

          <?php the_posts_pagination(); ?>

        <?php else: ?>
          <div class="no-posts">
            <h2>No hay entradas disponibles</h2>
            <p>Actualmente no hay contenido publicado.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
