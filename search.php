<?php
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="contenedor pagina-wrapper">
  <header class="page-header">
    <h1 class="page-header__title"><?php printf(esc_html__('Resultados de búsqueda para: %s','academia-pro'), '<span>'.get_search_query().'</span>'); ?></h1>
  </header>
  <?php if (function_exists('academia_pro_breadcrumbs')) academia_pro_breadcrumbs(); ?>
  <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
      <span class="oculto"><?php _e('Buscar','academia-pro'); ?></span>
      <input type="search" class="search-field" value="<?php echo esc_attr(get_search_query()); ?>" name="s" placeholder="<?php esc_attr_e('Buscar…','academia-pro'); ?>" />
    </label>
  </form>
  <?php if (have_posts()) : ?>
  <div class="loop-entradas search-list">
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
    <p><?php _e('No hay resultados.','academia-pro'); ?></p>
  <?php endif; ?>
</div>
<?php get_footer(); ?>
