<?php
/** Plantilla 404 profesional */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="contenedor pagina-wrapper">
  <?php if (function_exists('academia_pro_breadcrumbs')) academia_pro_breadcrumbs(); ?>
  <section class="error-404">
    <header class="page-header">
      <h1 class="page-header__title"><?php _e('Página no encontrada','academia-pro'); ?></h1>
      <p class="page-header__desc"><?php _e('Lo sentimos, no pudimos encontrar lo que buscas.','academia-pro'); ?></p>
    </header>
    <p><?php _e('Prueba con una búsqueda o vuelve a la página de inicio.','academia-pro'); ?></p>
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
      <label>
        <span class="oculto"><?php _e('Buscar','academia-pro'); ?></span>
        <input type="search" class="search-field" name="s" placeholder="<?php esc_attr_e('Buscar…','academia-pro'); ?>" />
      </label>
    </form>
    <p><a class="btn btn--accent" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Volver al inicio','academia-pro'); ?></a></p>
  </section>
</div>
<?php get_footer(); ?>
