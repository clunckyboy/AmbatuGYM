const toggleButton = document.querySelector('.btn-toggle');
const navbarLogo = document.querySelector('.navbar img');
const sidenav = document.getElementById("mySidenav");

toggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    toggleNavbarLogo();
});


function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    
    // Tambahkan class untuk menandai sidenav terbuka
    document.body.classList.add('sidenav-open');
}

  /* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";

    // Hapus class untuk menandai sidenav tertutup
    document.body.classList.remove('sidenav-open');
}

function toggleNavbarLogo() {
    const isDarkMode = document.body.classList.contains('dark-mode');
    const lightSrc = navbarLogo.getAttribute('data-light');
    const darkSrc = navbarLogo.getAttribute('data-dark');
    navbarLogo.src = isDarkMode ? darkSrc : lightSrc;
}

