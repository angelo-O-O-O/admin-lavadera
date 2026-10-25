document.addEventListener('DOMContentLoaded', () => {
  const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
  const adminBody = document.querySelector('.admin-body');
  const sidebar = document.getElementById('admin-sidebar');

  if (sidebarToggle && adminBody && sidebar) {
    const setSidebarExpanded = (expanded) => {
      adminBody.classList.toggle('sidebar-expanded', expanded);
      sidebarToggle.setAttribute('aria-expanded', String(expanded));
      const label = expanded ? 'Collapse sidebar' : 'Expand sidebar';
      sidebarToggle.setAttribute('aria-label', label);
      sidebarToggle.title = label;
      sidebarToggle.innerHTML = `<i class="bi ${expanded ? 'bi-x-lg' : 'bi-list'}" aria-hidden="true"></i>`;
    };

    sidebarToggle.addEventListener('click', (event) => {
      event.stopPropagation();
      setSidebarExpanded(!adminBody.classList.contains('sidebar-expanded'));
    });

    document.addEventListener('click', (event) => {
      if (adminBody.classList.contains('sidebar-expanded')
        && !sidebar.contains(event.target)
        && !sidebarToggle.contains(event.target)) {
        setSidebarExpanded(false);
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && adminBody.classList.contains('sidebar-expanded')) {
        setSidebarExpanded(false);
        sidebarToggle.focus();
      }
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth > 640) setSidebarExpanded(false);
    });
  }

  const toggle = document.querySelector('[data-theme-toggle]');
  if (!toggle) return;

  const root = document.documentElement;
  const storageKey = 'lavadera-admin-theme';

  const setTheme = (theme) => {
    const dark = theme === 'dark';
    root.dataset.theme = dark ? 'dark' : 'light';
    toggle.setAttribute('aria-pressed', String(dark));
    const label = dark ? 'Switch to light mode' : 'Switch to dark mode';
    toggle.setAttribute('aria-label', label);
    toggle.title = label;
    toggle.innerHTML = `<i class="bi ${dark ? 'bi-sun-fill' : 'bi-moon-stars-fill'}" aria-hidden="true"></i>`;
  };

  let savedTheme = 'light';
  try {
    savedTheme = localStorage.getItem(storageKey) || 'light';
  } catch (error) {
    // Keep the toggle usable when browser storage is disabled.
  }
  setTheme(savedTheme);

  toggle.addEventListener('click', () => {
    const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
    setTheme(nextTheme);
    try {
      localStorage.setItem(storageKey, nextTheme);
    } catch (error) {
      // Theme still applies for this page even if it cannot be saved.
    }
  });
});
