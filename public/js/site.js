document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.nav');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open', !open);
    });
    nav.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
    }));
  }

  document.querySelectorAll('.flash').forEach((flash) => {
    const close = () => {
      flash.style.opacity = '0';
      window.setTimeout(() => flash.remove(), 220);
    };
    flash.querySelector('button')?.addEventListener('click', close);
    window.setTimeout(close, 5000);
  });
});
