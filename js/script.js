//variables
let sections = document.querySelectorAll("section");
let links = document.querySelectorAll("nav li a");
let navbar = document.querySelector("nav");
/* on scroll[nav=>background] */
window.onscroll = () => {
  //console.log(window.scrollY);
  //changing backgorund color when scrolling over site*/
  if (window.scrollY > 120) {
    navbar.classList.add("navScroll");
  } else {
    navbar.classList.remove("navScroll");
  }
  
};
