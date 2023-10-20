const hamburger = document.querySelector('.hamburger-menu');
const navMenu = document.getElementById('navbar-container')
let open = false;

function toggleNav() {
  open = open == false? true : false;

  if (open) {
    navMenu.style.display = 'flex';
  }

  else {
    navMenu.style.display = 'none'
  }
}


hamburger.addEventListener('click', toggleNav);