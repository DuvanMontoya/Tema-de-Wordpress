<?php
if ( ! defined('ABSPATH') ) { exit; }

/* =========================================================
 * 1) MathJax GLOBAL - Renderizado matemático universal
 * ======================================================= */

/**
 * Configuración MathJax global optimizada
 * Permite renderizado matemático en toda la plataforma:
 * - Lecciones y cursos
 * - Posts y páginas
 * - Comentarios
 * - Dashboard y widgets
 * - Cualquier contenido dinámico
 */
function academia_pro_debe_cargar_mathjax() : bool {
    // FORZAR CARGA GLOBAL: MathJax siempre disponible
    // El usuario solicitó renderizado "absolutamente global"
    $cargar_global = true;
    
    // Permitir filtro para casos especiales donde se quiera desactivar
    return (bool) apply_filters('academia_pro/debe_cargar_mathjax', $cargar_global, get_post());
}

/**
 * Configuración avanzada de MathJax v3
 * Soporte completo para LaTeX, AMS Math, y símbolos matemáticos
 */
function academia_pro_configurar_mathjax_global() {
    ?>
    <script type="text/javascript">
        // Configuración MathJax v3 optimizada para plataforma educativa
        window.MathJax = {
            // Configuración TeX
            tex: {
                // Delimitadores inline y display
                inlineMath: [
                    ['$', '$'],           // $math$
                    ['\\(', '\\)']        // \(math\)
                ],
                displayMath: [
                    ['$$', '$$'],         // $$math$$
                    ['\\[', '\\]']        // \[math\]
                ],
                
                // Entornos automáticos de LaTeX
                autoload: {
                    color: [],            // Colores
                    colorV2: ['color'],   // Colores v2
                    cancel: ['cancel', 'bcancel', 'xcancel', 'cancelto'],
                    bbox: ['bbox'],
                    html: ['html'],
                    boldsymbol: ['boldsymbol']
                },
                
                // Paquetes adicionales
                packages: {
                    '[+]': [
                        'base',
                        'ams',               // AMS Math
                        'newcommand',        // Comandos personalizados
                        'configmacros',      // Macros de configuración
                        'action',            // Acciones
                        'unicode',           // Unicode
                        'color',             // Colores
                        'cancel',            // Tachado/cancelado
                        'html',              // HTML dentro de math
                        'bbox',              // Cajas
                        'boldsymbol',        // Símbolos en negrita
                        'physics'            // Paquete physics para derivadas, etc.
                    ]
                },
                
                // Comandos personalizados útiles para matemáticas
                macros: {
                    // Vectores y matrices
                    'vec': ['\\mathbf{#1}', 1],
                    'mat': ['\\mathbf{#1}', 1],
                    
                    // Conjuntos comunes
                    'R': '\\mathbb{R}',
                    'C': '\\mathbb{C}',
                    'N': '\\mathbb{N}',
                    'Z': '\\mathbb{Z}',
                    'Q': '\\mathbb{Q}',
                    
                    // Operadores comunes
                    'grad': '\\nabla',
                    'div': '\\nabla\\cdot',
                    'curl': '\\nabla\\times',
                    'lap': '\\nabla^2',
                    
                    // Derivadas
                    'dd': ['\\frac{d#1}{d#2}', 2],
                    'pp': ['\\frac{\\partial#1}{\\partial#2}', 2],
                    
                    // Integrales
                    'integral': ['\\int_{#1}^{#2}', 2],
                    
                    // Límites
                    'limite': ['\\lim_{#1 \\to #2}', 2],
                    
                    // Estadística
                    'Prob': '\\text{P}',
                    'Exp': '\\text{E}',
                    'Var': '\\text{Var}',
                    
                    // Química (útil para ciencias)
                    'ce': ['\\text{#1}', 1]
                },
                
                // Procesamiento automático
                processEscapes: true,     // Procesar escapes
                processEnvironments: true, // Procesar entornos
                processRefs: true,        // Procesar referencias
                
                // Tags para ecuaciones numeradas
                tags: 'ams',              // Usar numeración AMS
                tagSide: 'right',         // Números a la derecha
                tagIndent: '.8em',        // Indentación
                
                // Configuraciones de formato
                formatError: function (jax, err) {
                    console.warn('MathJax Error:', err);
                    return jax.formatError(err);
                }
            },
            
            // Configuración MathML
            mathml: {
                displayAlign: 'center',   // Alineación
                displayIndent: '0'        // Sin indentación
            },
            
            // Configuración CHTML
            chtml: {
                scale: 1,                 // Escala base
                minScale: 0.5,            // Escala mínima
                matchFontHeight: false,   // No emparejar altura de fuente
                fontURL: 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/output/chtml/fonts/woff-v2'
            },
            
            // Configuración SVG (alternativa)
            svg: {
                scale: 1,
                minScale: 0.5,
                fontCache: 'local'
            },
            
            // Configuración del renderizador
            options: {
                // Desactivar menú contextual (opcional)
                renderActions: {
                    addMenu: []
                },
                
                // Configuración de procesamiento
                processHtmlClass: 'tex2jax_process|mathjax_process',
                processScriptType: 'math/tex',
                
                // Configuración responsiva
                menuOptions: {
                    settings: {
                        zoom: 'Click',
                        CTRL: false,
                        ALT: false,
                        CMD: false,
                        Shift: false
                    }
                }
            },
            
            // Configuración del loader
            loader: {
                load: [
                    '[tex]/ams',
                    '[tex]/newcommand',
                    '[tex]/configmacros',
                    '[tex]/action',
                    '[tex]/unicode',
                    '[tex]/color',
                    '[tex]/cancel',
                    '[tex]/html',
                    '[tex]/bbox',
                    '[tex]/boldsymbol'
                ]
            },
            
            // Configuración de startup
            startup: {
                // Procesar página al cargar
                typeset: true,
                
                // Función de inicialización personalizada
                ready: function () {
                    MathJax.startup.defaultReady();
                    
                    // Callback personalizado post-renderizado
                    MathJax.startup.document.state(80);
                    
                    // Configurar observer para contenido dinámico
                    if (typeof MutationObserver !== 'undefined') {
                        const observer = new MutationObserver(function(mutations) {
                            let shouldReprocess = false;
                            
                            mutations.forEach(function(mutation) {
                                // Solo reprocesar si se añadieron nodos con contenido
                                if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                                    for (let node of mutation.addedNodes) {
                                        if (node.nodeType === 1) { // Element node
                                            // Buscar contenido matemático
                                            const mathContent = node.textContent || '';
                                            if (mathContent.includes('$') || 
                                                mathContent.includes('\\(') || 
                                                mathContent.includes('\\[') ||
                                                mathContent.includes('\\begin{')) {
                                                shouldReprocess = true;
                                                break;
                                            }
                                        }
                                    }
                                }
                            });
                            
                            if (shouldReprocess) {
                                // Debounce para evitar reprocesamiento excesivo
                                clearTimeout(window.mathJaxReprocessTimeout);
                                window.mathJaxReprocessTimeout = setTimeout(function() {
                                    MathJax.typesetPromise().catch(function(err) {
                                        console.warn('Error en reprocesamiento MathJax:', err);
                                    });
                                }, 100);
                            }
                        });
                        
                        // Observar cambios en todo el document
                        observer.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                        
                        // Guardar referencia para cleanup si es necesario
                        window.mathJaxObserver = observer;
                    }
                    
                    // Añadir estilos CSS personalizados para math
                    const style = document.createElement('style');
                    style.textContent = `
                        /* Estilos MathJax personalizados */
                        .MathJax {
                            outline: none !important;
                        }
                        
                        /* Math inline */
                        .MathJax[jax="CHTML"][display="false"] {
                            display: inline !important;
                            margin: 0 2px !important;
                        }
                        
                        /* Math display */
                        .MathJax[jax="CHTML"][display="true"] {
                            display: block !important;
                            margin: 1em auto !important;
                            text-align: center !important;
                        }
                        
                        /* Contenedores de fórmulas */
                        .formula-inline {
                            display: inline-block;
                            margin: 0 0.2em;
                        }
                        
                        .formula-display {
                            display: block;
                            margin: 1.5em auto;
                            text-align: center;
                            padding: 1em;
                            background: var(--color-surface-secondary, #f8fafc);
                            border-radius: 8px;
                            border: 1px solid var(--color-border-primary, #e2e8f0);
                        }
                        
                        /* Responsive */
                        @media (max-width: 768px) {
                            .MathJax[jax="CHTML"] {
                                font-size: 90% !important;
                            }
                            
                            .formula-display {
                                padding: 0.5em;
                                margin: 1em auto;
                            }
                        }
                    `;
                    document.head.appendChild(style);
                    
                    console.log('MathJax Academia Pro: Configuración global activada');
                }
            }
        };
        
        // Función global para forzar reprocesamiento
        window.academiaProReprocessMath = function(element) {
            const target = element || document;
            return MathJax.typesetPromise([target]).catch(function(err) {
                console.warn('Error en reprocesamiento manual:', err);
            });
        };
        
        // Función para procesar contenido AJAX
        window.academiaProProcessNewContent = function(content) {
            if (typeof content === 'string') {
                const div = document.createElement('div');
                div.innerHTML = content;
                return window.academiaProReprocessMath(div);
            } else if (content && content.nodeType) {
                return window.academiaProReprocessMath(content);
            }
        };
        
        // Integración con eventos comunes de WordPress
        document.addEventListener('DOMContentLoaded', function() {
            // Reprocesar después de cargas AJAX comunes
            jQuery && jQuery(document).on('post-load', function() {
                window.academiaProReprocessMath();
            });
            
            // Integración con TutorLMS
            if (window.tutor_utils) {
                jQuery(document).on('tutor_lesson_loaded tutor_quiz_loaded', function() {
                    setTimeout(() => window.academiaProReprocessMath(), 100);
                });
            }
            
            // Integración con LearnDash
            if (window.learndash_data) {
                jQuery(document).on('learndash_topic_completed learndash_lesson_video_complete', function() {
                    setTimeout(() => window.academiaProReprocessMath(), 100);
                });
            }
            
            // Reprocesar en tabs/acordeones
            jQuery(document).on('shown.bs.tab shown.bs.collapse', function() {
                setTimeout(() => window.academiaProReprocessMath(), 50);
            });
        });
    </script>
    <?php
}

