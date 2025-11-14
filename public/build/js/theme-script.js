// Dark Mode
document.addEventListener("DOMContentLoaded", function() {
  const darkModeToggle = document.getElementById('dark-mode-toggle');
  const lightModeToggle = document.getElementById('light-mode-toggle');

  function enableDarkMode() {
    document.body.classList.add('darkmode');
    if (darkModeToggle) darkModeToggle.classList.remove('active');
    if (lightModeToggle) lightModeToggle.classList.add('active');
    try { localStorage.setItem('darkMode', 'enabled'); } catch (e) {}
  }

  function disableDarkMode() {
    document.body.classList.remove('darkmode');
    if (darkModeToggle) darkModeToggle.classList.add('active');
    if (lightModeToggle) lightModeToggle.classList.remove('active');
    try { localStorage.setItem('darkMode', 'disabled'); } catch (e) {}
  }

  // Initial state
  try {
    if (localStorage.getItem('darkMode') === 'enabled') {
      enableDarkMode();
    } else {
      disableDarkMode();
    }
  } catch (e) {
    disableDarkMode();
  }

  // Toggle on same button if only one exists
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', function(e) {
      e.preventDefault();
      if (document.body.classList.contains('darkmode')) {
        disableDarkMode();
      } else {
        enableDarkMode();
      }
    });
  }

  // Optional separate light toggle
  if (lightModeToggle) {
    lightModeToggle.addEventListener('click', function(e) {
      e.preventDefault();
      disableDarkMode();
    });
  }
});
