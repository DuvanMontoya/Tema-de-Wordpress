<?php
/**
 * Template Name: Página de acceso
 */
if (!defined('ABSPATH')) { exit; }

$errors = [];
$dashboard_url = home_url('/escritorio/');
// Normalizar redirect_to para prevenir bucles con acceso/?redirect_to=acceso...
$raw_redirect = isset($_REQUEST['redirect_to']) ? wp_unslash($_REQUEST['redirect_to']) : '';
if (function_exists('academia_pro_normalize_redirect')) {
  $redirect_to = academia_pro_normalize_redirect($raw_redirect);
} else {
  $redirect_to = $raw_redirect ?: $dashboard_url;
}

// Si ya está logueado, redirigir
// Si BuddyPress añade bp-auth=1&action=bpnoaccess, limpiar query y recargar sin esos params
if (isset($_GET['bp-auth']) || (isset($_GET['action']) && $_GET['action']==='bpnoaccess')) {
  $clean = remove_query_arg(['bp-auth','action']);
  wp_safe_redirect($clean);
  exit;
}

if (is_user_logged_in()) {
  wp_safe_redirect($redirect_to ?: $dashboard_url);
    exit;
}

// Procesar envío
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['accion']) && $_POST['accion']==='login') {
    check_admin_referer('academia_login','academia_login_nonce');
    $login    = sanitize_text_field(wp_unslash($_POST['user_login'] ?? ''));
    $password = $_POST['user_pass'] ?? '';
    $remember = !empty($_POST['rememberme']);

    if ($login==='') { $errors[] = __('Introduce tu usuario o email.','academia-pro'); }
    if ($password==='') { $errors[] = __('Introduce tu contraseña.','academia-pro'); }

    if (!$errors) {
        $creds = [
            'user_login'    => $login,
            'user_password' => $password,
            'remember'      => $remember,
        ];
        $user = wp_signon($creds, is_ssl());
        if (is_wp_error($user)) {
            $errors[] = strip_tags($user->get_error_message());
    } else {
      $destino = $redirect_to ?: $dashboard_url;
            wp_safe_redirect($destino);
            exit;
        }
    }
}

get_header();
?>

<section class="auth-layout" aria-labelledby="login-titulo">
  <div class="auth-card" role="form">
    <header class="auth-header">
      <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
        <div class="auth-logo"><?php the_custom_logo(); ?></div>
      <?php endif; ?>
      <h1 id="login-titulo" class="auth-title"><?php esc_html_e('Accede a tu cuenta','academia-pro'); ?></h1>
      <p class="auth-subtitle"><?php esc_html_e('Bienvenido de vuelta. Continúa con tu aprendizaje.','academia-pro'); ?></p>
    </header>

    <?php if ($errors) : ?>
      <div class="auth-alert" role="alert" aria-live="polite">
        <ul>
          <?php foreach($errors as $e): ?>
            <li><?php echo esc_html($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="" class="auth-form" novalidate>
      <?php wp_nonce_field('academia_login','academia_login_nonce'); ?>
      <input type="hidden" name="accion" value="login" />
      <input type="hidden" name="redirect_to" value="<?php echo esc_attr($redirect_to); ?>" />
      <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true" />

      <div class="field">
        <label for="user_login" class="label"><?php esc_html_e('Usuario o email','academia-pro'); ?></label>
  <input id="user_login" name="user_login" type="text" autocomplete="username" required autofocus />
      </div>

      <div class="field">
        <div class="label-row">
          <label for="user_pass" class="label"><?php esc_html_e('Contraseña','academia-pro'); ?></label>
          <a class="link-muted" href="<?php echo esc_url( wp_lostpassword_url($dashboard_url) ); ?>"><?php esc_html_e('¿Olvidaste tu contraseña?','academia-pro'); ?></a>
        </div>
        <div class="input-with-action">
          <input id="user_pass" name="user_pass" type="password" autocomplete="current-password" required />
          <button type="button" class="toggle-pass" aria-label="<?php esc_attr_e('Mostrar u ocultar contraseña','academia-pro'); ?>" aria-controls="user_pass">👁️</button>
        </div>
      </div>

      <div class="field field--row">
        <label class="checkbox"><input type="checkbox" name="rememberme" value="1" /> <span><?php esc_html_e('Recuérdame','academia-pro'); ?></span></label>
      </div>

      <div class="actions">
  <button type="submit" class="btn btn--primary btn--block" data-loading-text="<?php esc_attr_e('Accediendo…','academia-pro'); ?>"><?php esc_html_e('Acceder','academia-pro'); ?></button>
      </div>

      <?php if (get_option('users_can_register')) : ?>
        <p class="muted">
          <?php esc_html_e('¿Aún no tienes cuenta?','academia-pro'); ?>
          <a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e('Crear cuenta','academia-pro'); ?></a>
        </p>
      <?php endif; ?>
    </form>
  </div>
</section>

<?php get_footer();

// JS mínimo para toggle de contraseña
add_action('wp_footer', function(){
  ?>
  <script>
    (function(){
      var btn = document.querySelector('.toggle-pass');
      var inp = document.getElementById('user_pass');
      if (!btn || !inp) return;
      btn.addEventListener('click', function(){
        var isPwd = inp.getAttribute('type') === 'password';
        inp.setAttribute('type', isPwd ? 'text' : 'password');
        btn.setAttribute('aria-pressed', isPwd ? 'true' : 'false');
      });
      var form = document.querySelector('.auth-form');
      var submit = form ? form.querySelector('button[type="submit"]') : null;
      if (form && submit){
        form.addEventListener('submit', function(){
          submit.disabled = true;
          var t = submit.getAttribute('data-loading-text') || submit.textContent;
          submit.dataset.oldText = submit.textContent;
          submit.textContent = t;
        });
      }
    })();
  </script>
  <?php
});