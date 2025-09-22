# 🎯 **GUÍA COMPLETA PARA GENERAR CONTENIDO ACADÉMICO PROFESIONAL**

## **INSTRUCCIONES PARA APROVECHAR AL MÁXIMO TODOS LOS ESTILOS DEL TEMA**

---

## 📚 **ESTRUCTURA PRINCIPAL DE CONTENIDO**

### **1. Contenedor de Lección (OBLIGATORIO)**
**HTML:**
```html
<div class="contenedor-leccion">
  <article class="leccion-contenido" role="article" aria-label="Título de la Lección">
    <!-- Todo el contenido va aquí -->
  </article>
</div>
```

### **2. Títulos Principales (H1)**
**HTML:**
```html
<h1>Título Principal de la Lección</h1>
```
**Estilos aplicados:**
- ✅ Tamaño responsive: `clamp(2rem, 4vw, 2.75rem)`
- ✅ Fuente serif elegante
- ✅ Color primario con gradiente
- ✅ Línea decorativa inferior automática
- ✅ Alineación centrada

---

## 🎨 **ELEMENTOS ACADÉMICOS ESPECIALES**

### **3. Teoremas, Lema, Proposiciones, Corolarios**
**HTML:**
```html
<div class="theorem">
  <h3 class="title">Teorema de Pitágoras</h3>
  <p>En un triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos.</p>
  <p>\[ a^2 + b^2 = c^2 \]</p>
</div>
```
**Opciones disponibles:**
- `.theorem` - Fondo azul degradado, etiqueta "Teorema"
- `.lemma` - Fondo azul más claro, etiqueta "Lema"
- `.proposition` - Fondo azul oscuro, etiqueta "Proposición"
- `.corollary` - Fondo acento, etiqueta "Corolario"

### **4. Definiciones**
**HTML:**
```html
<div class="definition">
  <h4>Definición: Función Continua</h4>
  <p>Una función \( f: \mathbb{R} \to \mathbb{R} \) es continua en un punto \( x_0 \) si para todo \( \epsilon > 0 \) existe \( \delta > 0 \) tal que...</p>
</div>
```
**Características:**
- ✅ Borde izquierdo verde
- ✅ Fondo verde muy sutil
- ✅ Etiqueta automática "Definición"
- ✅ Perfecto para conceptos matemáticos

### **5. Ejemplos**
**HTML:**
```html
<div class="example">
  <h4>Ejemplo: Suma de Riemann</h4>
  <p>Consideremos la función \( f(x) = x^2 \) en el intervalo [0,2]. Una partición...</p>
  <p>\[ \sum_{i=1}^n f(x_i^*) \Delta x_i \]</p>
</div>
```
**Características:**
- ✅ Borde izquierdo naranja
- ✅ Fondo naranja muy sutil
- ✅ Etiqueta automática "Ejemplo"
- ✅ Ideal para ilustraciones prácticas

### **6. Demostraciones**
**HTML:**
```html
<div class="proof">
  <p><strong>Demostración:</strong> Probemos que \( 1 + 1 = 2 \).</p>
  <p>Por definición de los números naturales...</p>
  <p>Por lo tanto, concluimos que la suma es correcta.</p>
</div>
```
**Características:**
- ✅ Fondo gris sutil
- ✅ Etiqueta automática "Demostración"
- ✅ Símbolo ∎ al final
- ✅ Estilo cursiva elegante

---

## 📝 **ELEMENTOS DE TEXTO AVANZADOS**

### **7. Citas y Blockquotes**
**HTML:**
```html
<blockquote>
  <p>"La estadística es el arte de aprender de los datos, la ciencia de la incertidumbre."</p>
  <cite>— Dr. Robert Montoya</cite>
</blockquote>
```
**Características:**
- ✅ Fondo degradado sutil
- ✅ Comilla ornamental grande
- ✅ Estilo cursiva elegante
- ✅ Soporte para citas

### **8. Listas Mejoradas**
**HTML:**
```html
<ul>
  <li><strong>Propiedad 1:</strong> La convergencia es uniforme</li>
  <li><strong>Propiedad 2:</strong> El límite es continuo</li>
  <li><strong>Propiedad 3:</strong> Se preserva la diferenciabilidad</li>
</ul>

<ol>
  <li>Primero calculamos la derivada</li>
  <li>Luego integramos la función</li>
  <li>Finalmente evaluamos el límite</li>
</ol>
```
**Características:**
- ✅ Viñetas personalizadas (▪ para ul, numeradas para ol)
- ✅ Colores primarios en marcadores
- ✅ Espaciado profesional
- ✅ Soporte para negritas y énfasis

### **9. Código con Shiki**
**HTML:**
```html
<pre><code class="language-python">
def fibonacci(n):
    if n <= 1:
        return n
    return fibonacci(n-1) + fibonacci(n-2)

# Ejemplo de uso
print(fibonacci(10))
</code></pre>
```

