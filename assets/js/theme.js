document.addEventListener('DOMContentLoaded', () => {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.reveal-up').forEach((element) => io.observe(element));

  const chips = document.querySelectorAll('.chip');
  const items = document.querySelectorAll('.feed-item');
  chips.forEach((chip) => {
    chip.addEventListener('click', () => {
      chips.forEach((button) => button.classList.remove('on'));
      chip.classList.add('on');
      const filter = chip.dataset.f;
      items.forEach((item) => {
        const show = filter === 'all' || item.dataset.cat === filter;
        item.style.display = show ? '' : 'none';
      });
    });
  });

  const navToggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.nav-menu');
  if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
      nav.classList.toggle('open');
    });
  }
});
