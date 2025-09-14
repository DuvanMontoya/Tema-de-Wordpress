<?php
/** Plantilla single para cursos LearnDash */
if (!defined('ABSPATH')) { exit; }
get_header(); ?>
<div class="lms-leccion-layout-wrapper">
  <div class="lms-leccion-layout">
    <div class="lms-leccion-layout__principal">
      <?php while (have_posts()) : the_post(); ?>
        <article id="curso-ld-<?php the_ID(); ?>" <?php post_class('curso-single-ld'); ?>>
          <section class="curso-hero">
            <?php 
              if (has_post_thumbnail()) {
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
                echo '<div class="curso-hero__media" style="--thumb: url('.esc_url($thumb).')"></div>';
              }
            ?>
            <div class="curso-hero__overlay"></div>
            <div class="curso-hero__content">
              <h1 class="curso-hero__title"><?php the_title(); ?></h1>
              <?php if (has_excerpt()) : ?>
                <p class="curso-hero__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
              <?php endif; ?>
              <?php 
                $video = get_post_meta(get_the_ID(), 'curso_video_youtube', true);
                if ($video) {
                  if (preg_match('~(?:youtu\.be/|v=)([\w-]{11})~', $video, $m)) { $video = $m[1]; }
                  echo '<a class="lite-yt" data-video="'.esc_attr($video).'" style="--thumb:url(https://i.ytimg.com/vi/'.esc_attr($video).'/hqdefault.jpg)"><span class="lite-yt__btn"><span>'.__('Ver presentación','academia-pro').'</span></span></a>';
                }
              ?>
              <div class="curso-metas">
                <span><?php _e('Actualizado','academia-pro'); ?>: <?php echo get_the_modified_date(); ?></span>
                <span><?php _e('Autor','academia-pro'); ?>: <?php the_author(); ?></span>
              </div>
            </div>
          </section>

          <div class="curso-main">
            <div>
              <div class="curso-descripcion leccion-contenido">
                <?php the_content(); ?>
              </div>
              <section class="curso-temario" aria-labelledby="temario-titulo">
                <h2 id="temario-titulo"><?php _e('Lecciones y temas','academia-pro'); ?></h2>
                <?php if (function_exists('learndash_course_status')) { learndash_course_status(); } ?>
              </section>
            </div>
            <aside class="curso-sidebar">
              <div class="curso-card curso-cta">
                <?php if(function_exists('learndash_course_resume_link')) { echo learndash_course_resume_link(); } ?>
              </div>
              <?php if (is_active_sidebar('sidebar-cursos')) { dynamic_sidebar('sidebar-cursos'); } ?>
            </aside>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
    <aside class="lms-leccion-layout__sidebar">
      <nav aria-label="<?php esc_attr_e('Índice de la lección','academia-pro'); ?>">
        <ul class="leccion-indice"></ul>
      </nav>
      <div class="widget">
        <h3 style="margin-top:0; font-size:1rem; font-weight:600; "><?php _e('Progreso','academia-pro'); ?></h3>
        <?php if(function_exists('learndash_course_progress')) { learndash_course_progress(); } ?>
      </div>
      <?php if (is_active_sidebar('sidebar-cursos')) { dynamic_sidebar('sidebar-cursos'); } ?>
    </aside>
  </div>
</div>
<?php get_footer(); ?>
