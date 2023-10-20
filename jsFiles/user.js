
const path = 'gambarMenu';

const fileNames = ['bakmiAyam.jpg', 'esJeruk.jpg', 'nasiAyamGeprek.jpg', 'sateKambing.jpg']
console.log(`${path}/${fileNames[0]}`);

const heroImg = document.getElementById('hero-img');
let foodIdx = 0;

function changeFoodItem() {
  //animation sequence
  heroImg.style.opacity = 0;
  heroImg.src = `${path}/${fileNames[foodIdx]}`;
  heroImg.style.opacity = 1;

    


  if (foodIdx == fileNames.length -1 ) {
    foodIdx = 0;
    return;
  } 

  foodIdx++;

}


window.setInterval(changeFoodItem,5000);