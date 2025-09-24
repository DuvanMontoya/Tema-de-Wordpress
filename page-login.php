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

<!-- LOGIN PROFESIONAL - CSS EMPRESARIAL -->
<style>
/* ====================================================
   LOGIN EMPRESARIAL PROFESIONAL - ACADEMIA PRO
   ==================================================== */

/* Variables CSS empresariales */
:root {
  --login-primary: #1a365d;
  --login-accent: #3182ce;
  --login-border: #e2e8f0;
  --login-text: #2d3748;
  --login-text-light: #718096;
  --login-background: #f7fafc;
  --login-card-bg: #ffffff;
  --login-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --login-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

/* Layout principal */
.auth-layout {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  background: var(--login-background);
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Tarjeta profesional */
.auth-card {
  width: 100%;
  max-width: 420px;
  background: var(--login-card-bg);
  border: 1px solid var(--login-border);
  border-radius: 12px;
  box-shadow: var(--login-shadow);
  padding: 3rem 2.5rem;
}

/* Header profesional */
.auth-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.auth-title {
  font-size: 1.875rem;
  font-weight: 700;
  color: var(--login-primary);
  margin: 0 0 0.75rem 0;
  line-height: 1.2;
  letter-spacing: -0.025em;
}

.auth-subtitle {
  font-size: 1rem;
  color: var(--login-text-light);
  font-weight: 400;
  margin: 0;
  line-height: 1.5;
}

.auth-logo img {
  max-width: 180px;
  height: auto;
}

/* Alertas */
.auth-alert {
  background: #fef5e7;
  border: 1px solid #f6e05e;
  border-radius: 8px;
  padding: 1rem 1.25rem;
  margin-bottom: 2rem;
  color: #744210;
}

.auth-alert ul {
  margin: 0;
  padding-left: 1.5rem;
}

.auth-alert li {
  margin-bottom: 0.5rem;
}

.auth-alert li:last-child {
  margin-bottom: 0;
}

/* Formulario */
.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

/* Campos */
.field {
  position: relative;
}

.label {
  display: block;
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--login-text);
  margin-bottom: 0.5rem;
}

.label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.link-muted {
  color: var(--login-text-light);
  text-decoration: none;
  font-size: 0.875rem;
  transition: color 0.2s ease;
  font-weight: 500;
}

.link-muted:hover {
  color: var(--login-accent);
  text-decoration: underline;
}

.input-with-action {
  position: relative;
}

input[type="text"],
input[type="password"],
input[type="email"] {
  width: 100%;
  padding: 0.875rem 1rem;
  border: 2px solid var(--login-border);
  border-radius: 8px;
  font-size: 1rem;
  background: white;
  transition: all 0.2s ease;
  outline: none;
  color: var(--login-text);
}

input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus {
  border-color: var(--login-accent);
  box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
  background: white;
}

input::placeholder {
  color: var(--login-text-light);
  opacity: 1;
}

.toggle-pass {
  position: absolute;
  right: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--login-text-light);
  cursor: pointer;
  font-size: 1.125rem;
  padding: 0.5rem;
  border-radius: 4px;
  transition: color 0.2s ease;
}

.toggle-pass:hover {
  color: var(--login-accent);
}

/* Checkbox */
.field--row {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.checkbox {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  cursor: pointer;
  font-size: 0.875rem;
  color: var(--login-text);
  font-weight: 500;
}

.checkbox input {
  accent-color: var(--login-accent);
}

/* Botones */
.actions {
  margin-top: 1rem;
}

.btn {
  padding: 0.875rem 1.5rem;
  border: 2px solid transparent;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  min-height: 48px;
  text-align: center;
}

.btn--primary {
  background: var(--login-accent);
  color: white;
  width: 100%;
  border-color: var(--login-accent);
}

.btn--primary:hover {
  background: #2c5aa0;
  border-color: #2c5aa0;
  transform: translateY(-1px);
  box-shadow: var(--login-shadow-hover);
}

.btn--block {
  width: 100%;
}

/* Texto adicional */
.muted {
  text-align: center;
  margin: 2rem 0 0 0;
  color: var(--login-text-light);
  font-size: 0.875rem;
  font-weight: 400;
}

.muted a {
  color: var(--login-accent);
  text-decoration: none;
  font-weight: 600;
  transition: color 0.2s ease;
}

.muted a:hover {
  color: #2c5aa0;
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 640px) {
  .auth-layout {
    padding: 1.5rem;
  }

  .auth-card {
    padding: 2.5rem 2rem;
  }

  .auth-title {
    font-size: 1.75rem;
  }

  .field--row {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
}

/* Modo oscuro */
@media (prefers-color-scheme: dark) {
  :root {
    --login-primary: #e2e8f0;
    --login-accent: #63b3ed;
    --login-border: #4a5568;
    --login-text: #e2e8f0;
    --login-text-light: #a0aec0;
    --login-background: #1a202c;
    --login-card-bg: #2d3748;
  }

  .auth-layout {
    background: var(--login-background);
  }

  .auth-title {
    color: var(--login-primary);
  }

  .auth-subtitle {
    color: var(--login-text-light);
  }

  input[type="text"],
  input[type="password"],
  input[type="email"] {
    background: #1a202c;
    border-color: var(--login-border);
    color: var(--login-text);
  }

  input[type="text"]:focus,
  input[type="password"]:focus,
  input[type="email"]:focus {
    background: #2d3748;
    border-color: var(--login-accent);
  }

  .toggle-pass {
    color: var(--login-text-light);
  }

  .toggle-pass:hover {
    color: var(--login-accent);
  }

  .checkbox {
    color: var(--login-text-light);
  }

  .auth-alert {
    background: #2d1b2d;
    border-color: #9f3a9f;
    color: #e6b3e6;
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

<!-- JavaScript profesional -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle de contraseña
  document.querySelectorAll('.toggle-pass').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var targetId = this.getAttribute('aria-controls');
      var input = document.getElementById(targetId);
      if (input) {
        var isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.textContent = isPassword ? '🙈' : '👁️';
        this.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
      }
    });
  });

  // Validación en tiempo real
  var isRegister = <?php echo $is_register ? 'true' : 'false'; ?>;

  document.querySelectorAll('.auth-form').forEach(function(form) {
    var submitBtn = form.querySelector('button[type="submit"]');
    var inputs = form.querySelectorAll('input[required]');

    function validateForm() {
      var isValid = true;

      inputs.forEach(function(input) {
        if (!input.value.trim()) {
          isValid = false;
        }

        if (input.type === 'email' && input.value) {
          var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(input.value)) {
            isValid = false;
          }
        }

        if (isRegister && input.type === 'password') {
          if (input.value.length < 6) {
            isValid = false;
          }

          var confirmPass = form.querySelector('#user_pass_confirm');
          if (confirmPass && input.id === 'user_pass') {
            if (input.value !== confirmPass.value) {
              isValid = false;
            }
          }
        }
      });

      if (submitBtn) {
        submitBtn.disabled = !isValid;
        submitBtn.style.opacity = isValid ? '1' : '0.6';
        submitBtn.style.cursor = isValid ? 'pointer' : 'not-allowed';
      }
    }

    inputs.forEach(function(input) {
      input.addEventListener('input', validateForm);
      input.addEventListener('blur', validateForm);
    });

    validateForm(); // Validación inicial
  });

  // Estados de carga
  document.querySelectorAll('.auth-form').forEach(function(form) {
    form.addEventListener('submit', function() {
      var submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span style="opacity: 0.7;">●</span> ' + submitBtn.textContent;
      }
    });
  });
});
</script>