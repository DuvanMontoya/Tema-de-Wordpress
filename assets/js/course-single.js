// JS modular para página de curso individual: UX y rendimiento
(function(){
  // Lite YouTube embed: delegación
  document.addEventListener('click', function(e){
    const a = e.target.closest('.lite-yt');
    if(!a) return;
    e.preventDefault();
    const id = a.getAttribute('data-video');
    if(!id) return;
    const src = 'https://www.youtube.com/embed/'+encodeURIComponent(id)+'?autoplay=1&rel=0';
    const iframe = document.createElement('iframe');
    iframe.width = '560'; iframe.height = '315';
    iframe.src = src; iframe.title = 'YouTube video player';
    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
    iframe.allowFullscreen = true; iframe.loading = 'lazy';
    iframe.style.width='100%'; iframe.style.height='100%'; iframe.style.border='0';
    a.replaceWith(iframe);
  });

  // Accordeón suave para temario si el LMS no provee UX agradable
  const temarios = document.querySelectorAll('.curso-temario details');
  temarios.forEach(d=>{
    d.addEventListener('toggle', ()=>{
      if(d.open){
        // cerrar otros hermanos
        d.parentElement?.querySelectorAll('details[open]')?.forEach(x=>{ if(x!==d) x.open=false; });
      }
    });
  });

  // Mejor feedback en acciones
  document.querySelectorAll('.curso-cta [data-loading]').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const old = btn.textContent;
      btn.setAttribute('aria-busy','true');
      btn.disabled = true;
      btn.textContent = btn.getAttribute('data-loading') || 'Procesando…';
      setTimeout(()=>{ btn.removeAttribute('aria-busy'); btn.disabled=false; btn.textContent = old; }, 2000);
    });
  });
})();