**O usando shortcode:**
```
[code lang="javascript" title="Función recursiva"]
function factorial(n) {
  return n <= 1 ? 1 : n * factorial(n-1);
}
[/code]
```

**Características:**
- ✅ Syntax highlighting automático con Shiki
- ✅ Temas GitHub Light/Dark
- ✅ Botón de copiar funcional
- ✅ Soporte para múltiples lenguajes

---

## 📊 **ELEMENTOS DE DATOS**

### **10. Tablas Elegantes**
**HTML:**
```html
<table>
  <thead>
    <tr>
      <th>Método</th>
      <th>Precisión</th>
      <th>Complejidad</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Gradiente Descendente</td>
      <td>Alta</td>
      <td>O(n²)</td>
    </tr>
    <tr>
      <td>Newton-Raphson</td>
      <td>Muy Alta</td>
      <td>O(n³)</td>
    </tr>
  </tbody>
</table>
```
**Características:**
- ✅ Bordes redondeados
- ✅ Header sticky en scroll
- ✅ Hover effects
- ✅ Responsive en móviles

### **11. Figuras e Imágenes**
**HTML:**
```html
<figure>
  <img src="grafica-convergencia.png" alt="Gráfica de convergencia del algoritmo">
  <figcaption>Figura 1: Comportamiento de convergencia del método propuesto</figcaption>
</figure>
```
**Características:**
- ✅ Fondo elevado sutil
- ✅ Bordes redondeados
- ✅ Sombra elegante
- ✅ Caption automático "Figura:"

---

## ⚠️ **ALERTAS Y NOTIFICACIONES**

### **12. Alertas Contextuales**
**HTML:**
```html
<div class="page-alert page-alert--info">
  <div class="page-alert-icon">💡</div>
  <div class="page-alert-content">
    <h4 class="page-alert-title">Información Importante</h4>
    <p class="page-alert-message">Recuerda que esta definición es fundamental para entender el resto del curso.</p>
  </div>
</div>
```
**Tipos disponibles:**
- `.page-alert--info` - Azul, para información general
- `.page-alert--success` - Verde, para resultados positivos
- `.page-alert--warning` - Amarillo, para advertencias
- `.page-alert--error` - Rojo, para errores críticos

---

## 🔬 **ELEMENTOS MATEMÁTICOS**

### **13. Ecuaciones y Fórmulas**
**HTML:**
```html
<p>La ecuación diferencial se resuelve como:</p>
\[ \frac{dy}{dx} = 2x + 3 \]

<p>Su solución general es:</p>
\[ y = x^2 + 3x + C \]

<p>Para condiciones iniciales \( y(0) = 1 \):</p>
\[ y = x^2 + 3x + 1 \]
```
**Características:**
- ✅ MathJax integrado
- ✅ Numeración automática
- ✅ Responsive en móviles
- ✅ Modo oscuro compatible

### **14. Ecuaciones en Línea**
**HTML:**
```html
<p>La derivada de \( f(x) = e^x \) es \( f'(x) = e^x \), y la integral \( \int e^x dx = e^x + C \).</p>
```
**Características:**
- ✅ Integración perfecta con texto
- ✅ Espaciado matemático correcto
- ✅ Compatible con modo oscuro

---

## 🎯 **ESTRUCTURA DE LECCIÓN COMPLETA EJEMPLO**

