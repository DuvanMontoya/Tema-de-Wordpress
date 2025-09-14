<?php
/** Archivo de cursos (TutorLMS / LearnDash) con grid y filtro AJAX */
if (!defined('ABSPATH')) { exit; }
get_header();
$post_type = get_query_var('post_type');
?>
<div class="contenedor pagina-cursos">
  <header class="page-header">
    <h1 class="page-header__title"><?php _e('Cursos','academia-pro'); ?></h1>
  </header>
  <form id="filtro-cursos" class="filtro-cursos">
    <div>
  <label><?php _e('Buscar','academia-pro'); ?></label>
      <input type="search" name="q" placeholder="<?php esc_attr_e('Buscar cursos…','academia-pro'); ?>" />
    </div>
    <div>
  <label><?php _e('Nivel','academia-pro'); ?></label>
      <select name="nivel">
        <option value=""><?php _e('Todos','academia-pro'); ?></option>
        <option value="basico"><?php _e('Básico','academia-pro'); ?></option>
        <option value="intermedio"><?php _e('Intermedio','academia-pro'); ?></option>
        <option value="avanzado"><?php _e('Avanzado','academia-pro'); ?></option>
      </select>
    </div>
    <div>
  <label><?php _e('Orden','academia-pro'); ?></label>
      <select name="orden">
        <option value="nuevo"><?php _e('Más nuevos','academia-pro'); ?></option>
        <option value="popular"><?php _e('Populares','academia-pro'); ?></option>
        <option value="titulo"><?php _e('Título A-Z','academia-pro'); ?></option>
      </select>
    </div>
    <div>
      <button class="boton" type="submit"><?php _e('Filtrar','academia-pro'); ?></button>
    </div>
  </form>
  <div id="cursos-grid" class="cursos-grid">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="curso-tarjeta">
        <div class="curso-tarjeta__media">
          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large'); ?></a>
        </div>
        <div class="curso-tarjeta__body">
          <h3 class="curso-tarjeta__titulo"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="curso-tarjeta__meta">
            <span><?php echo esc_html(get_post_meta(get_the_ID(),'nivel',true) ?: __('General','academia-pro')); ?></span>
            <span><?php echo get_the_date('Y'); ?></span>
          </div>
          <div class="curso-tarjeta__progreso">
            <?php if (function_exists('tutor_utils')) { $percent = tutor_utils()->get_course_completed_percent(get_the_ID(), get_current_user_id()); academia_pro_render_progreso($percent); } ?>
          </div>
        </div>
      </div>
    <?php endwhile; else: ?>
      <p><?php _e('Sin cursos disponibles.','academia-pro'); ?></p>
    <?php endif; ?>
  </div>
  <nav class="paginacion">
    <?php the_posts_pagination(['mid_size'=>2,'prev_text'=>__('Anterior','academia-pro'),'next_text'=>__('Siguiente','academia-pro')]); ?>
  </nav>
</div>
<?php get_footer(); ?>
