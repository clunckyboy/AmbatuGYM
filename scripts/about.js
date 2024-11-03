const toggleButton = document.querySelector('.btn-toggle');
const navbarLogo = document.querySelector('.navbar img');


toggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    toggleNavbarLogo();
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function toggleNavbarLogo() {
    const isDarkMode = document.body.classList.contains('dark-mode');
    const lightSrc = navbarLogo.getAttribute('data-light');
    const darkSrc = navbarLogo.getAttribute('data-dark');
    navbarLogo.src = isDarkMode ? darkSrc : lightSrc;
}