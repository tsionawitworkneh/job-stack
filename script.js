const mobileMenu = document.getElementById("mobile-menu");
const navLinks = document.querySelector(".nav-links");
const ctaBtns = document.querySelector(".cta-btns");

mobileMenu.addEventListener("click", () => {

    navLinks.classList.toggle("active");

});




const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {

    if (window.scrollY > 50) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }

});
