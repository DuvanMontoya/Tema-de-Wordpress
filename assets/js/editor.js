(function(){
  // Script ligero para el editor (añadir clase si detecta patrones LaTeX)
  wp.domReady(function(){
    const root = document.querySelector('.editor-styles-wrapper');
    if(!root) return;
    const observer = new MutationObserver(function(){
      if (/\$\$|\\\(|\\\)/.test(root.innerText)) {
        root.classList.add('contiene-matematicas');
      }
    });
    observer.observe(root, { childList:true, subtree:true, characterData:true });
  });
})();
