<?php
/** Plantilla single para cursos TutorLMS con diseño premium */
if (!defined('ABSPATH')) { exit; }
get_header();
?>

<div class="lesson-container">
  <div class="lesson-breadcrumb">
    <div class="breadcrumb-content">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="breadcrumb-link">
        🏠 Inicio
      </a>
      <span class="breadcrumb-separator">›</span>
      <a href="<?php echo esc_url(get_post_type_archive_link('courses')); ?>" class="breadcrumb-link">
        📚 Cursos
      </a>
      <span class="breadcrumb-separator">›</span>
      <span class="breadcrumb-current">
        📖 <?php the_title(); ?>
      </span>
    </div>
  </div>

  <div class="lesson-layout">
    <main class="lesson-main">
      <?php while (have_posts()) : the_post(); ?>
        <article id="curso-<?php the_ID(); ?>" <?php post_class('lesson-article'); ?>>
          <header class="lesson-header">
            <div class="lesson-meta">
              <span class="lesson-number"><?php echo get_post_meta(get_the_ID(), 'course_level', true) ?: 'Curso'; ?></span>
              <div class="status-indicator status-completed">
                ✅ Completado
              </div>
            </div>
            <h1 class="lesson-title"><?php the_title(); ?></h1>
            <div class="lesson-progress">
              <div class="progress-info">
                <span>Progreso del curso</span>
                <span>75%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 75%;"></div>
              </div>
            </div>
          </header>

          <div class="lesson-content">
            <div class="lesson-content-wrapper">
              <?php the_content(); ?>
            </div>
          </div>

          <section class="lesson-topics">
            <h2 class="section-title"><?php _e('Contenido del curso','academia-pro'); ?></h2>
            <?php if(function_exists('tutor_course_topics')) { tutor_course_topics(); } ?>
          </section>
        </article>
      <?php endwhile; ?>
    </main>

    <aside class="lesson-sidebar">
      <nav class="lesson-index" aria-label="<?php esc_attr_e('Índice del curso','academia-pro'); ?>">
        <h3 class="sidebar-title">📋 Índice del Curso</h3>
        <ul class="lesson-index-list">
          <li class="lesson-index-item active">
            <a href="#lesson-1" class="lesson-index-link">
              <span class="lesson-index-number">1</span>
              <span class="lesson-index-title">Introducción al curso</span>
              <span class="lesson-index-status">✅</span>
            </a>
          </li>
          <li class="lesson-index-item">
            <a href="#lesson-2" class="lesson-index-link">
              <span class="lesson-index-number">2</span>
              <span class="lesson-index-title">Conceptos básicos</span>
              <span class="lesson-index-status">⏳</span>
            </a>
          </li>
          <li class="lesson-index-item">
            <a href="#lesson-3" class="lesson-index-link">
              <span class="lesson-index-number">3</span>
              <span class="lesson-index-title">Ejercicios prácticos</span>
              <span class="lesson-index-status">🔒</span>
            </a>
          </li>
        </ul>
      </nav>

      <div class="lesson-progress-widget">
        <h3 class="sidebar-title">📊 Progreso</h3>
        <?php if (function_exists('tutor_utils')) {
          $course_id = get_the_ID();
          $percent = tutor_utils()->get_course_completed_percent($course_id, get_current_user_id());
          academia_pro_render_progreso($percent);
        } ?>
      </div>

      <div class="lesson-resources">
        <h3 class="sidebar-title">📎 Recursos</h3>
        <ul class="resource-list">
          <li><a href="#" class="resource-link">📄 Guía del estudiante</a></li>
          <li><a href="#" class="resource-link">🎥 Videos complementarios</a></li>
          <li><a href="#" class="resource-link">📚 Material adicional</a></li>
        </ul>
      </div>

      <?php if (is_active_sidebar('sidebar-cursos')) : ?>
        <div class="lesson-widgets">
          <?php dynamic_sidebar('sidebar-cursos'); ?>
        </div>
      <?php endif; ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>
