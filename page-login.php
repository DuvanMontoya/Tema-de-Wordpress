<?php
/**
 * Template Name: Login Profesional
 * Descripción: Página de login profesional y elegante para Academia Pro
 */
if (!defined('ABSPATH')) { exit; }

// Variables de configuración
$errors = [];
$dashboard_url = home_url('/escritorio/');
$is_register = isset($_GET['action']) && $_GET['action'] === 'register';

// Normalizar redirect
$redirect_to = isset($_REQUEST['redirect_to']) ?
    wp_unslash($_REQUEST['redirect_to']) : $dashboard_url;

// Redirigir si ya está logueado
if (is_user_logged_in()) {
    wp_safe_redirect($redirect_to ?: $dashboard_url);
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$is_register && isset($_POST['accion']) && $_POST['accion'] === 'login') {
        // PROCESO DE LOGIN
        check_admin_referer('academia_login', 'academia_login_nonce');

        $login = sanitize_text_field(wp_unslash($_POST['user_login'] ?? ''));
        $password = $_POST['user_pass'] ?? '';
        $remember = !empty($_POST['rememberme']);

        if (empty($login)) {
            $errors[] = __('Introduce tu usuario o email.', 'academia-pro');
        }
        if (empty($password)) {
            $errors[] = __('Introduce tu contraseña.', 'academia-pro');
        }

        if (empty($errors)) {
            $creds = [
                'user_login' => $login,
                'user_password' => $password,
                'remember' => $remember,
            ];

            $user = wp_signon($creds, is_ssl());
            if (is_wp_error($user)) {
                $errors[] = $user->get_error_message();
            } else {
                wp_safe_redirect($redirect_to ?: $dashboard_url);
                exit;
            }
        }
    } elseif ($is_register && isset($_POST['accion']) && $_POST['accion'] === 'register') {
        // PROCESO DE REGISTRO
        check_admin_referer('academia_register', 'academia_register_nonce');

        $username = sanitize_text_field(wp_unslash($_POST['user_login'] ?? ''));
        $email = sanitize_email(wp_unslash($_POST['user_email'] ?? ''));
        $password = $_POST['user_pass'] ?? '';
        $password_confirm = $_POST['user_pass_confirm'] ?? '';

        // Validaciones
        if (empty($username)) {
            $errors[] = __('Introduce un nombre de usuario.', 'academia-pro');
        }
        if (empty($email)) {
            $errors[] = __('Introduce tu email.', 'academia-pro');
        }
        if (!is_email($email)) {
            $errors[] = __('El email no es válido.', 'academia-pro');
        }
        if (empty($password)) {
            $errors[] = __('Introduce una contraseña.', 'academia-pro');
        }
        if (strlen($password) < 6) {
            $errors[] = __('La contraseña debe tener al menos 6 caracteres.', 'academia-pro');
        }
        if ($password !== $password_confirm) {
            $errors[] = __('Las contraseñas no coinciden.', 'academia-pro');
        }

        if (username_exists($username)) {
            $errors[] = __('Este nombre de usuario ya está en uso.', 'academia-pro');
        }
        if (email_exists($email)) {
            $errors[] = __('Este email ya está registrado.', 'academia-pro');
        }

        if (empty($errors)) {
            $user_id = wp_create_user($username, $password, $email);
            if (is_wp_error($user_id)) {
                $errors[] = $user_id->get_error_message();
            } else {
                // Auto-login después del registro
                $creds = [
                    'user_login' => $username,
                    'user_password' => $password,
                    'remember' => true,
                ];
                $user = wp_signon($creds, is_ssl());
                if (!is_wp_error($user)) {
                    wp_safe_redirect($redirect_to ?: $dashboard_url);
                    exit;
                }
            }
        }
    }
}

get_header();
?>

<!-- LOGIN EMPRESARIAL PERFECCIONADO - CSS ULTRA PROFESIONAL -->
<style>
/* =====================================================
   LOGIN EMPRESARIAL ULTRA-PROFESIONAL - ACADEMIA PRO
   ===================================================== */

