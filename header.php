<?php
/** Header del tema (accesible, seguro y performante) */
if ( ! defined('ABSPATH') ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php if ( ! ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) ) : ?>
  <!-- CSS CRÍTICO DE EMERGENCIA - TOTAL OVERRIDE -->
  <style id="academia-emergency-css">
    /* RESET Y VARIABLES CRÍTICAS */
    :root {
      --color-background: #f8fafc;
      --color-surface: #ffffff;
      --color-surface-elevated: #ffffff;
      --color-text-primary: #0f172a;
      --color-text-secondary: #334155;
      --color-text-muted: #64748b;
      --color-border: #e5e7eb;
      --color-border-light: #eef2f7;
      --color-primary: #4f46e5;
      --color-primary-50: #eef2ff;
      --color-primary-600: #4f46e5;
      --space-2: .5rem;
      --space-3: .75rem;
      --space-4: 1rem;
      --space-6: 1.5rem;
      --space-8: 2rem;
      --space-10: 2.5rem;
      --space-12: 3rem;
      --space-24: 6rem;
      --radius-lg: .75rem;
      --radius-xl: 1rem;
      --radius-2xl: 1.25rem;
      --shadow-sm: 0 1px 2px rgba(0, 0, 0, .05);
      --shadow-md: 0 6px 24px rgba(0, 0, 0, .08);
    }

    /* MODO OSCURO - ULTRA FORZADO */
    :root[data-theme="dark"],
    html[data-theme="dark"],
    body[data-theme="dark"],
    html.dark-mode,
    body.dark-mode {
      --color-background: #0f172a !important;
      --color-surface: #1e293b !important;
      --color-surface-elevated: #334155 !important;
      --color-text-primary: #f1f5f9 !important;
      --color-text-secondary: #cbd5e1 !important;
      --color-text-muted: #94a3b8 !important;
      --color-border: #475569 !important;
      --color-border-light: #334155 !important;
      --color-primary: #60a5fa !important;
      --color-primary-50: #1e3a8a !important;
      --color-primary-600: #3b82f6 !important;
    }

    /* BODY Y HTML */
    html, body {
      background: var(--color-background) !important;
      color: var(--color-text-primary) !important;
      margin: 0 !important;
      padding: 0 !important;
    }

    /* HEADER CENTRADO */
    .site-header {
      background: var(--color-surface) !important;
      border-bottom: 1px solid var(--color-border) !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 1000 !important;
    }

    .site-header__inner {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      width: 100% !important;
      max-width: 1400px !important;
      margin: 0 auto !important;
      padding: 0 24px !important;
      height: 72px !important;
    }

    .site-branding {
      flex: 1 !important;
      text-align: center !important;
    }

    .site-branding .site-title,
    .site-branding a {
      font-size: 1.5rem !important;
      font-weight: 600 !important;
      color: var(--color-text-primary) !important;
      text-decoration: none !important;
      margin: 0 !important;
    }

    /* POSTS GRID - EMERGENCIA */
    .posts-grid {
      display: grid !important;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)) !important;
      gap: var(--space-12) !important;
      margin-bottom: var(--space-24) !important;
      padding: 0 var(--space-8) !important;
      align-items: start !important;
      max-width: 1400px !important;
      margin-left: auto !important;
      margin-right: auto !important;
    }

    .post-card {
      background: var(--color-surface) !important;
      border-radius: var(--radius-2xl) !important;
      box-shadow: var(--shadow-md) !important;
      border: 1px solid var(--color-border) !important;
      overflow: hidden !important;
      transition: all 0.3s ease !important;
      display: flex !important;
      flex-direction: column !important;
      position: relative !important;
      height: 100% !important;
    }

    .post-card:hover {
      transform: translateY(-4px) !important;
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12) !important;
    }

    /* SINGLE POST - EMERGENCIA */
    .single-post-container {
      max-width: 1200px !important;
      margin: 0 auto !important;
      padding: var(--space-8) var(--space-6) !important;
    }

    .single-post {
      background: var(--color-surface) !important;
      border-radius: var(--radius-2xl) !important;
      overflow: hidden !important;
      box-shadow: var(--shadow-md) !important;
      width: 100% !important;
    }

    .single-post-body,
    .single-post-content,
    .wp-block-post-content,
    .entry-content,
    .page-content-wrapper {
      max-width: none !important;
      width: 100% !important;
      box-sizing: border-box !important;
      padding: var(--space-8) !important;
      color: var(--color-text-primary) !important;
    }

    /* TÍTULOS */
    .single-post-title,
    .page-title,
    h1.entry-title {
      text-align: center !important;
      font-size: clamp(2rem, 4vw, 2.75rem) !important;
      font-weight: 700 !important;
      color: var(--color-text-primary) !important;
      margin: var(--space-8) 0 !important;
    }

    /* PÁRRAFOS Y CONTENIDO */
    .single-post-body p,
    .wp-block-post-content p,
    .entry-content p,
    .page-content-wrapper p {
      color: var(--color-text-secondary) !important;
      line-height: 1.7 !important;
      margin-bottom: var(--space-6) !important;
    }

    /* FOOTER */
    .site-footer {
      background: var(--color-surface) !important;
      border-top: 1px solid var(--color-border) !important;
      margin-top: var(--space-24) !important;
      padding: var(--space-8) 0 !important;
      text-align: center !important;
      color: var(--color-text-primary) !important;
    }

    /* DROPDOWN MENU */
    .account-dropdown {
      position: relative !important;
      z-index: 1000 !important;
    }

    .account-toggle {
      display: flex !important;
      align-items: center !important;
      gap: var(--space-2) !important;
      background: none !important;
      border: 1px solid var(--color-border) !important;
      border-radius: var(--radius-lg) !important;
      padding: var(--space-2) var(--space-4) !important;
      cursor: pointer !important;
      color: var(--color-text-secondary) !important;
    }

    .account-menu {
      position: absolute !important;
      top: calc(100% + 8px) !important;
      right: 0 !important;
      min-width: 220px !important;
      background: var(--color-surface) !important;
      border: 1px solid var(--color-border) !important;
      border-radius: var(--radius-lg) !important;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
      padding: var(--space-2) !important;
      z-index: 9999 !important;
      display: none !important;
    }

    .account-dropdown[aria-expanded="true"] .account-menu {
      display: block !important;
    }

    .account-menu-item {
      display: flex !important;
      align-items: center !important;
      gap: var(--space-2) !important;
      padding: var(--space-3) var(--space-4) !important;
      color: var(--color-text-secondary) !important;
      text-decoration: none !important;
      border-radius: var(--radius-md) !important;
      transition: all 0.2s ease !important;
    }

    .account-menu-item:hover {
      background: var(--color-primary-50) !important;
      color: var(--color-primary) !important;
    }
  </style>
