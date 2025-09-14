<?php
/** Parte de plantilla: Lección TutorLMS ultra-moderna */
if (!defined('ABSPATH')) { exit; }

$lesson_id = get_the_ID();
$course_id = get_post_meta($lesson_id, '_lesson_course', true);
$course = $course_id ? get_post($course_id) : null;
$is_completed = false;
$lesson_number = get_post_field('menu_order', $lesson_id);

// Obtener datos del progreso si el usuario está logueado
if (is_user_logged_in()) {
    // Aquí puedes integrar con TutorLMS o LearnDash para obtener el estado real
    $is_completed = false; // Placeholder - integrar con LMS real
}

// Obtener lecciones del curso para navegación
$course_lessons = array();
if ($course_id) {
    $course_lessons = get_posts(array(
        'post_type' => 'lesson',
        'meta_key' => '_lesson_course',
        'meta_value' => $course_id,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'numberposts' => -1
    ));
}

$current_lesson_index = -1;
foreach ($course_lessons as $index => $lesson) {
    if ($lesson->ID == $lesson_id) {
        $current_lesson_index = $index;
        break;
    }
}

$prev_lesson = $current_lesson_index > 0 ? $course_lessons[$current_lesson_index - 1] : null;
$next_lesson = $current_lesson_index < count($course_lessons) - 1 ? $course_lessons[$current_lesson_index + 1] : null;
?>

