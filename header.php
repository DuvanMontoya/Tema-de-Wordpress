<?php
/** Header del tema (accesible, seguro y performante) */
if ( ! defined('ABSPATH') ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php if ( ! ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) ) : ?>
  <!-- CSS crítico mínimo (skip-link + sane defaults). Manténlo pequeño. -->
  <style id="academia-critical-css">
    :root{--sk-bg:#000;--sk-fg:#fff}
    body{margin:0}
    .skip-link{position:absolute;left:0;top:-100%;background:var(--sk-bg);color:var(--sk-fg);padding:.5rem 1rem;border-radius:.25rem;z-index:1000;text-decoration:none}
    .skip-link:focus{top:0;outline:2px solid var(--sk-fg)}
    .no-js .site-nav__toggle{display:none}
  </style>
<?php endif; ?>

<?php wp_head(); ?>

<!-- Pista de “JS habilitado” sin depender de assets externos -->
<script>
  (function(d){try{d.documentElement.className=d.documentElement.className.replace('no-js','js')}catch(e){}})(document);
</script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#contenido"><?php esc_html_e('Saltar al contenido','academia-pro'); ?></a>

<header class="site-header" role="banner">
  <div class="contenedor site-header__inner">

    <div class="site-branding">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a class="site-title" href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
          <?php echo esc_html( get_bloginfo('name') ); ?>
        </a>
      <?php endif; ?>
    </div>

    <?php
      // IDs únicos para asociar ARIA correctamente
      $nav_id      = 'menu-principal';
      $account_id  = 'account-menu';
      $dashboard   = function_exists('academia_pro_default_dashboard_url')
                      ? academia_pro_default_dashboard_url()
                      : home_url( user_trailingslashit('escritorio') );
    ?>

    <button class="site-nav__toggle"
            type="button"
            aria-controls="<?php echo esc_attr($nav_id); ?>"
            aria-expanded="false">
      <span class="visually-hidden"><?php esc_html_e('Abrir menú','academia-pro'); ?></span>
      <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path d="M3 6h18M3 12h18M3 18h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>

    <nav class="site-nav"
         role="navigation"
         aria-label="<?php echo esc_attr__( 'Menú principal','academia-pro' ); ?>">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-principal',
          'container'      => false,
          'menu_class'     => 'menu-principal',
          'menu_id'        => $nav_id,
          'depth'          => 2,
          'fallback_cb'    => '__return_empty_string',
        ));
      ?>
    </nav>

    <div class="site-account">
      <?php if ( is_user_logged_in() ) :
        $user   = wp_get_current_user();
        $name   = $user && $user->display_name ? $user->display_name : ( $user->user_login ?? '' );
        $name   = wp_strip_all_tags( (string) $name );
        $avatar = get_avatar( $user->ID, 28, '', '', array( 'class' => 'avatar' ) );
        $perfil = get_edit_profile_url( $user->ID );
        $cursos = get_post_type_archive_link('courses'); // si no existe CPT, devuelve false y no se muestra
      ?>
  <div class="account" data-account aria-expanded="false">
        <button class="account-toggle"
                type="button"
                aria-haspopup="true"
                aria-expanded="false"
                aria-controls="<?php echo esc_attr($account_id); ?>">
          <span class="avatar-wrap"><?php echo $avatar; // avatar ya es HTML seguro ?></span>
          <span class="account-name"><?php echo esc_html( wp_trim_words( $name, 2, '' ) ); ?></span>
          <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>

        <div id="<?php echo esc_attr($account_id); ?>" class="account-menu" role="menu" hidden>
          <a role="menuitem" class="account-item" href="<?php echo esc_url( $dashboard ); ?>">
            <?php esc_html_e('Escritorio','academia-pro'); ?>
          </a>
          <?php if ( $cursos ) : ?>
            <a role="menuitem" class="account-item" href="<?php echo esc_url( $cursos ); ?>">
              <?php esc_html_e('Mis cursos','academia-pro'); ?>
            </a>
          <?php endif; ?>
          <a role="menuitem" class="account-item" href="<?php echo esc_url( $perfil ); ?>">
            <?php esc_html_e('Perfil','academia-pro'); ?>
          </a>
          <a role="menuitem" class="account-item" href="<?php echo esc_url( wp_logout_url( $dashboard ) ); ?>">
            <?php esc_html_e('Salir','academia-pro'); ?>
          </a>
        </div>
      </div>

      <?php else :
        // URL de login (usa helper del tema si existe)
        if ( function_exists('academia_pro_get_login_page_url') ) {
          $login_url = academia_pro_get_login_page_url( $dashboard );
        } else {
          $login_url = add_query_arg( 'redirect_to', $dashboard, wp_login_url( $dashboard ) );
        }
        $can_register = (bool) get_option('users_can_register');
      ?>
      <div class="account account--anon">
        <a class="btn btn--ghost" href="<?php echo esc_url( $login_url ); ?>">
          <?php esc_html_e('Entrar','academia-pro'); ?>
        </a>
        <?php if ( $can_register ) : ?>
          <a class="btn btn--primary" href="<?php echo esc_url( wp_registration_url() ); ?>">
            <?php esc_html_e('Crear cuenta','academia-pro'); ?>
          </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>

  </div>
</header>

<main class="site-main" id="contenido" tabindex="-1">
