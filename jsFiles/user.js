
const path = 'gambarMenu';

const fileNames = ['bakmiAyam.jpg', 'nasiGorengSeafood.jpg', 'nasiAyamGeprek.jpg', 'sateKambing.jpg'];
const heroImg = document.getElementById('hero-img');
let foodIdx = 0;

function setRandomFoodPic() {
  let randomNum = Math.floor(Math.random() * (fileNames.length));
  heroImg.src = `${path}/${fileNames[Math.abs(randomNum)]}`;
}



window.addEventListener('load',setRandomFoodPic);