<div class="lesson-container">
    <!-- Breadcrumb elegante -->
    <nav class="lesson-breadcrumb" aria-label="<?php _e('Navegación del curso', 'academia-pro'); ?>">
        <div class="breadcrumb-content">
            <?php if ($course): ?>
                <a href="<?php echo esc_url(get_permalink($course_id)); ?>" class="breadcrumb-link">
                    <span class="breadcrumb-icon">📚</span>
                    <span class="breadcrumb-text"><?php echo esc_html($course->post_title); ?></span>
                </a>
                <span class="breadcrumb-separator">›</span>
            <?php endif; ?>
            <span class="breadcrumb-current">
                <span class="breadcrumb-icon">🎯</span>
                <span class="breadcrumb-text"><?php _e('Lección', 'academia-pro'); ?> #<?php echo esc_html($lesson_number); ?></span>
            </span>
        </div>
    </nav>

    <!-- Layout principal con sidebar -->
    <div class="lesson-layout">
        <!-- Contenido principal -->
        <main class="lesson-main">
            <article id="lesson-<?php echo esc_attr($lesson_id); ?>" <?php post_class('lesson-article'); ?>>
                
                <!-- Header de la lección -->
                <header class="lesson-header">
                    <div class="lesson-header-content">
                        <div class="lesson-meta">
                            <span class="lesson-number">
                                <?php _e('Lección', 'academia-pro'); ?> #<?php echo esc_html($lesson_number); ?>
                            </span>
                            <?php if (is_user_logged_in()): ?>
                                <div class="lesson-status">
                                    <div class="status-indicator <?php echo $is_completed ? 'status-completed' : 'status-pending'; ?>" 
                                         data-lesson="<?php echo esc_attr($lesson_id); ?>" 
                                         id="lesson-status">
                                        <span class="status-icon"><?php echo $is_completed ? '✓' : '○'; ?></span>
                                        <span class="status-text">
                                            <?php echo $is_completed ? __('Completada', 'academia-pro') : __('Pendiente', 'academia-pro'); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="lesson-title"><?php the_title(); ?></h1>
                        
                        <!-- Barra de progreso del curso -->
                        <?php if ($course && count($course_lessons) > 0): ?>
                            <div class="lesson-progress">
                                <div class="progress-info">
                                    <span class="progress-text">
                                        <?php printf(__('%d de %d lecciones', 'academia-pro'), 
                                                   $current_lesson_index + 1, 
                                                   count($course_lessons)); ?>
                                    </span>
                                    <span class="progress-percentage">
                                        <?php echo round((($current_lesson_index + 1) / count($course_lessons)) * 100); ?>%
                                    </span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" 
                                         style="width: <?php echo round((($current_lesson_index + 1) / count($course_lessons)) * 100); ?>%"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Contenido de la lección -->
                <div class="lesson-content">
                    <div class="lesson-content-wrapper">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Navegación entre lecciones -->
                <nav class="lesson-navigation" aria-label="<?php _e('Navegación de lecciones', 'academia-pro'); ?>">
                    <div class="lesson-nav-grid">
                        <?php if ($prev_lesson): ?>
                            <a href="<?php echo esc_url(get_permalink($prev_lesson->ID)); ?>" 
                               class="lesson-nav-button lesson-nav-prev">
                                <div class="nav-button-content">
                                    <span class="nav-button-icon">←</span>
                                    <div class="nav-button-text">
                                        <span class="nav-button-label"><?php _e('Anterior', 'academia-pro'); ?></span>
                                        <span class="nav-button-title"><?php echo esc_html($prev_lesson->post_title); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <div class="lesson-nav-placeholder"></div>
                        <?php endif; ?>

                        <!-- Botón completar lección -->
                        <?php if (is_user_logged_in() && !$is_completed): ?>
                            <button class="lesson-complete-button" 
                                    data-lesson="<?php echo esc_attr($lesson_id); ?>"
                                    type="button">
                                <span class="complete-button-icon">✓</span>
                                <span class="complete-button-text"><?php _e('Marcar como completada', 'academia-pro'); ?></span>
                            </button>
                        <?php endif; ?>

                        <?php if ($next_lesson): ?>
                            <a href="<?php echo esc_url(get_permalink($next_lesson->ID)); ?>" 
                               class="lesson-nav-button lesson-nav-next">
                                <div class="nav-button-content">
                                    <div class="nav-button-text">
                                        <span class="nav-button-label"><?php _e('Siguiente', 'academia-pro'); ?></span>
                                        <span class="nav-button-title"><?php echo esc_html($next_lesson->post_title); ?></span>
                                    </div>
                                    <span class="nav-button-icon">→</span>
                                </div>
                            </a>
                        <?php else: ?>
                            <div class="lesson-nav-placeholder"></div>
                        <?php endif; ?>
                    </div>
                </nav>

            </article>
        </main>

        <!-- Sidebar del curso -->
        <aside class="lesson-sidebar">
            <div class="sidebar-sticky">
                
                <!-- Información del curso -->
                <?php if ($course): ?>
                    <div class="course-info-card">
                        <div class="course-info-header">
                            <h3 class="course-info-title">
                                <span class="course-icon">📚</span>
                                <?php _e('Curso actual', 'academia-pro'); ?>
                            </h3>
                        </div>
                        <div class="course-info-content">
                            <h4 class="course-name">
                                <a href="<?php echo esc_url(get_permalink($course_id)); ?>">
                                    <?php echo esc_html($course->post_title); ?>
                                </a>
                            </h4>
                            <?php if (count($course_lessons) > 0): ?>
                                <div class="course-progress-mini">
                                    <div class="progress-text">
                                        <?php printf(__('%d/%d lecciones', 'academia-pro'), 
                                                   $current_lesson_index + 1, 
                                                   count($course_lessons)); ?>
                                    </div>
                                    <div class="progress-bar-mini">
                                        <div class="progress-fill-mini" 
                                             style="width: <?php echo round((($current_lesson_index + 1) / count($course_lessons)) * 100); ?>%"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Lista de lecciones -->
                <?php if (count($course_lessons) > 0): ?>
                    <div class="lessons-list-card">
                        <div class="lessons-list-header">
                            <h3 class="lessons-list-title">
                                <span class="lessons-icon">📋</span>
                                <?php _e('Contenido del curso', 'academia-pro'); ?>
                            </h3>
                        </div>
                        <div class="lessons-list">
                            <?php foreach ($course_lessons as $index => $lesson): ?>
                                <div class="lesson-item <?php echo $lesson->ID == $lesson_id ? 'lesson-item-current' : ''; ?>">
                                    <a href="<?php echo esc_url(get_permalink($lesson->ID)); ?>" 
                                       class="lesson-item-link">
                                        <div class="lesson-item-content">
                                            <div class="lesson-item-number"><?php echo $index + 1; ?></div>
                                            <div class="lesson-item-info">
                                                <h4 class="lesson-item-title"><?php echo esc_html($lesson->post_title); ?></h4>
                                                <div class="lesson-item-meta">
                                                    <span class="lesson-duration">
                                                        🕐 <?php _e('5 min', 'academia-pro'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="lesson-item-status">
                                                <?php if ($lesson->ID == $lesson_id): ?>
                                                    <span class="status-current">▶</span>
                                                <?php else: ?>
                                                    <span class="status-pending">○</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Recursos adicionales -->
                <div class="lesson-resources-card">
                    <div class="resources-header">
                        <h3 class="resources-title">
                            <span class="resources-icon">📎</span>
                            <?php _e('Recursos', 'academia-pro'); ?>
                        </h3>
                    </div>
                    <div class="resources-list">
                        <a href="#" class="resource-item">
                            <span class="resource-icon">📄</span>
                            <span class="resource-text"><?php _e('Material descargable', 'academia-pro'); ?></span>
                        </a>
                        <a href="#" class="resource-item">
                            <span class="resource-icon">💬</span>
                            <span class="resource-text"><?php _e('Foro de discusión', 'academia-pro'); ?></span>
                        </a>
                        <a href="#" class="resource-item">
                            <span class="resource-icon">❓</span>
                            <span class="resource-text"><?php _e('Preguntas frecuentes', 'academia-pro'); ?></span>
                        </a>
                    </div>
                </div>

            </div>
        </aside>
    </div>
</div>
