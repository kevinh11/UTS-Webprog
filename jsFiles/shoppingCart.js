const orderAmounts = document.getElementsByClassName('amount');
const plusSigns = Array.from(document.getElementsByClassName('plus'));
const minusSigns = Array.from(document.getElementsByClassName('minus'));
const cartIcon = document.getElementById('cart-icon');
const shoppingCart = document.querySelector('.shopping-cart');

let cartItems = sessionStorage.getItem('cartItems');
if (cartItems === null) {
  cartItems = [];
}

let docHeight = Math.max(
  document.body.scrollHeight, document.documentElement.scrollHeight,
  document.body.offsetHeight, document.documentElement.offsetHeight,
  document.body.clientHeight, document.documentElement.clientHeight
);


shoppingCart.style.height = `${docHeight - 70}px`;
let cartOpen = false;

function toggleCart() {
  cartOpen = cartOpen == false ? true : false;

  if (cartOpen) {
    shoppingCart.style.display = 'block';
  }
  else {
    shoppingCart.style.display = 'none';
  }
}

function createNewEntry(foodName, foodPrice) {
  cartItems.push({
    name: foodName,
    qty: 1,
    totalPrice: qty * foodPrice
  });
  
  const newEntry = document.createElement('div');
  newEntry.className = 'd-flex'

  
}

function updateExisting() {

}

function modifyAmountValue(event, val, target) {
  const amountInput = val == 1? target.nextElementSibling : target.previousElementSibling;
  const prevVal = amountInput.value;
  let newVal = val + parseInt(prevVal);

  if (newVal > 10) {
    newVal = 10;
  }

  else if (newVal < 0) {
    newVal = 0;
  }

  amountInput.value = newVal;
  console.log(amountInput);

}

function extractPrice() {

}

function checkForDuplicateInCart(name) {
  cartItems.forEach(item => {
    if (item.foodName == name) {
      return true;
    }
  })

  return false;
}

function updateCartDisplay() {

}

function handleValueChange(target) {
  const menuParent = target.parentElement.parentElement;
  const foodName = menuParent.querySelector('.food-name');

  if (checkForDuplicateInCart(foodName)) {
    updateExisting(foodName);  
  }

  else {
    createNewEntry(foodName);
  }

  updateCartDisplay();

  console.log(foodName);
  
}

function sendRequestToCheckOutPage() {

}

plusSigns.forEach(p=> { 
  p.addEventListener('click', (event)=> {
    const target = event.target;
    modifyAmountValue(event, 1 ,target);

    handleValueChange(target);
  })
})

minusSigns.forEach(m=> {
  m.addEventListener('click', ()=> {
    const target = event.target;
    modifyAmountValue(event, -1 ,target);

    handleValueChange(target);
  })
})

cartIcon.addEventListener('click', toggleCart);
window.addEventListener('resize', function() {
  var documentHeight = Math.max(
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight,
    document.body.clientHeight, document.documentElement.clientHeight
  );

  console.log("Document height: " + documentHeight + " pixels");
  shoppingCart.style.height = `${documentHeight - 70}px `
});
console.log(orderAmounts);