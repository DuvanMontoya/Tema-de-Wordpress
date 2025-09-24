<?php
/**
 * Script de utilidad para limpiar cache de login
 * Ejecutar esto si los estilos de login no se aplican correctamente
 */

if (!defined('ABSPATH')) {
    exit;
}

// Limpiar todas las caches posibles
wp_cache_flush();
delete_transient('academia_pro_login_context_cache');
delete_option('academia_pro_cache_version');

// Regenerar archivos de cache si existe plugin de cache
if (function_exists('w3tc_flush_all')) {
    w3tc_flush_all();
}

if (function_exists('wp_fastest_cache_remove')) {
    wp_fastest_cache_remove();
}

if (function_exists('rocket_clean_domain')) {
    rocket_clean_domain();
}

// Forzar regenerar CSS
if (function_exists('academia_pro_asset_ver')) {
    $css_files = [
        'assets/css/auth.css',
        'assets/css/style.css',
        'style.css'
    ];

    foreach ($css_files as $file) {
        $ver = academia_pro_asset_ver($file);
        error_log("Cache clear: $file version $ver");
    }
}

echo '✅ Cache de login limpiado. Los estilos deberían cargarse correctamente ahora.';
echo '<br><a href="' . wp_login_url() . '">Ir a página de login</a>';