/* Reset y aislamiento total para evitar interferencias */
*,
*::before,
*::after {
  box-sizing: border-box;
}

/* Variables CSS empresariales perfeccionadas */
:root {
  /* Colores primarios corporativos */
  --login-primary: #1a365d;
  --login-primary-dark: #2d3748;
  --login-accent: #3182ce;
  --login-accent-hover: #2c5aa0;
  --login-accent-light: rgba(49, 130, 206, 0.1);

  /* Colores de superficie */
  --login-background: #f8fafc;
  --login-card-bg: #ffffff;
  --login-surface-elevated: #ffffff;
  --login-surface-hover: #f7fafc;

  /* Colores de texto */
  --login-text-primary: #1a202c;
  --login-text-secondary: #4a5568;
  --login-text-muted: #718096;
  --login-text-light: #a0aec0;

  /* Colores de borde */
  --login-border: #e2e8f0;
  --login-border-hover: #cbd5e0;
  --login-border-focus: var(--login-accent);

  /* Sombras profesionales */
  --login-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --login-shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --login-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --login-shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

  /* Espaciado consistente */
  --login-space-xs: 0.25rem;
  --login-space-sm: 0.5rem;
  --login-space-md: 1rem;
  --login-space-lg: 1.5rem;
  --login-space-xl: 2rem;
  --login-space-2xl: 3rem;

  /* Tipografía */
  --login-font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  --login-font-size-xs: 0.75rem;
  --login-font-size-sm: 0.875rem;
  --login-font-size-base: 1rem;
  --login-font-size-lg: 1.125rem;
  --login-font-size-xl: 1.25rem;
  --login-font-size-2xl: 1.5rem;
  --login-font-size-3xl: 1.875rem;

  /* Bordes redondeados */
  --login-radius-sm: 0.375rem;
  --login-radius-md: 0.5rem;
  --login-radius-lg: 0.75rem;
  --login-radius-xl: 1rem;
  --login-radius-2xl: 1.5rem;

  /* Transiciones */
  --login-transition-fast: 150ms ease;
  --login-transition-base: 250ms ease;
  --login-transition-slow: 350ms ease;
}

/* Modo oscuro empresarial */
@media (prefers-color-scheme: dark) {
  :root {
    --login-primary: #f7fafc;
    --login-primary-dark: #e2e8f0;
    --login-accent: #63b3ed;
    --login-accent-hover: #90cdf4;
    --login-accent-light: rgba(99, 179, 237, 0.15);

    --login-background: #0f1419;
    --login-card-bg: #1a202c;
    --login-surface-elevated: #2d3748;
    --login-surface-hover: #2d3748;

    --login-text-primary: #f7fafc;
    --login-text-secondary: #e2e8f0;
    --login-text-muted: #a0aec0;
    --login-text-light: #718096;

    --login-border: #2d3748;
    --login-border-hover: #4a5568;
  }
}

/* Layout principal perfeccionado */
.auth-layout {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: var(--login-space-xl);
  background: var(--login-background);
  font-family: var(--login-font-family);
  line-height: 1.6;
  color: var(--login-text-primary);
}

/* Tarjeta principal ultra-profesional */
.auth-card {
  width: 100%;
  max-width: 480px;
  background: var(--login-card-bg);
  border: 1px solid var(--login-border);
  border-radius: var(--login-radius-2xl);
  box-shadow: var(--login-shadow-lg);
  padding: var(--login-space-2xl) var(--login-space-2xl);
  position: relative;
  backdrop-filter: blur(20px) saturate(180%);
  transition: all var(--login-transition-base);
}

/* Header perfeccionado */
.auth-header {
  text-align: center;
  margin-bottom: var(--login-space-2xl);
}

.auth-logo {
  margin-bottom: var(--login-space-xl);
  display: flex;
  justify-content: center;
  align-items: center;
}