/**
 * Hook para cargar MathJax SIEMPRE en el frontend
 */
add_action('wp_head', 'academia_pro_configurar_mathjax_global', 5);

// La carga del script MathJax se realiza en inc/assets.php mediante wp_enqueue_script('mathjax').

/* =========================================================
 * 2) Clases de <body> para integraciones LMS (un único filtro)
 * ======================================================= */
function academia_pro_body_classes( array $classes ) : array {
    $classes[] = 'academia-theme';

    $view = isset($_GET['view']) ? sanitize_key( (string) $_GET['view'] ) : '';
    if ( $view === 'compact' ) { $classes[] = 'cards-compact'; }

    if ( function_exists('tutor') ) {
        $classes[] = 'usa-tutorlms';
        $classes[] = 'tutor-lms-active';
        if ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) {
            $classes[] = 'tutor-dashboard-page';
        }
    }
    if ( defined('LEARNDASH_VERSION') ) {
        $classes[] = 'usa-learndash';
        $classes[] = 'learndash-active';
    }
    return array_values( array_unique( $classes ) );
}
add_filter('body_class', 'academia_pro_body_classes');

/* =========================================================
 * 3) Router de plantillas (sin asumir Tutor, LD opcional)
 * ======================================================= */
function academia_pro_template_router( $template ) {
    if ( defined('LEARNDASH_VERSION') && is_singular('sfwd-courses') ) {
        $t = locate_template( array('single-curso-learndash.php'), false, false );
        if ( $t && is_readable($t) ) { return $t; }
    }
    // Para TutorLMS dejamos la plantilla del plugin (restaura layout original)
    return $template;
}
add_filter('template_include', 'academia_pro_template_router');

