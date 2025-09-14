<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * =========================================================
 * Setup de tema + utilidades de login/redirección + breadcrumbs
 * Robusto, extensible y conforme a estándares WP.
 * =========================================================
 */

/*----------------------------------------------------------
| 1) SETUP DE TEMA
*---------------------------------------------------------*/
function academia_pro_setup_basico(): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support(
        'html5',
        array( 'search-form','comment-form','comment-list','gallery','caption','style','script','navigation-widgets' )
    );
    add_theme_support(
        'custom-logo',
        array( 'height'=>60, 'width'=>180, 'flex-width'=>true, 'flex-height'=>true )
    );

    register_nav_menus(
        array(
            'menu-principal'  => __( 'Menú principal', 'academia-pro' ),
            'menu-secundario' => __( 'Menú secundario', 'academia-pro' ),
            'menu-pie'        => __( 'Menú pie de página', 'academia-pro' ),
        )
    );
}
add_action( 'after_setup_theme', 'academia_pro_setup_basico' );

/*----------------------------------------------------------
| 2) BREADCRUMBS (con Schema y accesibles)
*---------------------------------------------------------*/

/**
 * Devuelve el HTML de las migas de pan (no imprime).
 */
function academia_pro_get_breadcrumbs_html(): string {
    if ( is_front_page() ) { return ''; }

    // Cache estático por petición
    static $cached = null;
    if ( null !== $cached ) { return $cached; }

    $items = array();
    $pos   = 1;

    // Home
    $items[] = sprintf(
        '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">' .
            '<a class="breadcrumb-link" itemprop="item" href="%1$s"><span itemprop="name">%2$s</span></a>' .
            '<meta itemprop="position" content="%3$d" />' .
        '</li>',
        esc_url( home_url( '/' ) ),
        esc_html__( 'Inicio', 'academia-pro' ),
        $pos++
    );

    if ( is_singular() ) {
        $post = get_post();

        // CPT: enlace al archivo del CPT si existe
        if ( $post && ! in_array( $post->post_type, array( 'post', 'page' ), true ) ) {
            $obj = get_post_type_object( $post->post_type );
            if ( $obj && ! empty( $obj->has_archive ) ) {
                $archive_url = get_post_type_archive_link( $post->post_type );
                if ( $archive_url ) {
                    $items[] = sprintf(
                        '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">' .
                            '<a class="breadcrumb-link" itemprop="item" href="%1$s"><span itemprop="name">%2$s</span></a>' .
                            '<meta itemprop="position" content="%3$d" />' .
                        '</li>',
                        esc_url( $archive_url ),
                        esc_html( $obj->labels->name ),
                        $pos++
                    );
                }
            }
        }

        // Jerarquía de páginas (si aplica)
        if ( is_page() ) {
            $ancestors = array_reverse( (array) get_post_ancestors( $post ) );
            foreach ( $ancestors as $ancestor_id ) {
                $items[] = sprintf(
                    '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">' .
                        '<a class="breadcrumb-link" itemprop="item" href="%1$s"><span itemprop="name">%2$s</span></a>' .
                        '<meta itemprop="position" content="%3$d" />' .
                    '</li>',
                    esc_url( get_permalink( $ancestor_id ) ),
                    esc_html( get_the_title( $ancestor_id ) ),
                    $pos++
                );
            }
        }

        // Título actual
        $items[] = sprintf(
            '<li class="breadcrumb-item is-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">' .
                '<span class="breadcrumb-current" itemprop="name">%1$s</span>' .
                '<meta itemprop="position" content="%2$d" />' .
            '</li>',
            esc_html( get_the_title( $post ) ),
            $pos++
        );

    } elseif ( is_archive() ) {

        $items[] = sprintf(
            '<li class="breadcrumb-item is-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">' .
                '<span class="breadcrumb-current" itemprop="name">%1$s</span>' .
                '<meta itemprop="position" content="%2$d" />' .
            '</li>',
            esc_html( get_the_archive_title() ),
            $pos++
        );

    } elseif ( is_search() ) {

        $items[] = sprintf(
            '<li class="breadcrumb-item is-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">' .
                '<span class="breadcrumb-current" itemprop="name">%1$s</span>' .
                '<meta itemprop="position" content="%2$d" />' .
            '</li>',
            esc_html__( 'Búsqueda', 'academia-pro' ),
            $pos++
        );

    } else {

        $items[] = sprintf(
            '<li class="breadcrumb-item is-current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" aria-current="page">' .
                '<span class="breadcrumb-current" itemprop="name">%1$s</span>' .
                '<meta itemprop="position" content="%2$d" />' .
            '</li>',
            esc_html( get_the_title() ),
            $pos++
        );
    }

    $html  = '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Ruta de navegación', 'academia-pro' ) . '" itemscope itemtype="https://schema.org/BreadcrumbList">';
    $html .= '<ol class="breadcrumb-list">';
    $html .= implode( '<span class="breadcrumb-separator" aria-hidden="true">›</span>', $items );
    $html .= '</ol></nav>';

    // Filtro por si quieres personalizar desde un child o plugin
    $cached = apply_filters( 'academia_pro/breadcrumbs_html', $html, $items );
    return $cached;
}

