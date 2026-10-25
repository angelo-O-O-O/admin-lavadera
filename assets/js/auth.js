document.addEventListener('DOMContentLoaded', () => {
  const successScreen = document.querySelector('[data-login-success]');
  if (successScreen) {
    const dashboardUrl = successScreen.dataset.dashboardUrl || 'dashboard.php';
    window.setTimeout(() => {
      successScreen.classList.add('is-leaving');
      window.setTimeout(() => window.location.assign(dashboardUrl), 420);
    }, 1400);
  }

  const toggle = document.querySelector('[data-password-toggle]');
  const password = document.getElementById('password');
  if (!toggle || !password) return;

  toggle.addEventListener('click', () => {
    const reveal = password.type === 'password';
    password.type = reveal ? 'text' : 'password';
    toggle.setAttribute('aria-pressed', String(reveal));
    toggle.setAttribute('aria-label', reveal ? 'Hide password' : 'Show password');
    toggle.innerHTML = `<i class="bi ${reveal ? 'bi-eye-slash' : 'bi-eye'}" aria-hidden="true"></i>`;
  });
});