/* =========================================================
 * 4) Componente de progreso accesible
 * ======================================================= */
if ( ! function_exists('academia_pro_render_progreso') ) {
    function academia_pro_render_progreso( $percent ) : void {
        $p = max(0, min(100, (int) $percent));
        $label = sprintf( esc_html__( 'Progreso: %d%%', 'academia-pro' ), $p );
        echo '<div class="barra-progreso" role="progressbar" aria-label="' . esc_attr( $label ) . '" aria-valuenow="' . esc_attr( $p ) . '" aria-valuemin="0" aria-valuemax="100">'
                . '<div class="barra-progreso__relleno" style="width:' . esc_attr( (string) $p ) . '%"></div>'
             . '</div>';
    }
}

/* =========================================================
 * 5) Shortcode [formula] — inline o display, delimitadores elegibles
 *    Uso: [formula]E=mc^2[/formula]
 *         [formula display="block" delim="$"] \int ... [/formula]
 *    Atributos: display: inline|block, delim: auto|$ , raw: 0|1 (no escapar)
 * ======================================================= */
function academia_pro_sc_formula( $atts, $content = '' ) : string {
    $atts = shortcode_atts(
        array( 'display' => 'inline', 'delim' => 'auto', 'raw' => '0' ),
        $atts,
        'formula'
    );

    $content = trim( (string) $content );
    if ( $content === '' ) { return ''; }

    $is_display = in_array( $atts['display'], array('block','display'), true );
    $raw        = $atts['raw'] === '1' || $atts['raw'] === 1;

    // Delimitadores
    if ( $atts['delim'] === '$' ) {
        $open = $is_display ? '$$' : '$';
        $close= $is_display ? '$$' : '$';
    } else {
        $open = $is_display ? '\\[' : '\\(';
        $close= $is_display ? '\\]' : '\\)';
    }

    $tag   = $is_display ? 'div' : 'span';
    $inner = $raw ? $content : esc_html( $content );

    return sprintf(
        '<%1$s class="formula formula-%2$s">%3$s%4$s%5$s</%1$s>',
        $tag,
        $is_display ? 'display' : 'inline',
        $open,
        $inner,
        $close
    );
}
add_shortcode('formula','academia_pro_sc_formula');