.auth-logo img {
  max-width: 200px;
  max-height: 60px;
  width: auto;
  height: auto;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
  transition: filter var(--login-transition-base);
}

.auth-logo img:hover {
  filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
}

.auth-title {
  font-size: var(--login-font-size-3xl);
  font-weight: 700;
  color: var(--login-primary);
  margin: 0 0 var(--login-space-md) 0;
  line-height: 1.2;
  letter-spacing: -0.025em;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.auth-subtitle {
  font-size: var(--login-font-size-base);
  color: var(--login-text-muted);
  font-weight: 400;
  margin: 0;
  line-height: 1.6;
  opacity: 0.9;
}

/* Alertas perfeccionadas */
.auth-alert {
  background: linear-gradient(135deg, #fef5e7 0%, #fed7aa 100%);
  border: 1px solid #f6e05e;
  border-radius: var(--login-radius-lg);
  padding: var(--login-space-md) var(--login-space-lg);
  margin-bottom: var(--login-space-xl);
  color: #744210;
  position: relative;
  box-shadow: var(--login-shadow-sm);
}

.auth-alert::before {
  content: '⚠️';
  position: absolute;
  left: var(--login-space-md);
  top: 50%;
  transform: translateY(-50%);
  font-size: var(--login-font-size-lg);
  opacity: 0.8;
}

.auth-alert ul {
  margin: 0;
  padding-left: var(--login-space-xl);
  list-style-type: disc;
}

.auth-alert li {
  margin-bottom: var(--login-space-xs);
  line-height: 1.5;
}

.auth-alert li:last-child {
  margin-bottom: 0;
}

/* Formulario perfeccionado */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: var(--login-space-lg);
}

/* Campos perfeccionados */
.field {
  position: relative;
  transition: transform var(--login-transition-base);
}

.field:hover {
  transform: translateY(-1px);
}

.label {
  display: block;
  font-size: var(--login-font-size-sm);
  font-weight: 600;
  color: var(--login-text-secondary);
  margin-bottom: var(--login-space-sm);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  transition: color var(--login-transition-base);
}

.field:focus-within .label {
  color: var(--login-accent);
}

.label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--login-space-sm);
}

.link-muted {
  color: var(--login-text-muted);
  text-decoration: none;
  font-size: var(--login-font-size-sm);
  transition: all var(--login-transition-base);
  font-weight: 500;
  border-bottom: 1px solid transparent;
}

.link-muted:hover {
  color: var(--login-accent);
  border-bottom-color: var(--login-accent);
  text-decoration: none;
}

.input-with-action {
  position: relative;
}

input[type="text"],
input[type="password"],
input[type="email"] {
  width: 100%;
  padding: var(--login-space-md) var(--login-space-lg);
  border: 2px solid var(--login-border);
  border-radius: var(--login-radius-lg);
  font-size: var(--login-font-size-base);
  background: var(--login-card-bg);
  transition: all var(--login-transition-base);
  outline: none;
  color: var(--login-text-primary);
  font-weight: 400;
  box-shadow: var(--login-shadow-sm);
  position: relative;
}

input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus {
  border-color: var(--login-accent);
  box-shadow: 0 0 0 3px var(--login-accent-light), var(--login-shadow-md);
  background: var(--login-surface-hover);
  transform: translateY(-1px);
}

input[type="text"]:hover,
input[type="password"]:hover,
input[type="email"]:hover {
  border-color: var(--login-border-hover);
  box-shadow: var(--login-shadow-md);
}

input::placeholder {
  color: var(--login-text-muted);
  opacity: 1;
  font-style: italic;
  transition: opacity var(--login-transition-base);
}

input:focus::placeholder {
  opacity: 0.7;
}

.toggle-pass {
  position: absolute;
  right: var(--login-space-md);
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  color: var(--login-text-muted);
  cursor: pointer;
  font-size: var(--login-font-size-lg);
  padding: var(--login-space-sm);
  border-radius: var(--login-radius-md);
  transition: all var(--login-transition-base);
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 32px;
  min-height: 32px;
}

