<?php
/**
 * Carga de assets inteligente y a prueba de choques con TutorLMS/LearnDash.
 * - Child-theme safe
 * - Aísla el dashboard de TutorLMS (layout intacto del plugin)
 * - Versionado por filemtime (cache-busting real)
 * - Resource Hints vía filtro (sin echo en <head>)
 */

if ( ! defined('ABSPATH') ) { exit; }

/* =========================================================
 * Utilidades de paths/versión (child-theme safe)
 * ======================================================= */

if ( ! defined('ACADEMIA_PRO_VERSION') ) {
    $theme = wp_get_theme();
    define('ACADEMIA_PRO_VERSION', $theme ? (string) $theme->get('Version') : '1.0.0');
}

if ( ! function_exists('academia_pro_asset_base_uri') ) {
    function academia_pro_asset_base_uri(): string {
        // get_stylesheet_* respeta child themes
        return trailingslashit( get_stylesheet_directory_uri() );
    }
}

if ( ! function_exists('academia_pro_asset_base_dir') ) {
    function academia_pro_asset_base_dir(): string {
        return trailingslashit( get_stylesheet_directory() );
    }
}

if ( ! function_exists('academia_pro_asset_path') ) {
    function academia_pro_asset_path(string $rel): string {
        return academia_pro_asset_base_uri() . ltrim($rel, '/');
    }
}

if ( ! function_exists('academia_pro_asset_ver') ) {
    function academia_pro_asset_ver(string $rel): string {
        $file = academia_pro_asset_base_dir() . ltrim($rel, '/');
        if ( file_exists($file) ) {
            return (string) filemtime($file);
        }
        return ACADEMIA_PRO_VERSION;
    }
}

/* =========================================================
 * Contextos
 * ======================================================= */

/** Login/registro (páginas propias o wp-login.php) - MEJORADA */
if ( ! function_exists('academia_pro_is_login_context') ) {
    function academia_pro_is_login_context(): bool {
        // Detección más robusta para evitar problemas con plugins

        // 1. Página con plantilla de login
        if ( function_exists('is_page_template') && is_page_template('page-login.php') ) {
            return true;
        }

        // 2. Páginas por slug (incluyendo variaciones comunes)
        if ( function_exists('is_page') ) {
            $login_slugs = array(
                'acceso', 'registro', 'entrar', 'login', 'register', 'sign-in', 'sign-up',
                'mi-cuenta', 'my-account', 'auth', 'authentication', 'signin', 'signup'
            );
            if ( is_page( $login_slugs ) ) {
                return true;
            }

            // 3. Buscar página por título también
            $page = get_post();
            if ( $page && is_page() ) {
                $login_titles = array(
                    'Acceso', 'Login', 'Registro', 'Sign In', 'Sign Up', 'Mi Cuenta',
                    'Authentication', 'Auth', 'Entrar', 'Registrar'
                );
                $title = strtolower( $page->post_title );
                foreach ( $login_titles as $login_title ) {
                    if ( str_contains( $title, strtolower( $login_title ) ) ) {
                        return true;
                    }
                }
            }
        }

        // 4. Detección por URL (último recurso)
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $uri_lower = strtolower( $uri );
        $login_paths = array(
            '/acceso', '/login', '/register', '/signin', '/signup', '/auth',
            '/registro', '/entrar', '/mi-cuenta', '/my-account'
        );
        foreach ( $login_paths as $path ) {
            if ( str_contains( $uri_lower, $path ) ) {
                return true;
            }
        }

        // 5. Detección por wp-login.php (incluyendo variaciones)
        $pagenow = $GLOBALS['pagenow'] ?? '';
        if ( $pagenow === 'wp-login.php' ) {
            // Excluir acciones específicas que no necesitan nuestros estilos
            $action = $_REQUEST['action'] ?? '';
            $excluded_actions = array('logout', 'lostpassword', 'rp', 'resetpass', 'postpass');
            if ( ! in_array( $action, $excluded_actions, true ) ) {
                return true;
            }
        }

        return false;
    }
}