/* =========================================================
 * 6) API REST
 *    - /academia-pro/v1/progreso/<id>
 *    - /academia-pro/v1/cursos?q=&nivel=&orden=&page=&per_page=
 * ======================================================= */
add_action('rest_api_init', function () {

    /* ---- Progreso de curso para el usuario actual ---- */
    register_rest_route(
        'academia-pro/v1',
        '/progreso/(?P<id>\d+)',
        array(
            'methods'  => 'GET',
            'args'     => array(
                'id' => array(
                    'type'              => 'integer',
                    'required'          => true,
                    'sanitize_callback' => 'absint',
                    'validate_callback' => static function( $v ) { return (int) $v > 0; },
                ),
            ),
            'permission_callback' => static function () {
                return is_user_logged_in() && current_user_can('read');
            },
            'callback' => 'academia_pro_rest_get_progreso',
        )
    );

    /* ---- Listado público de cursos (Tutor/LD) con paginación ---- */
    register_rest_route(
        'academia-pro/v1',
        '/cursos',
        array(
            'methods'  => 'GET',
            'args'     => array(
                'q'        => array( 'type' => 'string',  'sanitize_callback' => 'sanitize_text_field', 'default' => '' ),
                'nivel'    => array( 'type' => 'string',  'sanitize_callback' => 'sanitize_text_field', 'default' => '' ),
                'orden'    => array( 'type' => 'string',  'enum' => array('fecha','titulo','popular'), 'default' => 'fecha' ),
                'page'     => array( 'type' => 'integer', 'sanitize_callback' => 'absint', 'default' => 1 ),
                'per_page' => array( 'type' => 'integer', 'sanitize_callback' => 'absint', 'default' => 20 ),
            ),
            'permission_callback' => '__return_true',
            'callback' => 'academia_pro_rest_get_cursos',
        )
    );
});

