(()=>{'use strict';
  const $ = (sel,ctx=document)=>ctx.querySelector(sel);
  const $$ = (sel,ctx=document)=>Array.from(ctx.querySelectorAll(sel));

  document.addEventListener('DOMContentLoaded', ()=>{
    // Navegación activa
    const path = window.location.pathname.replace(/\/+/g,'/');
    $$('.menu-principal a').forEach(a=>{ if(a.getAttribute('href') && path !== '/' && a.getAttribute('href').indexOf(path)!==-1){ a.setAttribute('aria-current','page'); } });

    // Índice dinámico
    const contenido = $('.leccion-contenido');
    const indiceLista = $('.leccion-indice');
    if (contenido && indiceLista) {
      let i=0; $$('h2, h3', contenido).forEach(h=>{ if(!h.id) h.id = 'seccion-'+(++i); const li=document.createElement('li'); const a=document.createElement('a'); a.href='#'+h.id; a.textContent=(h.tagName==='H3'?' — ':'')+h.textContent; li.appendChild(a); indiceLista.appendChild(li); });
      indiceLista.addEventListener('click', e=>{ if(e.target.tagName==='A'){ const dest=$(e.target.getAttribute('href')); if(dest){ e.preventDefault(); window.scrollTo({top: dest.getBoundingClientRect().top + window.scrollY - 90, behavior:'smooth'}); $$('.leccion-indice a').forEach(x=>x.classList.remove('activo')); e.target.classList.add('activo'); } }});
    }

    // Filtro AJAX cursos
    const filtro = $('#filtro-cursos');
    const grid = $('#cursos-grid');
    if (filtro && grid) {
      filtro.addEventListener('submit', e=>{ e.preventDefault(); const fd = new FormData(filtro); const params = new URLSearchParams(fd).toString(); grid.setAttribute('aria-busy','true'); grid.style.opacity='0.5'; fetch(window.location.origin + '/wp-json/academia-pro/v1/cursos?'+params).then(r=>r.json()).then(data=>{ grid.innerHTML=''; if(data.cursos && data.cursos.length){ data.cursos.forEach(c=>{ const card=document.createElement('div'); card.className='curso-tarjeta'; card.innerHTML=`<div class="curso-tarjeta__media"><a href="${c.url}"><img src="${c.thumb||''}" alt=""></a></div><div class="curso-tarjeta__body"><h3 class="curso-tarjeta__titulo"><a href="${c.url}">${c.titulo}</a></h3><div class="curso-tarjeta__meta"><span>${c.nivel||'General'}</span><span>${c.fecha}</span></div><div class="curso-tarjeta__progreso" data-progreso-id="${c.id}"></div></div>`; grid.appendChild(card); }); cargarProgresos(); } else { grid.innerHTML = '<p>No hay resultados.</p>'; } }).catch(()=>{ grid.innerHTML='<p>Error al cargar.</p>'; }).finally(()=>{ grid.removeAttribute('aria-busy'); grid.style.opacity='1'; });
      });
    }

    function cargarProgresos(){
      $$('[data-progreso-id]').forEach(holder=>{ const id=holder.getAttribute('data-progreso-id'); fetch(`/wp-json/academia-pro/v1/progreso/${id}`).then(r=>{ if(r.status===403) return null; return r.json(); }).then(d=>{ if(!d) return; holder.innerHTML = `<div class="barra-progreso"><div class="barra-progreso__relleno" style="width:${d.progreso}%"></div></div>`; }); });
    }
    cargarProgresos();

  // Re-typeset MathJax en eventos LMS comunes
  ['tutor_tab_changed','learndash_topic_loaded'].forEach(ev=>document.addEventListener(ev, ()=>{ if(window.MathJax && window.MathJax.typesetPromise){ window.MathJax.typesetPromise(); }}));

    /* =============================
       Scroll spy automático (IntersectionObserver)
       ============================= */
    if(indiceLista){
      const headings = $$('h2, h3', contenido);
      const io = new IntersectionObserver(entries=>{
        entries.forEach(en=>{
          if(en.isIntersecting){
            const id = en.target.id;
            const link = indiceLista.querySelector(`a[href="#${id}"]`);
            if(link){ $$('.leccion-indice a').forEach(a=>a.classList.remove('activo')); link.classList.add('activo'); }
          }
        });
      }, { rootMargin: '-40% 0px -55% 0px', threshold:[0,1] });
      headings.forEach(h=>io.observe(h));
    }

    /* =============================
       Botón copiar en bloques de código
       ============================= */
    $$('pre').forEach(pre=>{
      if(pre.querySelector('.btn-copiar-codigo')) return;
      const btn = document.createElement('button');
      btn.type='button';
      btn.className='btn-copiar-codigo';
      btn.textContent='Copiar';
      btn.addEventListener('click', ()=>{
        const code = pre.querySelector('code');
        if(!code) return;
        navigator.clipboard.writeText(code.textContent).then(()=>{
          btn.classList.add('ok'); btn.textContent='Copiado'; setTimeout(()=>{ btn.classList.remove('ok'); btn.textContent='Copiar'; }, 1800);
        }).catch(()=>{ btn.textContent='Error'; setTimeout(()=>btn.textContent='Copiar', 1500); });
      });
      pre.appendChild(btn);
    });

    /* =============================
       Autodetección media (iframe/video)
       ============================= */
    $$('.leccion-contenido iframe, .leccion-contenido video').forEach(m=>{
      const w = document.createElement('div');
      w.className='media-leccion';
      m.parentElement.insertBefore(w, m); w.appendChild(m);
    });
  });
})();
