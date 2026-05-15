const mobileMenu = document.getElementById("mobile-menu");
const navLinks = document.querySelector(".nav-links");
const ctaBtns = document.querySelector(".cta-btns");
const navbar = document.querySelector(".navbar");

mobileMenu.addEventListener("click", () => {

    navLinks.classList.toggle("active");

    const icon = mobileMenu.querySelector("i");

    icon.classList.toggle("fa-bars");
    icon.classList.toggle("fa-xmark");

});



window.addEventListener("scroll", () => {

    if (window.scrollY > 0) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }

});