.toggle-pass:hover {
  color: var(--login-accent);
  background: var(--login-accent-light);
  transform: translateY(-50%) scale(1.1);
}

.toggle-pass:focus {
  outline: 2px solid var(--login-accent);
  outline-offset: 2px;
}

/* Checkbox perfeccionado */
.field--row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--login-space-lg);
}

.checkbox {
  display: flex;
  align-items: center;
  gap: var(--login-space-sm);
  cursor: pointer;
  font-size: var(--login-font-size-sm);
  color: var(--login-text-secondary);
  font-weight: 500;
  user-select: none;
  transition: color var(--login-transition-base);
}

.checkbox:hover {
  color: var(--login-accent);
}

.checkbox input[type="checkbox"] {
  width: 18px;
  height: 18px;
  accent-color: var(--login-accent);
  cursor: pointer;
  transform: scale(1.1);
}

/* Botones perfeccionados */
.actions {
  margin-top: var(--login-space-lg);
}

.btn {
  padding: var(--login-space-md) var(--login-space-xl);
  border: 2px solid transparent;
  border-radius: var(--login-radius-lg);
  font-size: var(--login-font-size-base);
  font-weight: 600;
  cursor: pointer;
  transition: all var(--login-transition-base);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: var(--login-space-sm);
  min-height: 52px;
  text-align: center;
  position: relative;
  overflow: hidden;
  box-shadow: var(--login-shadow-sm);
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s ease;
}

.btn:hover::before {
  left: 100%;
}

.btn--primary {
  background: linear-gradient(135deg, var(--login-accent) 0%, var(--login-accent-hover) 100%);
  color: white;
  width: 100%;
  border-color: var(--login-accent);
  box-shadow: var(--login-shadow-md);
}

.btn--primary:hover {
  background: linear-gradient(135deg, var(--login-accent-hover) 0%, var(--login-primary) 100%);
  border-color: var(--login-accent-hover);
  transform: translateY(-2px);
  box-shadow: var(--login-shadow-lg);
}

.btn--primary:active {
  transform: translateY(0);
  box-shadow: var(--login-shadow-md);
}

.btn--primary:focus {
  outline: 3px solid var(--login-accent-light);
  outline-offset: 2px;
}

.btn--block {
  width: 100%;
}

/* Texto adicional perfeccionado */
.muted {
  text-align: center;
  margin: var(--login-space-2xl) 0 0 0;
  color: var(--login-text-muted);
  font-size: var(--login-font-size-sm);
  font-weight: 400;
  line-height: 1.6;
}

.muted a {
  color: var(--login-accent);
  text-decoration: none;
  font-weight: 600;
  transition: all var(--login-transition-base);
  position: relative;
}

.muted a::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--login-accent);
  transition: width var(--login-transition-base);
}

.muted a:hover::after {
  width: 100%;
}

.muted a:hover {
  color: var(--login-accent-hover);
  text-decoration: none;
}

/* Estados de carga perfeccionados */
.btn[data-loading="true"] {
  pointer-events: none;
  opacity: 0.8;
  position: relative;
}

