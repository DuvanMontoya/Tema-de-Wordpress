<?php
/**
 * Funciones principales del tema Academia Pro
 *
 * @package Academia_Pro
 */

if (!defined('ABSPATH')) { exit; }

const ACADEMIA_PRO_VERSION = '1.1.2';
/**
 * Optimización: quitar jQuery en front si no es admin ni depende un plugin (heurística simple)
 */
add_action('wp_enqueue_scripts', function(){
    if (!is_admin()) {
        $depende_jquery = did_action('tutor_loaded') || defined('LEARNDASH_VERSION');
        if (!$depende_jquery) {
            wp_deregister_script('jquery');
        }
    }
}, 100);

/**
 * Añadir atributos loading="lazy" a iframes y referrerpolicy a scripts externos
 */
add_filter('the_content', function($c){
    $c = preg_replace('/<img(?![^>]*loading=)/i', '<img loading="lazy" ', $c);
    $c = preg_replace('/<iframe(?![^>]*loading=)/i', '<iframe loading="lazy" ', $c);
    return $c;
});

/**
 * Preconexiones para fuentes y CDN MathJax
 */
add_action('wp_head', function(){
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />';
    echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />';
}, 1);

/**
 * Dark mode toggle inline (añade botón accesible en body)
 */
add_action('wp_footer', function(){
    echo '<button id="modo-tema" class="boton" style="position:fixed; right:1rem; bottom:1rem; z-index:999; font-size:.75rem; padding:.55rem .9rem;">🌙</button>';
    echo '<script>(function(){const b=document.getElementById("modo-tema");if(!b)return;const k="academia-color-scheme";const r=document.documentElement;function apl(v){r.dataset.modo=v;localStorage.setItem(k,v);b.textContent=v==="oscuro"?"☀️":"🌙";}let guard=localStorage.getItem(k);if(!guard){guard=window.matchMedia("(prefers-color-scheme: dark)").matches?"oscuro":"claro";}apl(guard);b.addEventListener("click",()=>{apl(r.dataset.modo==="oscuro"?"claro":"oscuro")});})();</script>';
});

/**
 * Estilos dinámicos dark mode
 */
add_action('wp_head', function(){
    echo '<style>:root[data-modo="oscuro"]{--color-fondo:#0f141b;--color-superficie:#1c2530;--color-texto:#e2e8f0;--color-texto-suave:#94a3b8;--color-borde:#2b3947;} :root[data-modo="oscuro"] body{background:var(--color-fondo); color:var(--color-texto);} :root[data-modo="oscuro"] .site-header{background:#1c2530cc; border-color:#2b3947;} :root[data-modo="oscuro"] .curso-tarjeta, :root[data-modo="oscuro"] .quiz-contenedor, :root[data-modo="oscuro"] .lms-mensaje, :root[data-modo="oscuro"] .barra-progreso{background:#1c2530;} :root[data-modo="oscuro"] .curso-tarjeta, :root[data-modo="oscuro"] .quiz-contenedor{border-color:#2b3947;} :root[data-modo="oscuro"] .leccion-indice a{color:var(--color-texto-suave);} :root[data-modo="oscuro"] .leccion-indice a.activo{background:#203247;} :root[data-modo="oscuro"] .site-footer{background:#1c2530;} :root[data-modo="oscuro"] input, :root[data-modo="oscuro"] textarea, :root[data-modo="oscuro"] select{background:#13202d; border-color:#2b3947; color:var(--color-texto);} :root[data-modo="oscuro"] .wp-block-quote{background:#13202d;} </style>';
}, 20);

/**
 * Carga de textos
 */
function academia_pro_cargar_textdomain() {
    load_theme_textdomain('academia-pro', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'academia_pro_cargar_textdomain');

/**
 * Soportes básicos del tema
 */
// Autoload simple de archivos inc
$inc_archivos = [ 'setup', 'assets', 'lms' ];
foreach ($inc_archivos as $archivo) {
    $ruta = get_template_directory() . '/inc/' . $archivo . '.php';
    if (file_exists($ruta)) { require_once $ruta; }
}

// (Bloque de assets y función MathJax removidos; ver inc/assets.php e inc/lms.php)

/**
 * Scripts dentro del editor (para previsualizar matemáticas y estilos de bloques)
 */
// (Assets movidos a inc/assets.php)

/**
 * Área de widgets
 */
function academia_pro_widgets() {
    register_sidebar([
        'name' => __('Barra lateral cursos', 'academia-pro'),
        'id' => 'sidebar-cursos',
        'description' => __('Widgets mostrados en páginas de cursos y lecciones.', 'academia-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget__titulo">',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'academia_pro_widgets');

/**
 * Limpieza del head
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// (Helper progreso movido a inc/lms.php)

/**
 * Mitigación de avisos de traducción temprana para plugins que cargan antes de tiempo.
 * No corrige el plugin, pero re-inicializa su textdomain en init para silencio futuro.
 */
add_action('init', function(){
    $dominios = ['tutor','tutor-pro','buddyboss'];
    foreach ($dominios as $d) {
        // Si el dominio ya se intentó cargar antes de init, volvemos a invocar load_textdomain si existe el archivo.
        if (did_action('plugins_loaded')) {
            $lang_dir = WP_LANG_DIR . '/plugins/';
            $mo = $lang_dir . $d . '-' . determine_locale() . '.mo';
            if (file_exists($mo)) { load_textdomain($d, $mo); }
        }
    }
}, 20);

/**
 * Ajustes TutorLMS / LearnDash (hooks condicionales minimalistas)
 */
// (Integraciones LMS movidas a inc/lms.php)

/**
 * Plantillas sobrescritas (router simple para single lección/cursos si se desea afinar)
 */
function academia_pro_templates($template) {
    if (function_exists('tutor') && is_singular('courses')) {
        $n = locate_template(['single-curso-tutor.php']);
        if ($n) return $n;
    }
    if (defined('LEARNDASH_VERSION') && is_singular('sfwd-courses')) {
        $n = locate_template(['single-curso-learndash.php']);
        if ($n) return $n;
    }
    return $template;
}
add_filter('template_include', 'academia_pro_templates');

/**
 * Seguridad mínima: deshabilitar comentarios en adjuntos
 */
add_filter('comments_open', function($open, $post_id){
    $post = get_post($post_id);
    if ($post && $post->post_type === 'attachment') return false;
    return $open;
}, 10, 2);

/**
 * Sanitizar clases vacías en menú
 */
add_filter('nav_menu_css_class', function($classes){ return array_filter($classes); });

/**
 * Shortcode demostración de fórmula rápida [formula]E=mc^2[/formula]
 */
// (Shortcode fórmula movido a inc/lms.php)

