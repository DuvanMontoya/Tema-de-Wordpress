<?php
/** Header del tema (accesible, seguro y performante) */
if ( ! defined('ABSPATH') ) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<?php if ( ! ( function_exists('academia_pro_is_tutor_dashboard') && academia_pro_is_tutor_dashboard() ) ) : ?>
  <!-- CSS CRÍTICO DE EMERGENCIA TOTAL - SOLUCIONANDO TODOS LOS PROBLEMAS -->
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
      --radius-md: .5rem;
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

    /* HEADER COMPLETAMENTE CENTRADO - SOLUCIÓN TOTAL */
    .site-header {
      background: var(--color-surface) !important;
      border-bottom: 1px solid var(--color-border) !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 1000 !important;
    }

    .site-header__inner {
      display: grid !important;
      grid-template-columns: 1fr auto 1fr !important;
      align-items: center !important;
      width: 100% !important;
      max-width: 1400px !important;
      margin: 0 auto !important;
      padding: 0 24px !important;
      height: 72px !important;
      gap: 16px !important;
    }

    .site-nav {
      justify-self: start !important;
    }

    .site-branding {
      justify-self: center !important;
      text-align: center !important;
    }

    .site-account {
      justify-self: end !important;
    }

    .site-branding .site-title,
    .site-branding a {
      font-size: 1.5rem !important;
      font-weight: 600 !important;
      color: var(--color-text-primary) !important;
      text-decoration: none !important;
      margin: 0 !important;
    }

    /* DROPDOWN MENU FUNCIONAL - SOLUCIÓN COMPLETA */
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
      transition: all 0.2s ease !important;
    }

    .account-toggle:hover {
      border-color: var(--color-primary) !important;
      background: var(--color-primary-50) !important;
      color: var(--color-primary) !important;
    }

    .user-avatar {
      width: 32px !important;
      height: 32px !important;
      border-radius: 50% !important;
      border: 2px solid var(--color-border) !important;
    }

    .account-name {
      font-size: 0.9rem !important;
      max-width: 100px !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
      white-space: nowrap !important;
    }

    .account-chevron {
      transition: transform 0.2s ease !important;
    }

    .account-toggle[aria-expanded="true"] .account-chevron {
      transform: rotate(180deg) !important;
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
      opacity: 0 !important;
      visibility: hidden !important;
      transform: translateY(-10px) !important;
      transition: all 0.2s ease !important;
      pointer-events: none !important;
    }

    .account-toggle[aria-expanded="true"] + .account-menu,
    .account-dropdown[aria-expanded="true"] .account-menu {
      opacity: 1 !important;
      visibility: visible !important;
      transform: translateY(0) !important;
      pointer-events: all !important;
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
      font-size: 0.9rem !important;
      font-weight: 500 !important;
    }

    .account-menu-item:hover {
      background: var(--color-primary-50) !important;
      color: var(--color-primary) !important;
    }

    .account-menu-separator {
      border: none !important;
      border-top: 1px solid var(--color-border) !important;
      margin: var(--space-1) 0 !important;
    }

    .account-menu-logout:hover {
      background: #fef2f2 !important;
      color: #dc2626 !important;
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

    /* SINGLE POST - CONTENIDO ANCHO COMPLETO */
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
      max-width: none !important;
    }

    .single-post-content {
      width: 100% !important;
      max-width: none !important;
    }

    .single-post-body {
      max-width: none !important;
      width: 100% !important;
      box-sizing: border-box !important;
      padding: var(--space-8) !important;
    }

    /* CONTENEDORES DE LECCIÓN - ESTRUCTURA PERFECTA */
    .contenedor-leccion {
      width: 100% !important;
      max-width: none !important;
      margin: 0 !important;
      padding: var(--space-8) !important;
      box-sizing: border-box !important;
      background: var(--color-surface) !important;
      border-radius: var(--radius-2xl) !important;
      box-shadow: var(--shadow-md) !important;
      border: 1px solid var(--color-border) !important;
    }

    .leccion-contenido {
      width: 100% !important;
      max-width: none !important;
      margin: 0 !important;
      padding: var(--space-6) !important;
      box-sizing: border-box !important;
      background: transparent !important;
    }

    /* ELEMENTOS DENTRO DE LECCION-CONTENIDO */
    .leccion-contenido h1,
    .leccion-contenido h2,
    .leccion-contenido h3,
    .leccion-contenido h4,
    .leccion-contenido h5,
    .leccion-contenido h6 {
      color: var(--color-text-primary) !important;
      margin: var(--space-6) 0 var(--space-4) 0 !important;
      line-height: 1.3 !important;
      font-weight: 700 !important;
    }

    .leccion-contenido h2 {
      font-size: clamp(1.5rem, 3vw, 2rem) !important;
      border-bottom: 2px solid var(--color-primary) !important;
      padding-bottom: var(--space-2) !important;
    }

    .leccion-contenido h3 {
      font-size: clamp(1.25rem, 2.5vw, 1.75rem) !important;
      color: var(--color-primary) !important;
    }

    .leccion-contenido p {
      color: var(--color-text-secondary) !important;
      line-height: 1.7 !important;
      margin-bottom: var(--space-6) !important;
      text-align: justify !important;
      hyphens: auto !important;
    }

    .leccion-contenido strong {
      color: var(--color-text-primary) !important;
      font-weight: 600 !important;
    }

    .leccion-contenido em {
      color: var(--color-primary) !important;
      font-style: italic !important;
    }

    /* LISTAS */
    .leccion-contenido ul,
    .leccion-contenido ol {
      margin: var(--space-4) 0 var(--space-6) 0 !important;
      padding-left: var(--space-6) !important;
    }

    .leccion-contenido li {
      color: var(--color-text-secondary) !important;
      line-height: 1.6 !important;
      margin-bottom: var(--space-2) !important;
    }

    .leccion-contenido li strong {
      color: var(--color-text-primary) !important;
    }

    /* BLOCKQUOTES */
    .leccion-contenido blockquote {
      background: var(--color-primary-50) !important;
      border-left: 4px solid var(--color-primary) !important;
      margin: var(--space-6) 0 !important;
      padding: var(--space-4) var(--space-6) !important;
      border-radius: 0 var(--radius-lg) var(--radius-lg) 0 !important;
      font-style: italic !important;
      color: var(--color-text-primary) !important;
    }

    /* HR - SEPARADORES */
    .leccion-contenido hr {
      border: none !important;
      height: 2px !important;
      background: linear-gradient(to right, transparent, var(--color-border), transparent) !important;
      margin: var(--space-8) 0 !important;
    }

    /* CAJAS ESPECIALES - DEFINITION, EXAMPLE, ETC */
    .leccion-contenido .definition,
    .leccion-contenido .example,
    .leccion-contenido .theorem,
    .leccion-contenido .proposition,
    .leccion-contenido .corollary,
    .leccion-contenido .lemma,
    .leccion-contenido .proof {
      background: var(--color-surface-elevated) !important;
      border: 1px solid var(--color-border) !important;
      border-radius: var(--radius-lg) !important;
      padding: var(--space-6) !important;
      margin: var(--space-6) 0 !important;
      box-shadow: var(--shadow-sm) !important;
      position: relative !important;
    }

    .leccion-contenido .definition {
      border-left: 4px solid #10b981 !important;
      background: #f0fdf4 !important;
    }

    .leccion-contenido .example {
      border-left: 4px solid #f59e0b !important;
      background: #fffbeb !important;
    }

    .leccion-contenido .theorem,
    .leccion-contenido .proposition,
    .leccion-contenido .corollary,
    .leccion-contenido .lemma {
      border-left: 4px solid var(--color-primary) !important;
      background: var(--color-primary-50) !important;
    }

    /* MATEMÁTICAS - MATHJAX */
    .leccion-contenido .MathJax,
    .leccion-contenido .mjx-chtml,
    .leccion-contenido mjx-container {
      color: var(--color-text-primary) !important;
      font-size: 1.1em !important;
    }

    /* CÓDIGO INLINE LIMPIO */
    code:not(pre code) {
      background: var(--color-surface-elevated) !important;
      color: var(--color-primary) !important;
      padding: 0.2em 0.4em !important;
      border-radius: 4px !important;
      font-family: 'Fira Code', 'Monaco', 'Consolas', monospace !important;
      font-size: 0.85em !important;
      border: 1px solid var(--color-border) !important;
    }

    /* ELIMINADO: Todos los estilos Shiki que causaban conflictos */

    /* TÍTULOS MEJORADOS */
    .single-post-title,
    .page-title,
    h1.entry-title {
      text-align: center !important;
      font-size: clamp(2rem, 4vw, 2.75rem) !important;
      font-weight: 700 !important;
      color: var(--color-text-primary) !important;
      margin: var(--space-8) 0 !important;
      position: relative !important;
      padding: var(--space-4) 0 !important;
    }

    .single-post-title::after,
    .page-title::after,
    h1.entry-title::after {
      content: '';
      position: absolute !important;
      bottom: 0 !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      width: 80px !important;
      height: 3px !important;
      background: linear-gradient(90deg, var(--color-primary-600), var(--color-primary-400)) !important;
      border-radius: 2px !important;
    }

    /* NAVEGACIÓN MEJORADA */
    .site-nav {
      display: flex !important;
      align-items: center !important;
      gap: var(--space-6) !important;
    }

    .site-nav .nav-menu {
      display: flex !important;
      list-style: none !important;
      margin: 0 !important;
      padding: 0 !important;
      gap: var(--space-4) !important;
    }

    .site-nav .nav-menu li {
      position: relative !important;
    }

    .site-nav .nav-menu a {
      color: var(--color-text-secondary) !important;
      text-decoration: none !important;
      font-weight: 500 !important;
      padding: var(--space-2) var(--space-3) !important;
      border-radius: var(--radius-md) !important;
      transition: all 0.2s ease !important;
      position: relative !important;
    }

    .site-nav .nav-menu a:hover {
      color: var(--color-primary) !important;
      background: var(--color-primary-50) !important;
    }

    .site-nav .nav-menu a::before {
      content: '';
      position: absolute !important;
      bottom: -2px !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      width: 0 !important;
      height: 2px !important;
      background: var(--color-primary) !important;
      transition: width 0.2s ease !important;
    }

    .site-nav .nav-menu a:hover::before {
      width: 100% !important;
    }

    /* BOTÓN MÓVIL MEJORADO */
    .mobile-menu-toggle {
      display: none !important;
      background: var(--color-surface) !important;
      border: 1px solid var(--color-border) !important;
      border-radius: var(--radius-lg) !important;
      padding: var(--space-3) !important;
      font-size: 1.2rem !important;
      color: var(--color-text-secondary) !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
    }

    .mobile-menu-toggle:hover {
      background: var(--color-primary-50) !important;
      border-color: var(--color-primary) !important;
      color: var(--color-primary) !important;
    }

    /* PÁRRAFOS Y CONTENIDO - RESPETANDO EL ANCHO */
    .single-post-body p,
    .leccion-contenido p,
    .contenedor-leccion p,
    .wp-block-post-content p,
    .entry-content p,
    .page-content-wrapper p {
      color: var(--color-text-secondary) !important;
      line-height: 1.7 !important;
      margin-bottom: var(--space-6) !important;
      max-width: none !important;
      width: 100% !important;
    }

    /* ELEMENTOS MATEMÁTICOS Y ESPECIALES */
    .single-post-body .theorem,
    .single-post-body .definition,
    .single-post-body .example,
    .leccion-contenido .theorem,
    .leccion-contenido .definition,
    .leccion-contenido .example,
    .contenedor-leccion .theorem,
    .contenedor-leccion .definition,
    .contenedor-leccion .example {
      width: 100% !important;
      max-width: none !important;
      box-sizing: border-box !important;
    }

    /* FOOTER MEJORADO */
    .site-footer {
      background: linear-gradient(135deg, var(--color-surface) 0%, var(--color-surface-elevated) 100%) !important;
      border-top: 1px solid var(--color-border) !important;
      margin-top: var(--space-24) !important;
      padding: var(--space-12) 0 !important;
      text-align: center !important;
      color: var(--color-text-primary) !important;
      position: relative !important;
      overflow: hidden !important;
    }

    .site-footer::before {
      content: '';
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      right: 0 !important;
      height: 1px !important;
      background: linear-gradient(90deg, transparent, var(--color-primary), transparent) !important;
    }

    .footer-title {
      color: var(--color-text-primary) !important;
      font-size: 1.4rem !important;
      font-weight: 600 !important;
      margin-bottom: var(--space-2) !important;
      position: relative !important;
    }

    .footer-meta,
    .footer-created {
      color: var(--color-text-secondary) !important;
      font-size: 0.95rem !important;
      font-weight: 400 !important;
    }

    .footer-created {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: var(--space-1) !important;
    }

    /* EFECTOS VISUALES MODERNOS */
    .post-card {
      backdrop-filter: blur(10px) !important;
      -webkit-backdrop-filter: blur(10px) !important;
    }

    .shiki-code-block {
      backdrop-filter: blur(10px) !important;
      -webkit-backdrop-filter: blur(10px) !important;
    }

    /* ANIMACIONES SUTILES */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .post-card {
      animation: fadeInUp 0.6s ease-out !important;
    }

    .shiki-code-block {
      animation: fadeInUp 0.6s ease-out !important;
    }

    /* SCROLLBAR PERSONALIZADO */
    ::-webkit-scrollbar {
      width: 8px !important;
      height: 8px !important;
    }

    ::-webkit-scrollbar-track {
      background: var(--color-surface) !important;
    }

    ::-webkit-scrollbar-thumb {
      background: var(--color-border) !important;
      border-radius: 4px !important;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--color-primary) !important;
    }

    /* MODO OSCURO PARA ELEMENTOS DE LECCIÓN */
    :root[data-theme="dark"] .contenedor-leccion,
    html[data-theme="dark"] .contenedor-leccion,
    body[data-theme="dark"] .contenedor-leccion,
    html.dark-mode .contenedor-leccion,
    body.dark-mode .contenedor-leccion {
      background: var(--color-surface) !important;
      border-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .leccion-contenido blockquote,
    html[data-theme="dark"] .leccion-contenido blockquote,
    body[data-theme="dark"] .leccion-contenido blockquote,
    html.dark-mode .leccion-contenido blockquote,
    body.dark-mode .leccion-contenido blockquote {
      background: rgba(79, 70, 229, 0.1) !important;
      border-left-color: var(--color-primary) !important;
      color: var(--color-text-primary) !important;
    }

    :root[data-theme="dark"] .leccion-contenido .definition,
    html[data-theme="dark"] .leccion-contenido .definition,
    body[data-theme="dark"] .leccion-contenido .definition,
    html.dark-mode .leccion-contenido .definition,
    body.dark-mode .leccion-contenido .definition {
      background: rgba(16, 185, 129, 0.1) !important;
      border-left-color: #10b981 !important;
      border-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .leccion-contenido .example,
    html[data-theme="dark"] .leccion-contenido .example,
    body[data-theme="dark"] .leccion-contenido .example,
    html.dark-mode .leccion-contenido .example,
    body.dark-mode .leccion-contenido .example {
      background: rgba(245, 158, 11, 0.1) !important;
      border-left-color: #f59e0b !important;
      border-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .leccion-contenido .theorem,
    :root[data-theme="dark"] .leccion-contenido .proposition,
    :root[data-theme="dark"] .leccion-contenido .corollary,
    :root[data-theme="dark"] .leccion-contenido .lemma,
    html[data-theme="dark"] .leccion-contenido .theorem,
    html[data-theme="dark"] .leccion-contenido .proposition,
    html[data-theme="dark"] .leccion-contenido .corollary,
    html[data-theme="dark"] .leccion-contenido .lemma,
    body[data-theme="dark"] .leccion-contenido .theorem,
    body[data-theme="dark"] .leccion-contenido .proposition,
    body[data-theme="dark"] .leccion-contenido .corollary,
    body[data-theme="dark"] .leccion-contenido .lemma,
    html.dark-mode .leccion-contenido .theorem,
    html.dark-mode .leccion-contenido .proposition,
    html.dark-mode .leccion-contenido .corollary,
    html.dark-mode .leccion-contenido .lemma,
    body.dark-mode .leccion-contenido .theorem,
    body.dark-mode .leccion-contenido .proposition,
    body.dark-mode .leccion-contenido .corollary,
    body.dark-mode .leccion-contenido .lemma {
      background: rgba(79, 70, 229, 0.1) !important;
      border-left-color: var(--color-primary) !important;
      border-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .leccion-contenido code,
    html[data-theme="dark"] .leccion-contenido code,
    body[data-theme="dark"] .leccion-contenido code,
    html.dark-mode .leccion-contenido code,
    body.dark-mode .leccion-contenido code {
      background: var(--color-surface-elevated) !important;
      color: var(--color-primary) !important;
      border-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .leccion-contenido pre,
    html[data-theme="dark"] .leccion-contenido pre,
    body[data-theme="dark"] .leccion-contenido pre,
    html.dark-mode .leccion-contenido pre,
    body.dark-mode .leccion-contenido pre {
      background: var(--color-surface-elevated) !important;
      color: var(--color-text-primary) !important;
      border-color: var(--color-border) !important;
    }

    /* MODO OSCURO PARA NUEVOS ELEMENTOS */
    :root[data-theme="dark"] .site-footer,
    html[data-theme="dark"] .site-footer,
    body[data-theme="dark"] .site-footer,
    html.dark-mode .site-footer,
    body.dark-mode .site-footer {
      background: linear-gradient(135deg, var(--color-surface) 0%, var(--color-surface-elevated) 100%) !important;
      border-top-color: var(--color-border) !important;
    }

    :root[data-theme="dark"] .site-nav .nav-menu a,
    html[data-theme="dark"] .site-nav .nav-menu a,
    body[data-theme="dark"] .site-nav .nav-menu a,
    html.dark-mode .site-nav .nav-menu a,
    body.dark-mode .site-nav .nav-menu a {
      color: var(--color-text-secondary) !important;
    }

    :root[data-theme="dark"] .site-nav .nav-menu a:hover,
    html[data-theme="dark"] .site-nav .nav-menu a:hover,
    body[data-theme="dark"] .site-nav .nav-menu a:hover,
    html.dark-mode .site-nav .nav-menu a:hover,
    body.dark-mode .site-nav .nav-menu a:hover {
      color: var(--color-primary) !important;
      background: rgba(96, 165, 250, 0.1) !important;
    }

    :root[data-theme="dark"] .mobile-menu-toggle,
    html[data-theme="dark"] .mobile-menu-toggle,
    body[data-theme="dark"] .mobile-menu-toggle,
    html.dark-mode .mobile-menu-toggle,
    body.dark-mode .mobile-menu-toggle {
      background: var(--color-surface) !important;
      border-color: var(--color-border) !important;
      color: var(--color-text-secondary) !important;
    }

    :root[data-theme="dark"] .mobile-menu-toggle:hover,
    html[data-theme="dark"] .mobile-menu-toggle:hover,
    body[data-theme="dark"] .mobile-menu-toggle:hover,
    html.dark-mode .mobile-menu-toggle:hover,
    body.dark-mode .mobile-menu-toggle:hover {
      background: rgba(96, 165, 250, 0.1) !important;
      border-color: var(--color-primary) !important;
      color: var(--color-primary) !important;
    }

    :root[data-theme="dark"] .shiki-code-block .copy-button,
    html[data-theme="dark"] .shiki-code-block .copy-button,
    body[data-theme="dark"] .shiki-code-block .copy-button,
    html.dark-mode .shiki-code-block .copy-button,
    body.dark-mode .shiki-code-block .copy-button {
      background: var(--color-surface) !important;
      border-color: var(--color-border) !important;
      color: var(--color-text-secondary) !important;
    }

    :root[data-theme="dark"] .shiki-code-block .copy-button:hover,
    html[data-theme="dark"] .shiki-code-block .copy-button:hover,
    body[data-theme="dark"] .shiki-code-block .copy-button:hover,
    html.dark-mode .shiki-code-block .copy-button:hover,
    body.dark-mode .shiki-code-block .copy-button:hover {
      background: rgba(96, 165, 250, 0.1) !important;
      border-color: var(--color-primary) !important;
      color: var(--color-primary) !important;
    }

    /* MOBILE RESPONSIVO */
    @media (max-width: 768px) {
      .site-header__inner {
        grid-template-columns: auto 1fr auto !important;
        gap: 8px !important;
      }
      
      .site-nav {
        display: none !important;
      }
      
      .mobile-menu-toggle {
        display: block !important;
      }
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
