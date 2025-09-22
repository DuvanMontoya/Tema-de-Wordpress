<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>

<div class="single-post-container">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?> style="width: 100%; max-width: none; margin: 0 auto;">
      <header class="single-post-header">
        <div class="single-post-meta">
          <time class="single-post-date" datetime="<?php echo get_the_date('c'); ?>">
            📅 <?php echo get_the_date(); ?>
          </time>
          <span class="single-post-author">
            ✍️ <?php the_author(); ?>
          </span>
          <?php
          $categories = get_the_category();
          if (!empty($categories)) :
            $category = $categories[0];
          ?>
            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="single-post-category">
              🏷️ <?php echo esc_html($category->name); ?>
            </a>
          <?php endif; ?>
        </div>
        <h1 class="single-post-title"><?php the_title(); ?></h1>
      </header>

      <div class="single-post-content">
        <div class="single-post-body">
          <?php the_content(); ?>
        </div>
      </div>

      <footer class="single-post-footer">
        <div class="single-post-tags">
          <?php the_tags('<span class="tag-label">Etiquetas:</span> ', ', '); ?>
        </div>

        <nav class="single-post-navigation">
          <div class="nav-prev">
            <?php previous_post_link('%link', '← Anterior'); ?>
          </div>
          <div class="nav-next">
            <?php next_post_link('%link', 'Siguiente →'); ?>
          </div>
        </nav>

        <?php if (comments_open() || get_comments_number()) : ?>
          <div class="single-post-comments">
            <?php comments_template(); ?>
          </div>
        <?php endif; ?>
      </footer>
    </article>
  <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
