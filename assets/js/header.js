(()=>{
  const $ = (sel, ctx=document)=>ctx.querySelector(sel);
  const $$ = (sel, ctx=document)=>Array.from(ctx.querySelectorAll(sel));

  const header = document.querySelector('.site-header');
  if (header) {
    const onScroll = ()=>{
      if(window.scrollY > 8) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    };
    document.addEventListener('scroll', onScroll, {passive:true});
    onScroll();
  }

  // Toggle menú móvil accesible
  const toggle = $('.site-nav__toggle');
  const nav = $('.site-nav');
  if (toggle && nav) {
    const closeOnEscape = (e)=>{
      if(e.key==='Escape') { nav.classList.remove('is-open'); toggle.setAttribute('aria-expanded','false'); }
    };
    toggle.addEventListener('click', ()=>{
      const open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (open) { document.addEventListener('keydown', closeOnEscape); }
      else { document.removeEventListener('keydown', closeOnEscape); }
    });
    // Cerrar al navegar
    nav.addEventListener('click', (e)=>{
      const t = e.target;
      if (t.tagName==='A') { nav.classList.remove('is-open'); toggle.setAttribute('aria-expanded','false'); }
    });
  }
  // Dropdown de cuenta
  const account = document.querySelector('[data-account]');
  if (account){
    const btn = account.querySelector('.account-toggle');
    const menu = account.querySelector('.account-menu');
    const close = ()=>{ menu.hidden = true; btn.setAttribute('aria-expanded','false'); account.setAttribute('aria-expanded','false'); };
    const open = ()=>{ menu.hidden = false; btn.setAttribute('aria-expanded','true'); account.setAttribute('aria-expanded','true'); };
    btn?.addEventListener('click', (e)=>{
      const isOpen = btn.getAttribute('aria-expanded') === 'true';
      if (isOpen) close(); else open();
    });
    document.addEventListener('click', (e)=>{
      if (!account.contains(e.target)) close();
    });
    document.addEventListener('keydown', (e)=>{
      if (e.key === 'Escape') close();
    });
  }
})();