.btn[data-loading="true"]::after {
  content: '';
  position: absolute;
  width: 16px;
  height: 16px;
  border: 2px solid transparent;
  border-top: 2px solid currentColor;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Responsive perfeccionado */
@media (max-width: 640px) {
  .auth-layout {
    padding: var(--login-space-lg);
    align-items: flex-start;
    padding-top: var(--login-space-2xl);
  }

  .auth-card {
    padding: var(--login-space-2xl) var(--login-space-lg);
    border-radius: var(--login-radius-xl);
    backdrop-filter: none;
  }

  .auth-title {
    font-size: var(--login-font-size-2xl);
  }

  .auth-subtitle {
    font-size: var(--login-font-size-sm);
  }

  .auth-logo img {
    max-width: 160px;
  }

  .field--row {
    flex-direction: column;
    align-items: flex-start;
    gap: var(--login-space-md);
  }

  .checkbox {
    font-size: var(--login-font-size-sm);
  }

  .btn {
    min-height: 48px;
    font-size: var(--login-font-size-sm);
  }
}

/* Animaciones sutiles perfeccionadas */
.auth-card {
  animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Aislamiento total - prevenir interferencias */
.auth-layout,
.auth-card,
.auth-form,
.field,
.label,
.btn,
input,
.auth-title,
.auth-subtitle,
.auth-alert,
.toggle-pass,
.checkbox,
.muted,
.link-muted {
  isolation: isolate;
  contain: layout style paint;
}

/* Accesibilidad perfeccionada */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}

/* Soporte para lectores de pantalla */
@media (prefers-reduced-motion: reduce) {
  .auth-card {
    animation: none;
  }
}

/* Validación visual perfeccionada */
input:invalid {
  border-color: #e53e3e;
  box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
}

input:valid {
  border-color: #38a169;
  box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.1);
}

/* Estados de foco accesibles */
input:focus,
.btn:focus,
.toggle-pass:focus {
  outline: 3px solid var(--login-accent-light);
  outline-offset: 2px;
}

/* Mejora de contraste para accesibilidad */
@media (prefers-contrast: high) {
  :root {
    --login-border: #000000;
    --login-text-light: #000000;
    --login-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
  }
}
</style>

