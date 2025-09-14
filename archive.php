<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="contenedor pagina-wrapper">
  <header class="page-header">
    <h1 class="page-header__title"><?php the_archive_title(); ?></h1>
    <div class="page-header__desc"><?php the_archive_description(); ?></div>
  </header>
  <?php if (function_exists('academia_pro_breadcrumbs')) academia_pro_breadcrumbs(); ?>
  <?php if (have_posts()) : ?>
  <div class="loop-entradas archive-list">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('entrada'); ?>>
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <div class="meta">
          <span><?php echo get_the_date(); ?></span>
          <span><?php _e('Autor','academia-pro'); ?>: <?php the_author(); ?></span>
        </div>
  <div class="entrada__extracto">
          <?php the_excerpt(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
  <nav class="paginacion">
    <?php the_posts_pagination(['mid_size'=>2,'prev_text'=>__('Anterior','academia-pro'),'next_text'=>__('Siguiente','academia-pro')]); ?>
  </nav>
  <?php else: ?>
    <p><?php _e('No hay contenido disponible.','academia-pro'); ?></p>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
