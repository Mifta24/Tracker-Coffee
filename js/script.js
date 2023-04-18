// Toggle class active
const navbarNav=document.querySelector('.navbar-nav');

// ketika hamburger di klik
document.querySelector('#hamburger-menu').onclick = () => {
navbarNav.classList.toggle('active');
};


// klik diluar sidebar untuk menghilangkan nav
const hamburger = document.querySelector('#hamburger-menu');

document.addEventListener("click",function (e) {
    if (!hamburger.contains(e.target)&& !navbarNav.contains(e.target)) {
      navbarNav.classList.remove('active');  
    }
});