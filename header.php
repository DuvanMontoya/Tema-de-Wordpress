<?php
/** Header del tema (accesible, seguro y performante) */
if ( ! defined('ABSPATH') ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php if ( ! ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) ) : ?>
  <!-- CSS MÍNIMO PARA CENTRAR EL HEADER -->
  <style id="academia-header-fix">
    /* Solo centrar el logo/título */
    .site-branding {
      position: absolute !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      text-align: center !important;
    }
  </style>
<?php endif; ?>

<?php wp_head(); ?>

<!-- Pista de “JS habilitado” sin depender de assets externos -->
<script>
  (function(d){try{d.documentElement.className=d.documentElement.className.replace('no-js','js')}catch(e){}})(document);

  // Debug minimalista para header
  console.log('Header con CSS mínimo aplicado');

  // Simple dropdown toggle
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - setting up dropdown');
    
    const dropdown = document.querySelector('.account-dropdown');
    if (dropdown) {
      const toggle = dropdown.querySelector('.account-toggle');
      const menu = dropdown.querySelector('.account-menu');

      console.log('Dropdown elements found:', { dropdown, toggle, menu });

      if (toggle && menu) {
        // Function to close dropdown
        function closeDropdown() {
          toggle.setAttribute('aria-expanded', 'false');
          dropdown.setAttribute('aria-expanded', 'false');
          menu.hidden = true;
          menu.style.display = 'none';
          menu.style.opacity = '0';
          menu.style.visibility = 'hidden';
          menu.style.transform = 'translateY(-10px)';
          menu.style.pointerEvents = 'none';
          console.log('Dropdown closed');
        }

        // Function to open dropdown
        function openDropdown() {
          toggle.setAttribute('aria-expanded', 'true');
          dropdown.setAttribute('aria-expanded', 'true');
          menu.hidden = false;
          menu.style.display = 'block';
          menu.style.opacity = '1';
          menu.style.visibility = 'visible';
          menu.style.transform = 'translateY(0)';
          menu.style.pointerEvents = 'all';
          console.log('Dropdown opened');
        }

        // Toggle dropdown on click
        toggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          console.log('Toggle clicked');
          
          const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
          if (isExpanded) {
            closeDropdown();
          } else {
            openDropdown();
          }
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
          if (!dropdown.contains(e.target)) {
            closeDropdown();
          }
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            closeDropdown();
          }
        });

        // Ensure dropdown starts closed
        closeDropdown();
      }
    } else {
      console.log('No dropdown found');
    }
  });
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
        <?php
          $user = wp_get_current_user();
          $name = $user->display_name ?: $user->user_login;
          $avatar = get_avatar($user->ID, 32, '', '', array('class' => 'user-avatar'));
          $dashboard = function_exists('academia_pro_default_dashboard_url') ? academia_pro_default_dashboard_url() : home_url('/escritorio');
          $profile = get_edit_profile_url($user->ID);
          $courses = function_exists('tutor') ? get_post_type_archive_link('courses') : false;
        ?>
        <div class="account-dropdown">
          <button class="account-toggle" aria-haspopup="true" aria-expanded="false">
            <?php echo $avatar; ?>
            <span class="account-name"><?php echo esc_html(wp_trim_words($name, 2)); ?></span>
            <svg class="account-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
          <div class="account-menu" role="menu" hidden>
            <a role="menuitem" class="account-menu-item" href="<?php echo esc_url($dashboard); ?>">🏠 Escritorio</a>
            <?php if ($courses) : ?>
              <a role="menuitem" class="account-menu-item" href="<?php echo esc_url($courses); ?>">📚 Mis Cursos</a>
          <?php endif; ?>
            <a role="menuitem" class="account-menu-item" href="<?php echo esc_url($profile); ?>">⚙️ Perfil</a>
            <hr class="account-menu-separator">
            <a role="menuitem" class="account-menu-item account-menu-logout" href="<?php echo esc_url(wp_logout_url($dashboard)); ?>">🚪 Cerrar Sesión</a>
          </div>
        </div>
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