<?php endif; ?>

<?php wp_head(); ?>

<!-- Pista de “JS habilitado” sin depender de assets externos -->
<script>
  (function(d){try{d.documentElement.className=d.documentElement.className.replace('no-js','js')}catch(e){}})(document);

  // Forzar recarga de estilos y limpiar cache
  const currentTime = new Date().getTime();
  const styleSheets = document.styleSheets;
  for (let i = 0; i < styleSheets.length; i++) {
    if (styleSheets[i].href) {
      const href = styleSheets[i].href;
      if (href.includes('blog.css') || href.includes('header-footer.css')) {
        const newHref = href + '?v=' + currentTime;
        styleSheets[i].href = newHref;
        console.log('CSS recargado:', newHref);
      }
    }
  }

  // Debug para verificar que los estilos se aplican
  console.log('CSS crítico aplicado - Header centrado y modo oscuro forzado');

  // Simple dropdown toggle
  document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('.account-dropdown');
    if (dropdown) {
      const toggle = dropdown.querySelector('.account-toggle');
      const menu = dropdown.querySelector('.account-menu');

      if (toggle && menu) {
        toggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
          toggle.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
          menu.hidden = isExpanded;
          menu.style.display = isExpanded ? 'none' : 'block';
        });

        // Close on outside click
        document.addEventListener('click', function(e) {
          if (!dropdown.contains(e.target)) {
            toggle.setAttribute('aria-expanded', 'false');
            menu.hidden = true;
            menu.style.display = 'none';
          }
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            toggle.setAttribute('aria-expanded', 'false');
            menu.hidden = true;
            menu.style.display = 'none';
          }
        });
      }
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
