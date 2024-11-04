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

  /*Objective toggle*/

const toggleOptions = document.getElementById('toggle-options');
const toggleList = document.getElementById('toggle-list');
const objectivePlaceholder = document.getElementById('objective-placeholder');

// Toggle the visibility of the list
toggleOptions.addEventListener('click', () => {
    toggleList.style.display = toggleList.style.display === 'block' ? 'none' : 'block';
});

// Handle option selection
const toggleItems = document.querySelectorAll('.toggle-option');
toggleItems.forEach(item => {
    item.addEventListener('click', () => {
        objectivePlaceholder.textContent = item.textContent; // Set the selected value
        toggleList.style.display = 'none'; // Hide the list
    });
});

// Close the toggle list when clicking outside
document.addEventListener('click', (event) => {
    if (!toggleOptions.contains(event.target) && !toggleList.contains(event.target)) {
        toggleList.style.display = 'none';
    }
});


function logout() {
    // Clear any session data if needed
    // For example: localStorage.clear();

    // Redirect to the login page
    window.location.href = 'login.html';
}


