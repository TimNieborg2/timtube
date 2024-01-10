const appearanceBtn = document.querySelector('#appearance-btn');
const appearanceText = document.querySelector('#appearance-text');

function setTheme(theme) {
  localStorage.setItem('color-theme', theme);
  document.documentElement.classList.toggle('dark', theme === 'dark');
  appearanceText.innerHTML = theme;
}

const preferredTheme = localStorage.getItem('color-theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
setTheme(preferredTheme);

appearanceBtn.addEventListener('click', () => {
  const currentTheme = localStorage.getItem('color-theme');
  setTheme(currentTheme === 'dark' ? 'light' : 'dark');
});