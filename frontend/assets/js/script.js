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


// Tableau des images locales (en utilisant le chemin relatif)
const images = [
    'frontend/assets/images/face/me2.jpg', // Image 1
    'frontend/assets/images/face/devops.jpg', // Image 3
    'frontend/assets/images/face/hacking.jpg'
];

// Fonction pour changer l'image aléatoirement
function changerImage() {
    const randomIndex = Math.floor(Math.random() * images.length);
    const randomImage = images[randomIndex];

    // Modifier la source de l'image affichée
    document.getElementById('imageMe2').src = randomImage;
}

// Changer l'image toutes les 3 secondes (3000 ms)
setInterval(changerImage, 3000);

// Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}