**HTML Completo:**
```html
<div class="contenedor-leccion">
  <article class="leccion-contenido" role="article" aria-label="Lección: Cálculo Diferencial">

    <h1>Cálculo Diferencial: Conceptos Fundamentales</h1>

    <blockquote>
      <p>"El cálculo es el lenguaje de la ciencia, permitiendo describir y predecir el comportamiento del universo."</p>
      <cite>— Isaac Newton</cite>
    </blockquote>

    <h2>1. Introducción al Concepto de Límite</h2>

    <div class="definition">
      <h4>Definición: Límite de una Función</h4>
      <p>Decimos que \( \lim_{x \to a} f(x) = L \) si para todo \( \epsilon > 0 \) existe \( \delta > 0 \) tal que...</p>
      <p>\[ 0 < |x - a| < \delta \implies |f(x) - L| < \epsilon \]</p>
    </div>

    <h2>2. Derivadas</h2>

    <div class="theorem">
      <h3 class="title">Teorema Fundamental del Cálculo</h3>
      <p>Si \( f \) es continua en [a,b] y \( F \) es una antiderivada de \( f \), entonces:</p>
      <p>\[ \int_a^b f(x) dx = F(b) - F(a) \]</p>
    </div>

    <div class="example">
      <h4>Ejemplo: Derivada de Función Exponencial</h4>
      <p>Consideremos \( f(x) = e^x \). Usando la definición de derivada:</p>
      <p>\[ f'(x) = \lim_{h \to 0} \frac{e^{x+h} - e^x}{h} = \lim_{h \to 0} e^x \frac{e^h - 1}{h} = e^x \]</p>
    </div>

    <h2>3. Aplicaciones</h2>

    <div class="proof">
      <p><strong>Demostración:</strong> Probemos que la derivada de una constante es cero.</p>
      <p>Sea \( f(x) = c \) para alguna constante c. Entonces:</p>
      <p>\[ f'(x) = \lim_{h \to 0} \frac{c - c}{h} = \lim_{h \to 0} 0 = 0 \]</p>
    </div>

    <table>
      <thead>
        <tr>
          <th>Función</th>
          <th>Derivada</th>
          <th>Integral</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>\( x^n \)</td>
          <td>\( nx^{n-1} \)</td>
          <td>\( \frac{x^{n+1}}{n+1} + C \)</td>
        </tr>
        <tr>
          <td>\( e^x \)</td>
          <td>\( e^x \)</td>
          <td>\( e^x + C \)</td>
        </tr>
      </tbody>
    </table>

    <div class="page-alert page-alert--warning">
      <div class="page-alert-icon">⚠️</div>
      <div class="page-alert-content">
        <h4 class="page-alert-title">Precaución</h4>
        <p class="page-alert-message">La diferenciabilidad implica continuidad, pero la continuidad no implica diferenciabilidad.</p>
      </div>
    </div>

    <h2>4. Ejercicios Propuestos</h2>

    <ol>
      <li><strong>Ejercicio 1:</strong> Calcula la derivada de \( f(x) = \sin(x) \cos(x) \)</li>
      <li><strong>Ejercicio 2:</strong> Encuentra el límite: \( \lim_{x \to 0} \frac{\sin(x)}{x} \)</li>
      <li><strong>Ejercicio 3:</strong> Demuestra que \( \frac{d}{dx} \ln|x| = \frac{1}{x} \) para \( x > 0 \)</li>
    </ol>

    <pre><code class="language-python">
# Implementación numérica de derivada
import numpy as np

def numerical_derivative(f, x, h=1e-5):
    return (f(x + h) - f(x - h)) / (2 * h)

# Ejemplo de uso
def f(x):
    return x**2 + 3*x + 1

print(f"Derivada en x=2: {numerical_derivative(f, 2)}")
# Resultado esperado: 7.0
    </code></pre>

  </article>
</div>
```

---

## 🎨 **ESTILOS Y TEMAS APROVECHABLES**

### **Temas de Código Disponibles:**
- `github-light` / `github-dark`
- `vitesse-light` / `vitesse-dark`
- `rose-pine`
- `catppuccin-mocha`
- `nord`

### **Colores de Elementos Especiales:**
- **Definiciones**: Borde verde (#10b981)
- **Ejemplos**: Borde naranja (#f59e0b)
- **Teoremas**: Borde azul (primario)
- **Alertas**: Info (azul), Success (verde), Warning (amarillo), Error (rojo)

### **Tipografías:**
- **Títulos**: Serif elegante (Ibarra Real Nova, Source Serif Pro)
- **Cuerpo**: Sans-serif moderno (Inter)
- **Código**: Monospace optimizado (Fira Code, Monaco)

---

## 🚀 **MEJOR PRÁCTICAS**

### **1. Estructura Jerárquica:**
```
h1 (Título principal)
├── h2 (Sección)
│   ├── h3 (Subsección)
│   │   ├── Definiciones
│   │   ├── Ejemplos
│   │   └── Teoremas
│   └── h3 (Otra subsección)
└── h2 (Otra sección)
```

### **2. Uso de Ecuaciones:**
- Usa **$...$** para ecuaciones en línea
- Usa **\[...\]** para ecuaciones centradas
- Usa **\\begin{equation}...\end{equation}** para ecuaciones numeradas

### **3. Combinaciones Efectivas:**
- **Teorema** + **Demostración** = Flujo lógico perfecto
- **Definición** + **Ejemplo** = Aprendizaje completo
- **Código** + **Explicación** = Implementación práctica

### **4. Elementos Visuales:**
- Usa **figuras** para gráficos y diagramas
- Usa **tablas** para comparaciones
- Usa **alertas** para resaltar información importante

---

## 📱 **RESPONSIVE Y ACCESIBILIDAD**

### **Características Incluidas:**
- ✅ **Responsive completo** en todos los dispositivos
- ✅ **Modo oscuro automático** con sincronización
- ✅ **Accesibilidad ARIA** en todos los elementos
- ✅ **Reducción de movimiento** para usuarios sensibles
- ✅ **Alto contraste** para mejor legibilidad
- ✅ **Navegación por teclado** completa
- ✅ **Screen readers** optimizados

---

## 🎯 **RESULTADO FINAL ESPERADO**

Al seguir estas instrucciones, generarás contenido académico que:

1. **Se ve profesional** con diseño editorial elegante
2. **Aprovecha todos los estilos** disponibles en el tema
3. **Es completamente funcional** con MathJax, Shiki, y elementos interactivos
4. **Funciona perfectamente** en modo claro y oscuro
5. **Es responsive** y accesible para todos los usuarios
6. **Sigue las mejores prácticas** de UX/UI académica

**¡Tu contenido se verá como un libro de texto profesional moderno!** 📚✨
