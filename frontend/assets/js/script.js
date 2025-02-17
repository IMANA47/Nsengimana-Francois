"use strict";

const burgerMenuButton = document.querySelector(".burger-menu-button");
const burgerMenuButtonIcon = document.querySelector(".burger-menu-button i");
const burgerMenu = document.querySelector(".burger-menu");

burgerMenuButton.onclick = function () {
  burgerMenu.classList.toggle("open");
  const isOpen = burgerMenu.classList.contains("open");
  burgerMenuButtonIcon.classList = isOpen
    ? "fa-solid fa-xmark"
    : "fa-solid fa-bars";
};

//dark mode

const themeToggle = document.getElementById('theme-toggle');
const body = document.body;

// Vérifie le mode sauvegardé dans le localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
  body.setAttribute('data-theme', savedTheme);
  updateButtonText(savedTheme);
}

// Fonction pour basculer entre les modes
themeToggle.addEventListener('click', () => {
  const currentTheme = body.getAttribute('data-theme');
  if (currentTheme === 'dark') {
    body.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
  } else {
    body.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
  }
  updateButtonText(body.getAttribute('data-theme'));
});

// Fonction pour mettre à jour le texte du bouton
function updateButtonText(theme) {
  themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
}
