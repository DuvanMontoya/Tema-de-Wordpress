<?php
/**
 * Script de utilidad para forzar la limpieza de caché del login
 * Útil cuando los cambios de CSS/JS del login no se reflejan inmediatamente
 *
 * Accede a este archivo directamente en tu navegador para limpiar la caché:
 * https://tusitio.com/wp-content/themes/academia-pro/cache-clear-login.php
 */

if (!defined('ABSPATH')) {
    // Si no estamos en WordPress, mostrar página de debug
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cache Cleared - Login Profesional</title>
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                text-align: center;
                padding: 50px;
                background: linear-gradient(135deg, #f7fafc 0%, #e2e8f0 100%);
                color: #1a365d;
                line-height: 1.6;
            }
            .container {
                background: white;
                padding: 3rem 2rem;
                border-radius: 16px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
                display: inline-block;
                max-width: 600px;
            }
            .success-icon {
                font-size: 4rem;
                color: #38a169;
                margin-bottom: 1rem;
            }
            .button {
                background: #3182ce;
                color: white;
                padding: 0.875rem 2rem;
                border: none;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                display: inline-block;
                margin: 1rem;
                transition: all 0.2s ease;
            }
            .button:hover {
                background: #2c5aa0;
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="success-icon">🎯</div>
            <h1>Cache de Login Limpiada</h1>
            <p>La caché de CSS, JavaScript y objetos del login ha sido limpiada exitosamente.</p>
            <p>Ahora puedes <a href="' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/acceso/')) . '" class="button">volver al login</a> para ver los cambios aplicados.</p>
            <p><small>Timestamp: ' . date('Y-m-d H:i:s') . '</small></p>
        </div>
    </body>
    </html>';
    exit;
}

// Si estamos en WordPress, limpiar caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Limpiar caché de WordPress
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
}

// Limpiar caché de objetos si está disponible
if (function_exists('wp_cache_clear_group')) {
    wp_cache_clear_group('login');
}

// Forzar recarga de assets
if (function_exists('wp_cache_delete')) {
    wp_cache_delete('login_css_version', 'options');
    wp_cache_delete('login_js_version', 'options');
}

// Limpiar cache de plugins si existe
if (function_exists('wp_cache_clear_plugins_cache')) {
    wp_cache_clear_plugins_cache();
}

// Mostrar resultado
echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cache Cleared - Login Profesional</title>
    <meta http-equiv="refresh" content="3;url=' . home_url('/acceso/') . '">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(135deg, #f7fafc 0%, #e2e8f0 100%);
            color: #1a365d;
            line-height: 1.6;
        }
        .container {
            background: white;
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            display: inline-block;
            max-width: 600px;
        }
        .success-icon {
            font-size: 4rem;
            color: #38a169;
            margin-bottom: 1rem;
        }
        .redirect {
            color: #718096;
            font-size: 0.9rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✅</div>
        <h1>Cache Limpiada Exitosamente</h1>
        <p>La caché del login ha sido limpiada completamente.</p>
        <p>Se aplicarán todos los cambios del diseño profesional.</p>
        <p class="redirect">Redirigiendo automáticamente al login...</p>
    </div>
</body>
</html>';
exit;
?>