/** Dashboard de TutorLMS (detección robusta + cache local) */
if ( ! function_exists('academia_pro_is_tutor_dashboard') ) {
    function academia_pro_is_tutor_dashboard(): bool {
        static $cached = null;
        if ( $cached !== null ) { return $cached; }
        $is = false;

        if ( function_exists('is_page') ) {
            if ( is_page( array('dashboard','perfil','mi-perfil','tutor-dashboard','student-dashboard','escritorio') ) ) {
                $is = true;
            }
        }

        // Heurísticas propias de TutorLMS
        if ( function_exists('tutor') ) {
            // Algunos builds exponen tutor_utils()->is_tutor_dashboard()
            if ( function_exists('tutor_utils') && method_exists( tutor_utils(), 'is_tutor_dashboard' ) ) {
                $is = $is || (bool) tutor_utils()->is_tutor_dashboard();
            }
            if ( method_exists( tutor(), 'is_tutor_dashboard' ) ) {
                $is = $is || (bool) tutor()->is_tutor_dashboard();
            }
            global $wp_query;
            if ( isset($wp_query->query_vars['tutor_dashboard_page']) || isset($_GET['tutor_dashboard_page']) ) {
                $is = true;
            }
        }

        // Página con shortcode del dashboard
        if ( ! $is && function_exists('get_post') && function_exists('has_shortcode') ) {
            $p = get_post();
            if ( $p && has_shortcode( (string) $p->post_content, 'tutor_dashboard' ) ) {
                $is = true;
            }
        }

        // Patrón de URL (último recurso)
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        if ( $uri && ( str_contains($uri, '/dashboard') || str_contains($uri, '/student-dashboard') || str_contains($uri, '/escritorio') ) ) {
            $is = true;
        }

        $cached = $is;
        return $cached;
    }
}

/* =========================================================
 * Enqueue público (front)
 * ======================================================= */

