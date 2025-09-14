# Tema de WordPress: Academia Pro

Un tema minimalista y limpio para plataformas educativas (TutorLMS / LearnDash compatibles) con enfoque en legibilidad, rendimiento y estilos no intrusivos.

## Características
- Header y footer simples, con borde sutil y sin sombras agresivas.
- Páginas y posts con tipografía clara y sin capas decorativas innecesarias.
- Página de login sobria.
- Integraciones básicas con TutorLMS y LearnDash sin romper sus layouts.
- Encolado de assets con cache-busting real (filemtime).

## Requisitos
- WordPress 6.x
- PHP 8.0+

## Instalación
1. Clona este repositorio dentro de `wp-content/themes/` como `academia-pro` (o sube el zip).
2. Activa el tema desde Apariencia > Temas.
3. (Opcional) Asigna el menú "menú-principal" y crea la página de inicio/entradas.

## Estructura
- `style.css`: cabecera del tema + tokens base.
- `inc/assets.php`: encolado de CSS/JS con control de contexto.
- `assets/css/`: estilos modulares (header-footer, pages, blog, auth, lms...).
- `templates/` y `page-templates/`: plantillas de página.

## Desarrollo
- Los estilos están pensados para ser minimalistas. Si necesitas personalizar, edita módulos en `assets/css/`.
- Para evitar romper layouts de LMS, no aplicar overrides globales; usar selectores específicos por plantilla.

## Capturas
Coloca aquí tus imágenes en `docs/screenshots/` y enlázalas.

## Licencia
MIT