/** Imprime las migas de pan (azúcar sintáctico) */
function academia_pro_breadcrumbs(): void {
    $html = academia_pro_get_breadcrumbs_html();
    if ( $html ) {
        echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/*----------------------------------------------------------
| 3) LOGIN PERSONALIZADO + REDIRECCIONES
*---------------------------------------------------------*/

/** URL por defecto del “escritorio” post-login (filtrable). */
function academia_pro_default_dashboard_url(): string {
    $url = home_url( user_trailingslashit( 'escritorio' ) );
    return apply_filters( 'academia_pro/default_dashboard_url', $url );
}

/**
 * Devuelve el ID de la página de login personalizada (si existe).
 * Busca por plantilla `page-login.php` y cachea el resultado.
 */
function academia_pro_get_login_page_id(): int {
    static $id = -1;
    if ( $id >= 0 ) { return $id; }
    $pages = get_pages(
        array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'page-login.php',
            'post_status'=> 'publish',
            'number'     => 1,
        )
    );
    $id = ! empty( $pages ) ? (int) $pages[0]->ID : 0;
    return $id;
}

/** Devuelve la URL de login personalizada (o `wp_login_url` si no existe). */
function academia_pro_get_login_page_url( string $redirect_to = '' ): string {
    $page_id = academia_pro_get_login_page_id();
    $dest    = academia_pro_normalize_redirect( $redirect_to );
    if ( $page_id ) {
        $url = get_permalink( $page_id );
        if ( $dest ) {
            $url = add_query_arg( 'redirect_to', $dest, $url );
        }
        return apply_filters( 'academia_pro/login_page_url', $url, $dest );
    }
    return wp_login_url( $dest );
}

/** Normaliza y valida la URL de destino para evitar bucles y *open redirect*. */
function academia_pro_normalize_redirect( string $url = '' ): string {
    $default = academia_pro_default_dashboard_url();
    if ( empty( $url ) ) { return $default; }

    // Limpieza de parámetros ruidosos
    $url = remove_query_arg( array( 'bp-auth', 'action' ), $url );

    // Evitar bucles hacia la propia página de login o wp-login
    $login_id   = academia_pro_get_login_page_id();
    $login_url  = $login_id ? get_permalink( $login_id ) : '';
    $login_path = $login_url ? (string) parse_url( $login_url, PHP_URL_PATH ) : '';

    $dest_path  = (string) parse_url( $url, PHP_URL_PATH );
    if ( false !== strpos( $url, 'wp-login.php' ) ) { return $default; }
    if ( $login_path && rtrim( $dest_path, '/' ) === rtrim( $login_path, '/' ) ) { return $default; }

    // Slug típico /acceso/ también conduce al login → bucle
    $acceso_path = (string) parse_url( home_url( '/acceso/' ), PHP_URL_PATH );
    if ( $acceso_path && rtrim( $dest_path, '/' ) === rtrim( $acceso_path, '/' ) ) { return $default; }

    if ( false !== strpos( $url, 'redirect_to=' ) && $login_path && false !== strpos( $url, $login_path ) ) {
        return $default;
    }

    // Valida contra host actual (evita open redirect)
    $validated = wp_validate_redirect( $url, $default );
    return $validated ?: $default;
}

/* Forzar el uso de la página de login personalizada cuando terceros llamen wp_login_url */
add_filter(
    'login_url',
    function ( $login_url, $redirect, $force_reauth ) {
        $dest = academia_pro_normalize_redirect( (string) $redirect );
        return academia_pro_get_login_page_url( $dest );
    },
    10,
    3
);

/* Compatibilidad BuddyPress/BuddyBoss: usar nuestra URL */
add_filter(
    'bp_get_login_url',
    function ( $url ) {
        return academia_pro_get_login_page_url( academia_pro_default_dashboard_url() );
    }
);

/* Redirección post-login por defecto al escritorio (si no hay otra) */
add_filter(
    'login_redirect',
    function ( $redirect_to, $requested, $user ) {
        if ( empty( $redirect_to ) ) {
            return academia_pro_default_dashboard_url();
        }
        return academia_pro_normalize_redirect( (string) $redirect_to );
    },
    10,
    3
);

/**
 * Redirige accesos directos a wp-login.php hacia la página personalizada
 * (salvo acciones críticas/legítimas).
 */
add_action(
    'login_init',
    function () {
        // Permitir acciones nativas necesarias
        $allowed = array( 'logout','lostpassword','rp','resetpass','postpass','retrievepassword','confirm_admin_email','register' );
        $action  = isset( $_REQUEST['action'] ) ? sanitize_key( (string) $_REQUEST['action'] ) : '';

        if ( in_array( $action, $allowed, true ) ) { return; }
        if ( isset( $_REQUEST['interim-login'] ) ) { return; }
        if ( wp_doing_ajax() ) { return; }

        $custom = academia_pro_get_login_page_url( '' );
        if ( ! $custom || str_contains( $custom, 'wp-login.php' ) ) { return; }

        $redirect_raw = isset( $_REQUEST['redirect_to'] ) ? wp_unslash( (string) $_REQUEST['redirect_to'] ) : '';
        $redirect     = academia_pro_normalize_redirect( $redirect_raw );

        wp_safe_redirect( academia_pro_get_login_page_url( $redirect ) );
        exit;
    }
);

/**
 * Si estamos en la página de login personalizada, impedir que BuddyPress fuerce otra redirección.
 */
add_action(
    'template_redirect',
    function () {
        if ( function_exists( 'bp_template_redirect' ) && is_page_template( 'page-login.php' ) ) {
            remove_action( 'template_redirect', 'bp_template_redirect', 10 );
        }
    },
    1
);