function academia_pro_enqueue_public(): void {
    // Aislar temprano el dashboard de TutorLMS
    $IS_TUTOR_DASHBOARD = function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard();

    if ( $IS_TUTOR_DASHBOARD ) {
        // Dashboard TUTORLMS: 100% nativo (no cargar assets del tema)
        return;
    }

    /* — Fuentes (capa pública) — */
    wp_enqueue_style(
        'academia-pro-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700;900&display=swap',
        [],
        null
    );

    /* — 1) Estilo base principal (style.css) — */
    wp_enqueue_style(
        'academia-pro-style',
        get_stylesheet_uri(),
        [],
        academia_pro_asset_ver('style.css')
    );

    // — 1b) Utilidades atómicas
    $rel_utils = 'assets/css/utilities.css';
    wp_enqueue_style(
        'academia-pro-utilities',
        academia_pro_asset_path($rel_utils),
        array('academia-pro-style'),
        academia_pro_asset_ver($rel_utils)
    );

    /* — 2) Módulos globales — */
    $mods = array(
        'academia-pro-header-footer' => 'assets/css/header-footer.css',
        'academia-pro-forms'         => 'assets/css/forms.css',
        'academia-pro-pages'         => 'assets/css/pages.css',
        'academia-pro-bloques'       => 'assets/css/bloques.css',
    );
    foreach ( $mods as $handle => $relpath ) {
        wp_enqueue_style(
            $handle,
            academia_pro_asset_path($relpath),
            array('academia-pro-style'),
            academia_pro_asset_ver($relpath)
        );
    }

    // — 2b) Matemáticas editoriales (MathJax polish)
    $rel_math = 'assets/css/math.css';
    wp_enqueue_style(
        'academia-pro-math',
        academia_pro_asset_path($rel_math),
        array('academia-pro-style'),
        academia_pro_asset_ver($rel_math)
    );

    // — 2c) Estilos de impresión (solo medio print)
    $rel_print = 'assets/css/print.css';
    wp_enqueue_style(
        'academia-pro-print',
        academia_pro_asset_path($rel_print),
        array(),
        academia_pro_asset_ver($rel_print),
        'print'
    );

    /* — 3) Blog y comentarios — */
    if ( is_home() || is_archive() || is_singular('post') || is_category() || is_tag() || is_author() || is_date() ) {
        $rel = 'assets/css/blog.css';
        wp_enqueue_style(
            'academia-pro-blog',
            academia_pro_asset_path($rel),
            array('academia-pro-style'),
            academia_pro_asset_ver($rel)
        );
    }

    if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
        $rel = 'assets/css/comments.css';
        wp_enqueue_style(
            'academia-pro-comments',
            academia_pro_asset_path($rel),
            array('academia-pro-style'),
            academia_pro_asset_ver($rel)
        );
    }

    /* — 4) TutorLMS — */
    if ( function_exists('tutor') ) {
        // Integración general (sin forzar fixes en single curso para no romper el layout del plugin)
        $rel_ui   = 'assets/css/tutor-ui.css';
        $rel_card = 'assets/css/tutor-cards.css';
        $rel_lms  = 'assets/css/lms.css';

        wp_enqueue_style('academia-pro-tutor-ui',    academia_pro_asset_path($rel_ui),   array('academia-pro-style','academia-pro-utilities'), academia_pro_asset_ver($rel_ui));
        wp_enqueue_style('academia-pro-tutor-cards', academia_pro_asset_path($rel_card), array('academia-pro-tutor-ui'), academia_pro_asset_ver($rel_card));
        wp_enqueue_style('academia-pro-lms',         academia_pro_asset_path($rel_lms),  array('academia-pro-tutor-ui','academia-pro-pages'), academia_pro_asset_ver($rel_lms));

        // Archive de cursos
        if ( is_post_type_archive('courses') || is_tax('course-category') || is_tax('course-tag') ) {
            $rel = 'assets/css/courses-archive.css';
            wp_enqueue_style(
                'academia-pro-courses-archive',
                academia_pro_asset_path($rel),
                array('academia-pro-tutor-ui'),
                academia_pro_asset_ver($rel)
            );
        }
    }

    /* — 5) LearnDash — */
    if ( defined('LEARNDASH_VERSION') ) {
        $rel_ld  = 'assets/css/learndash-ui.css';
        $rel_lms = 'assets/css/lms.css';
        wp_enqueue_style('academia-pro-learndash-ui', academia_pro_asset_path($rel_ld), array('academia-pro-style'), academia_pro_asset_ver($rel_ld));
        wp_enqueue_style('academia-pro-lms',          academia_pro_asset_path($rel_lms), array('academia-pro-learndash-ui'), academia_pro_asset_ver($rel_lms));
    }

    /* — 6) Auth — MEJORADO */
    $is_login_context = academia_pro_is_login_context();

    // Debug: Log si estamos en contexto de login
    if ( $is_login_context ) {
        error_log('Academia Pro: Cargando CSS de autenticación');

        $rel = 'assets/css/auth.css';
        $auth_style = wp_enqueue_style(
            'academia-pro-auth',
            academia_pro_asset_path($rel),
            array('academia-pro-style'),
            academia_pro_asset_ver($rel)
        );

        // Verificar si se cargó correctamente
        if ( ! $auth_style ) {
            error_log('Academia Pro: Error al cargar CSS de autenticación, intentando inline');
        }
    }

    /* — 7) JS del tema — */
    $rel_js = 'assets/js/tema.js';
    wp_enqueue_script(
        'academia-pro-tema',
        academia_pro_asset_path($rel_js),
        array(),
        academia_pro_asset_ver($rel_js),
        array('in_footer' => true, 'strategy' => 'defer')
    );

    // JS crítico para header (menú móvil, dropdown usuario)
    $rel_header_js = 'assets/js/header.js';
    wp_enqueue_script(
        'academia-pro-header',
        academia_pro_asset_path($rel_header_js),
        array(),
        academia_pro_asset_ver($rel_header_js),
        array('in_footer' => true, 'strategy' => 'defer')
    );

    if ( is_singular('courses') || is_singular('sfwd-courses') ) {
        $rel_js_course = 'assets/js/course-single.js';
        wp_enqueue_script(
            'academia-pro-course-single',
            academia_pro_asset_path($rel_js_course),
            array(),
            academia_pro_asset_ver($rel_js_course),
            array('in_footer' => true, 'strategy' => 'defer')
        );
    }

    /* — 8) MathJax GLOBAL - Siempre cargado para renderizado universal — */
    // MathJax se carga globalmente para permitir matemáticas en cualquier parte de la plataforma
    wp_enqueue_script(
        'mathjax',
        'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js',
        array(),
        null,
        array('in_footer' => false, 'strategy' => 'defer') // En head para disponibilidad inmediata
    );
    
    // La configuración se añade via wp_head en inc/lms.php (academia_pro_configurar_mathjax_global)
}
add_action('wp_enqueue_scripts', 'academia_pro_enqueue_public');

