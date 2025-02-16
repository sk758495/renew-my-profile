// Navbar Transparent Effect on Scroll
document.addEventListener("scroll", function () {
    let navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

// Typing Effect for H1 and P Tag
const titleText = "Crafting Modern & Responsive Websites";
const descText = "Elevate your online presence with stunning, user-friendly, and high-performance websites. Let's build something amazing together.";

let i = 0, j = 0;

function typeTitleEffect() {
    if (i < titleText.length) {
        document.querySelector(".hero-title").innerHTML += titleText.charAt(i);
        i++;
        setTimeout(typeTitleEffect, 100); // Adjust typing speed
    } else {
        setTimeout(typeDescEffect, 500); // Start p tag typing after h1 completes
    }
}

function typeDescEffect() {
    if (j < descText.length) {
        document.querySelector(".hero-description").innerHTML += descText.charAt(j);
        j++;
        setTimeout(typeDescEffect, 50); // Faster typing speed for description
    }
}

document.addEventListener("DOMContentLoaded", typeTitleEffect);



