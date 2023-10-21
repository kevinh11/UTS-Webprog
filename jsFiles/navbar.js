const hamburger = document.querySelector('.hamburger-menu');
const navMenu = document.getElementById('navbar-container');
const body = document.getElementsByTagName('body')[0];
let open = false;

function toggleNav() {
  open = open == false? true : false;
  if (open) {
    navMenu.style.top = '70px';
    //prevent scrolling while navbar open
    body.style.overflowY = 'hidden';
  }

  else {
    navMenu.style.top = '-3000px';
    body.style.overflowY='auto';
  }
}


hamburger.addEventListener('click', toggleNav);