/* =========================================================
 * Purga agresiva SOLO dentro del dashboard de TutorLMS
 * (corrige choques de theme.json y estilos globales)
 * ======================================================= */

function academia_pro_tutor_dashboard_purify(): void {
    if ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) {
        // Estilos de bloques / theme.json
        wp_dequeue_style('global-styles');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('classic-theme-styles');
    // Conservamos estilos del tema que encolamos explícitamente (header-footer, dashboard)
    }
}
// Prioridad muy alta para ejecutar después de casi todo
add_action('wp_enqueue_scripts', 'academia_pro_tutor_dashboard_purify', 1000);

/* =========================================================
 * Purga para SINGLE de curso (TutorLMS)
 * Deja el layout por defecto del plugin, retirando CSS del tema que interfiere
 * ======================================================= */

function academia_pro_tutor_single_reset(): void {
    if ( function_exists('tutor') && is_singular('courses') ) {
        // Estilos del tema a retirar en single de curso
        $styles = array(
            'academia-pro-utilities',
            'academia-pro-forms',
            'academia-pro-pages',
            'academia-pro-bloques',
            'academia-pro-math',
            'academia-pro-blog',
            'academia-pro-comments',
            'academia-pro-tutor-ui',
            'academia-pro-tutor-cards',
            'academia-pro-lms',
            'academia-pro-learndash-ui',
        );
        foreach ( $styles as $handle ) {
            if ( wp_style_is( $handle, 'enqueued' ) ) {
                wp_dequeue_style( $handle );
            }
        }

        // JS opcional del tema para curso (retirarlo por seguridad)
        $scripts = array('academia-pro-course-single');
        foreach ( $scripts as $handle ) {
            if ( wp_script_is( $handle, 'enqueued' ) ) {
                wp_dequeue_script( $handle );
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'academia_pro_tutor_single_reset', 1001);

/* =========================================================
 * Resource Hints (preconnect/dns-prefetch) sin echo en <head>
 * ======================================================= */

function academia_pro_resource_hints( array $urls, string $relation_type ): array {
    // Fonts (siempre que cargamos Google Fonts)
    if ( in_array( $relation_type, array('preconnect','dns-prefetch'), true ) ) {
        if ( wp_style_is('academia-pro-fonts', 'enqueued') ) {
            $urls[] = 'https://fonts.gstatic.com';
            $urls[] = 'https://fonts.googleapis.com';
        }
    }

    // YouTube para single de curso con video (usa meta 'curso_video_youtube')
    if ( ( is_singular('courses') || is_singular('sfwd-courses') ) && function_exists('get_post_meta') ) {
        $video = get_post_meta( get_the_ID(), 'curso_video_youtube', true );
        if ( ! empty($video) ) {
            if ( $relation_type === 'preconnect' ) {
                $urls[] = 'https://www.youtube.com';
                $urls[] = 'https://i.ytimg.com';
            } elseif ( $relation_type === 'dns-prefetch' ) {
                $urls[] = '//www.youtube.com';
                $urls[] = '//i.ytimg.com';
            }
        }
    }

    // Deduplicar manteniendo orden
    return array_values( array_unique( $urls ) );
}
add_filter('wp_resource_hints', 'academia_pro_resource_hints', 10, 2);

/* =========================================================
 * Editor (Gutenberg) — estilos y JS del editor
 * ======================================================= */

function academia_pro_editor_assets_mod(): void {
    add_editor_style('style.css');
    add_editor_style('assets/css/bloques.css');
    add_editor_style('assets/css/pages.css');
    add_editor_style('assets/css/forms.css');
    add_editor_style('assets/css/math.css');

    $rel = 'assets/js/editor.js';
    wp_enqueue_script(
        'academia-pro-editor',
        academia_pro_asset_path($rel),
        array('wp-blocks','wp-dom'),
        academia_pro_asset_ver($rel),
        array('in_footer' => true, 'strategy' => 'defer')
    );
}
add_action('enqueue_block_editor_assets', 'academia_pro_editor_assets_mod');