<section class="auth-layout" aria-labelledby="login-titulo">
  <div class="auth-card" role="form">
    <header class="auth-header">
      <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
        <div class="auth-logo"><?php the_custom_logo(); ?></div>
      <?php endif; ?>

      <h1 id="login-titulo" class="auth-title">
        <?php echo $is_register ? __('Crea tu cuenta', 'academia-pro') : __('Accede a tu cuenta', 'academia-pro'); ?>
      </h1>

      <p class="auth-subtitle">
        <?php echo $is_register
          ? __('Únete a nuestra comunidad de aprendizaje y comienza tu viaje educativo.', 'academia-pro')
          : __('Bienvenido de vuelta. Continúa con tu aprendizaje.', 'academia-pro'); ?>
      </p>
    </header>

    <?php if ($errors) : ?>
      <div class="auth-alert" role="alert" aria-live="polite">
        <ul>
          <?php foreach($errors as $error) : ?>
            <li><?php echo esc_html($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="" class="auth-form" novalidate>
      <?php if ($is_register) : ?>
        <?php wp_nonce_field('academia_register', 'academia_register_nonce'); ?>
        <input type="hidden" name="accion" value="register" />
      <?php else : ?>
        <?php wp_nonce_field('academia_login', 'academia_login_nonce'); ?>
        <input type="hidden" name="accion" value="login" />
      <?php endif; ?>

      <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />

      <?php if ($is_register) : ?>
        <!-- FORMULARIO DE REGISTRO -->
        <div class="field">
          <label for="user_login" class="label"><?php _e('Nombre de usuario', 'academia-pro'); ?></label>
          <input id="user_login" name="user_login" type="text" autocomplete="username" required autofocus />
        </div>

        <div class="field">
          <label for="user_email" class="label"><?php _e('Email', 'academia-pro'); ?></label>
          <input id="user_email" name="user_email" type="email" autocomplete="email" required />
        </div>

        <div class="field">
          <label for="user_pass" class="label"><?php _e('Contraseña', 'academia-pro'); ?></label>
          <div class="input-with-action">
            <input id="user_pass" name="user_pass" type="password" autocomplete="new-password" required />
            <button type="button" class="toggle-pass" aria-label="<?php _e('Mostrar contraseña', 'academia-pro'); ?>" aria-controls="user_pass">👁️</button>
          </div>
        </div>

        <div class="field">
          <label for="user_pass_confirm" class="label"><?php _e('Confirmar contraseña', 'academia-pro'); ?></label>
          <div class="input-with-action">
            <input id="user_pass_confirm" name="user_pass_confirm" type="password" autocomplete="new-password" required />
            <button type="button" class="toggle-pass-confirm" aria-label="<?php _e('Mostrar contraseña', 'academia-pro'); ?>" aria-controls="user_pass_confirm">👁️</button>
          </div>
        </div>

        <div class="actions">
          <button type="submit" class="btn btn--primary btn--block" data-loading-text="<?php _e('Creando cuenta...', 'academia-pro'); ?>">
            <?php _e('Crear cuenta', 'academia-pro'); ?>
          </button>
        </div>

        <p class="muted">
          <?php _e('¿Ya tienes cuenta?', 'academia-pro'); ?>
          <a href="<?php echo esc_url(academia_pro_get_login_page_url($redirect_to)); ?>"><?php _e('Iniciar sesión', 'academia-pro'); ?></a>
        </p>

      <?php else : ?>
        <!-- FORMULARIO DE LOGIN -->
        <div class="field">
          <label for="user_login" class="label"><?php _e('Usuario o email', 'academia-pro'); ?></label>
          <input id="user_login" name="user_login" type="text" autocomplete="username" required autofocus />
        </div>

        <div class="field">
          <div class="label-row">
            <label for="user_pass" class="label"><?php _e('Contraseña', 'academia-pro'); ?></label>
            <a class="link-muted" href="<?php echo esc_url(wp_lostpassword_url($dashboard_url)); ?>"><?php _e('¿Olvidaste tu contraseña?', 'academia-pro'); ?></a>
          </div>
          <div class="input-with-action">
            <input id="user_pass" name="user_pass" type="password" autocomplete="current-password" required />
            <button type="button" class="toggle-pass" aria-label="<?php _e('Mostrar contraseña', 'academia-pro'); ?>" aria-controls="user_pass">👁️</button>
          </div>
        </div>

        <div class="field field--row">
          <label class="checkbox">
            <input type="checkbox" name="rememberme" value="1" />
            <span><?php _e('Recuérdame', 'academia-pro'); ?></span>
          </label>
        </div>

        <div class="actions">
          <button type="submit" class="btn btn--primary btn--block" data-loading-text="<?php _e('Accediendo...', 'academia-pro'); ?>">
            <?php _e('Acceder', 'academia-pro'); ?>
          </button>
        </div>

        <?php if (get_option('users_can_register')) : ?>
          <p class="muted">
            <?php _e('¿Aún no tienes cuenta?', 'academia-pro'); ?>
            <a href="<?php echo esc_url(academia_pro_get_login_page_url($redirect_to) . '?action=register'); ?>"><?php _e('Crear cuenta', 'academia-pro'); ?></a>
          </p>
        <?php endif; ?>
      <?php endif; ?>
    </form>
  </div>
</section>

<?php get_footer(); ?>

<!-- JavaScript Ultra-Profesional - Academia Pro -->
<script>
// =============================================
// LOGIN ULTRA-PROFESIONAL - ACADEMIA PRO
// JavaScript perfeccionado con acabados profesionales
// =============================================

(function() {
  'use strict';

  // Configuración global
  const CONFIG = {
    emailRegex: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    passwordMinLength: 6,
    animationDuration: 250,
    transitionEasing: 'cubic-bezier(0.4, 0, 0.2, 1)'
  };

  // Utilidades profesionales
  const Utils = {
    // Animación suave para elementos
    animate: function(element, property, from, to, duration = CONFIG.animationDuration) {
      if (!element) return;

      const start = performance.now();
      element.style.transition = `none`;

      function update(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);

        const easeProgress = 1 - Math.pow(1 - progress, 3);
        const currentValue = from + (to - from) * easeProgress;

        element.style[property] = currentValue + (property.includes('opacity') ? '' : 'px');

        if (progress < 1) {
          requestAnimationFrame(update);
        } else {
          element.style.transition = `all ${CONFIG.animationDuration}ms ${CONFIG.transitionEasing}`;
        }
      }

      requestAnimationFrame(update);
    },

    // Validación profesional de email
    validateEmail: function(email) {
      return CONFIG.emailRegex.test(email);
    },

    // Sanitización de texto
    sanitize: function(text) {
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    },

    // Generar ID único
    generateId: function() {
      return 'id_' + Math.random().toString(36).substr(2, 9);
    }
  };

  // Gestor de contraseñas
  const PasswordManager = {
    init: function() {
      this.setupToggleButtons();
      this.setupPasswordStrength();
    },

    setupToggleButtons: function() {
      document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', this.handleToggle.bind(this));
      });
    },

    handleToggle: function(event) {
      const btn = event.currentTarget;
      const targetId = btn.getAttribute('aria-controls');
      const input = document.getElementById(targetId);

      if (!input) return;

      const isPassword = input.type === 'password';
      const newType = isPassword ? 'text' : 'password';

      // Animación del cambio
      input.style.transform = 'scale(0.98)';
      setTimeout(() => {
        input.type = newType;
        input.style.transform = 'scale(1)';
      }, 50);

      // Actualizar estado del botón
      btn.textContent = isPassword ? '🙈' : '👁️';
      btn.setAttribute('aria-pressed', !isPassword);

      // Efecto de feedback visual
      btn.style.transform = 'scale(1.2)';
      setTimeout(() => {
        btn.style.transform = 'scale(1)';
      }, 150);
    },

    setupPasswordStrength: function() {
      const passwordInputs = document.querySelectorAll('input[type="password"]');
      passwordInputs.forEach(input => {
        input.addEventListener('input', this.checkStrength.bind(this));
      });
    },

    checkStrength: function(event) {
      const input = event.target;
      const value = input.value;

      if (value.length < CONFIG.passwordMinLength) {
        input.setCustomValidity('La contraseña debe tener al menos 6 caracteres');
        return;
      }

      input.setCustomValidity('');
    }
  };

  // Gestor de formularios
  const FormManager = {
    init: function() {
      this.setupValidation();
      this.setupSubmission();
      this.setupRealTimeValidation();
    },

    setupValidation: function() {
      const forms = document.querySelectorAll('.auth-form');
      forms.forEach(form => {
        this.validateForm(form);
      });
    },

    setupSubmission: function() {
      document.querySelectorAll('.auth-form').forEach(form => {
        form.addEventListener('submit', this.handleSubmit.bind(this));
      });
    },

    setupRealTimeValidation: function() {
      const inputs = document.querySelectorAll('input[required]');
      inputs.forEach(input => {
        input.addEventListener('input', this.handleInputChange.bind(this));
        input.addEventListener('blur', this.handleInputBlur.bind(this));
      });
    },

    handleSubmit: function(event) {
      const form = event.target;
      const submitBtn = form.querySelector('button[type="submit"]');

      if (!this.validateForm(form)) {
        event.preventDefault();
        return false;
      }

      // Estado de carga profesional
      if (submitBtn) {
        this.setLoadingState(submitBtn, true);
      }
    },

    handleInputChange: function(event) {
      const input = event.target;
      const form = input.closest('.auth-form');

      // Validación en tiempo real
      this.validateField(input);
      this.validateForm(form);
    },

    handleInputBlur: function(event) {
      const input = event.target;
      const form = input.closest('.auth-form');

      // Validación completa al perder foco
      this.validateField(input, true);
      this.validateForm(form);
    },

    validateForm: function(form) {
      if (!form) return true;

      const inputs = form.querySelectorAll('input[required]');
      const submitBtn = form.querySelector('button[type="submit"]');
      let isValid = true;

      inputs.forEach(input => {
        if (!this.validateField(input)) {
          isValid = false;
        }
      });

      // Validación especial para registro
      const isRegister = <?php echo $is_register ? 'true' : 'false'; ?>;
      if (isRegister && isValid) {
        isValid = this.validateRegistration(form);
      }

      // Actualizar estado del botón
      if (submitBtn) {
        this.updateSubmitButton(submitBtn, isValid);
      }

      return isValid;
    },

    validateField: function(input, showErrors = false) {
      const value = input.value.trim();
      const type = input.type;
      const name = input.name;

      // Reset estado
      input.setCustomValidity('');

      // Validación por tipo
      if (type === 'email' && value) {
        if (!Utils.validateEmail(value)) {
          input.setCustomValidity('El email no es válido');
          return false;
        }
      }

      if (type === 'password') {
        if (value.length < CONFIG.passwordMinLength) {
          input.setCustomValidity(`La contraseña debe tener al menos ${CONFIG.passwordMinLength} caracteres`);
          return false;
        }
      }

      if (name === 'user_pass_confirm' && value) {
        const password = document.getElementById('user_pass')?.value;
        if (password && value !== password) {
          input.setCustomValidity('Las contraseñas no coinciden');
          return false;
        }
      }

      return true;
    },

    validateRegistration: function(form) {
      const username = form.querySelector('#user_login')?.value;
      const email = form.querySelector('#user_email')?.value;
      const password = form.querySelector('#user_pass')?.value;
      const passwordConfirm = form.querySelector('#user_pass_confirm')?.value;

      if (!username || !email || !password || !passwordConfirm) {
        return false;
      }

      if (password !== passwordConfirm) {
        return false;
      }

      if (!Utils.validateEmail(email)) {
        return false;
      }

      if (password.length < CONFIG.passwordMinLength) {
        return false;
      }

      return true;
    },

    updateSubmitButton: function(btn, isValid) {
      if (!btn) return;

      btn.disabled = !isValid;
      btn.style.opacity = isValid ? '1' : '0.6';
      btn.style.cursor = isValid ? 'pointer' : 'not-allowed';
      btn.style.transform = isValid ? 'scale(1)' : 'scale(0.98)';
    },

    setLoadingState: function(btn, isLoading) {
      if (!btn) return;

      btn.disabled = true;
      btn.setAttribute('data-loading', isLoading);

      const originalText = btn.textContent;
      btn.textContent = isLoading ? 'Procesando...' : originalText;

      if (isLoading) {
        btn.innerHTML = '<span style="opacity: 0.7; margin-right: 8px;">●</span>' + btn.textContent;
      }
    }
  };

  // Gestor de animaciones
  const AnimationManager = {
    init: function() {
      this.setupEntranceAnimations();
      this.setupInteractionEffects();
    },

    setupEntranceAnimations: function() {
      // Animación de entrada de la tarjeta
      const card = document.querySelector('.auth-card');
      if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px) scale(0.95)';

        setTimeout(() => {
          card.style.opacity = '1';
          card.style.transform = 'translateY(0) scale(1)';
        }, 100);
      }
    },

    setupInteractionEffects: function() {
      // Efectos hover en campos
      document.querySelectorAll('.field').forEach(field => {
        field.addEventListener('mouseenter', () => {
          Utils.animate(field, 'transform', 0, -2, 200);
        });

        field.addEventListener('mouseleave', () => {
          Utils.animate(field, 'transform', -2, 0, 200);
        });
      });

      // Efectos hover en botones
      document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
          Utils.animate(btn, 'transform', 0, -2, 200);
        });

        btn.addEventListener('mouseleave', () => {
          Utils.animate(btn, 'transform', -2, 0, 200);
        });
      });
    }
  };

  // Inicialización cuando el DOM esté listo
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initialize);
  } else {
    initialize();
  }

  function initialize() {
    try {
      // Inicializar módulos
      PasswordManager.init();
      FormManager.init();
      AnimationManager.init();

      // Log de inicialización exitosa
      console.log('🎯 Login Ultra-Profesional inicializado correctamente');

    } catch (error) {
      console.error('❌ Error al inicializar el login:', error);
    }
  }

  // Exposición global para debugging (solo en desarrollo)
  if (typeof window !== 'undefined' && window.location.hostname === 'localhost') {
    window.LoginManager = {
      Utils,
      PasswordManager,
      FormManager,
      AnimationManager
    };
  }
})();
</script>