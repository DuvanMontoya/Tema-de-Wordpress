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


<?php if ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) : ?>
  <!-- Dashboard TutorLMS: sin header del tema -->
  <main class="site-main" id="contenido" tabindex="-1">
<?php else : ?>

<header class="site-header" role="banner">
  <div class="site-header__inner">
    <div class="site-branding">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a class="site-title" href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
          <?php echo esc_html( get_bloginfo('name') ); ?>
        </a>
      <?php endif; ?>
    </div>

    <nav class="site-nav" role="navigation" aria-label="Menú principal">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-principal',
          'container'      => false,
          'menu_class'     => 'nav-menu',
          'menu_id'        => 'menu-principal',
          'depth'          => 1,
          'fallback_cb'    => false,
        ));
      ?>
    </nav>

    <div class="site-account">
      <?php if ( is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( home_url('/escritorio') ); ?>" class="account-link">
          👤 Perfil
        </a>
      <?php else : ?>
        <a href="<?php echo wp_login_url(); ?>" class="login-link">Entrar</a>
        <?php if ( get_option('users_can_register') ) : ?>
          <a href="<?php echo wp_registration_url(); ?>" class="register-link">Registrarse</a>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <button class="mobile-menu-toggle" aria-label="Abrir menú">
      ☰
    </button>
  </div>
</header>

<main class="site-main" id="contenido" tabindex="-1">
<?php endif; ?>