/** Callback: progreso */
function academia_pro_rest_get_progreso( WP_REST_Request $req ) : WP_REST_Response {
    $id       = absint( $req['id'] );
    $percent  = 0;

    if ( $id > 0 && get_post( $id ) ) {
        if ( function_exists('tutor_utils') && get_post_type( $id ) === 'courses' ) {
            $percent = (int) tutor_utils()->get_course_completed_percent( $id, get_current_user_id() );

        } elseif ( function_exists('learndash_course_progress') && get_post_type( $id ) === 'sfwd-courses' ) {
            $progress = learndash_course_progress( array(
                'user_id'   => get_current_user_id(),
                'course_id' => $id,
                'array'     => true,
            ) );
            if ( ! empty( $progress['percentage'] ) ) {
                $percent = (int) $progress['percentage'];
            }
        }
    }

    $data = array( 'id' => $id, 'progreso' => max(0, min(100, $percent)) );
    return new WP_REST_Response( $data, 200 );
}

/** Callback: cursos (Tutor + LearnDash) */
function academia_pro_rest_get_cursos( WP_REST_Request $req ) : WP_REST_Response {
    $q        = (string) $req->get_param('q');
    $nivel    = (string) $req->get_param('nivel');
    $orden    = (string) $req->get_param('orden');
    $page     = max( 1, (int) $req->get_param('page') );
    $per_page = min( 50, max( 1, (int) $req->get_param('per_page') ) );

    $args = array(
        'post_type'      => array( 'courses', 'sfwd-courses' ),
        'post_status'    => 'publish',
        's'              => $q,
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'no_found_rows'  => false, // necesario para totales/paginación
    );

    // Orden
    if ( $orden === 'titulo' ) {
        $args['orderby'] = 'title';
        $args['order']   = 'ASC';
    } elseif ( $orden === 'popular' ) {
        // Métrica típica de TutorLMS (ajústala si usas otra)
        $args['meta_key'] = '_tutor_course_enrolled_users';
        $args['orderby']  = 'meta_value_num';
        $args['order']    = 'DESC';
    } else {
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
    }

    // Filtro por meta "nivel"
    if ( $nivel !== '' ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'nivel',
                'value'   => $nivel,
                'compare' => '=',
            ),
        );
    }

    $wpq = new WP_Query( $args );
    $items = array();

    while ( $wpq->have_posts() ) { $wpq->the_post();
        $id = get_the_ID();
        $items[] = array(
            'id'     => $id,
            'titulo' => get_the_title(),
            'url'    => get_permalink(),
            'nivel'  => get_post_meta( $id, 'nivel', true ),
            'thumb'  => get_the_post_thumbnail_url( $id, 'medium' ) ?: apply_filters('academia_pro/cursos_placeholder', '' ),
            'fecha'  => get_the_date( 'Y-m-d', $id ),
            'tipo'   => get_post_type( $id ),
        );
    }
    wp_reset_postdata();

    $total      = (int) $wpq->found_posts;
    $totalPages = (int) ceil( $total / $per_page );

    $response = new WP_REST_Response( array( 'cursos' => $items ) );
    $response->header( 'X-WP-Total', (string) $total );
    $response->header( 'X-WP-TotalPages', (string) $totalPages );

    // Links rel=prev/next estilo WP
    $base = rest_url( 'academia-pro/v1/cursos' );
    $params = $req->get_query_params();
    $params['per_page'] = $per_page;

    if ( $page > 1 ) {
        $params['page'] = $page - 1;
        $response->link_header( 'prev', add_query_arg( $params, $base ) );
    }
    if ( $page < $totalPages ) {
        $params['page'] = $page + 1;
        $response->link_header( 'next', add_query_arg( $params, $base ) );
    }

    return $response;
}
