<?php
/** Plantilla single para cursos TutorLMS */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<div class="lms-leccion-layout-wrapper" style="padding-top:2.2rem; padding-bottom:2.8rem;">
  <div class="lms-leccion-layout">
    <div class="lms-leccion-layout__principal">
      <?php while (have_posts()) : the_post(); ?>
        <article id="curso-<?php the_ID(); ?>" <?php post_class('curso-single'); ?>>
          <header style="margin-bottom:1.6rem;">
            <h1 style="margin:0 0 .6rem; font-size:2.3rem; "><?php the_title(); ?></h1>
            <div style="font-size:.85rem; color:var(--color-texto-suave); display:flex; gap:1rem; flex-wrap:wrap;">
              <span><?php _e('Actualizado','academia-pro'); ?>: <?php echo get_the_modified_date(); ?></span>
              <span><?php _e('Autor','academia-pro'); ?>: <?php the_author(); ?></span>
            </div>
          </header>
          <div class="curso-descripcion leccion-contenido">
            <?php the_content(); ?>
          </div>
          <section style="margin-top:2.2rem;">
            <h2 style="margin-top:0; font-size:1.4rem; "><?php _e('Contenido del curso','academia-pro'); ?></h2>
            <?php if(function_exists('tutor_course_topics')) { tutor_course_topics(); } ?>
          </section>
        </article>
      <?php endwhile; ?>
    </div>
    <aside class="lms-leccion-layout__sidebar">
      <nav aria-label="<?php esc_attr_e('Índice de la lección','academia-pro'); ?>">
        <ul class="leccion-indice"></ul>
      </nav>
      <div class="widget">
        <h3 style="margin-top:0; font-size:1rem; font-weight:600; "><?php _e('Progreso','academia-pro'); ?></h3>
        <?php if (function_exists('tutor_utils')) {
          $course_id = get_the_ID();
          $percent = tutor_utils()->get_course_completed_percent($course_id, get_current_user_id());
          academia_pro_render_progreso($percent);
        } ?>
      </div>
      <?php if (is_active_sidebar('sidebar-cursos')) { dynamic_sidebar('sidebar-cursos'); } ?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
