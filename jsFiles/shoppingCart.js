
const orderAmounts = document.getElementsByClassName('amount');
const plusSigns = Array.from(document.getElementsByClassName('plus'));
const minusSigns = Array.from(document.getElementsByClassName('minus'));
const cartIcon = document.getElementById('cart-icon');
const shoppingCart = document.querySelector('.shopping-cart');
const orderArea = document.querySelector('.orders-area');

//pakai JS biar user tidak harus refresh setiap kali data di input
let cartItems = sessionStorage.getItem('cartItems');
if (cartItems === null) {
  cartItems = [];
}

else {
  cartItems = JSON.parse(cartItems);
}

displayCartItems(cartItems);
calculateTotal(cartItems);

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


function createNewEntry(cart, foodName, foodPrice, foodImage) {

  console.log(typeof(foodPrice));
  cart.push({
    name: foodName,
    qty: 1,
    imgPath: foodImage,
    originalPrice: foodPrice,
    totalPrice: foodPrice * this.qty
  });

  sessionStorage.setItem('cartItems', JSON.stringify(cart)); 
}

// sessionStorage.setItem('cartItems', JSON.stringify([]));
function displayCartItems(cart) {
  orderArea.innerHTML = "";

  const filteredCart = cart.filter(item => item.qty > 0);
  filteredCart.forEach(item => {
    const newEntry = document.createElement('div');
    newEntry.className = 'order-details p-3 d-flex flex-column';
    newEntry.innerHTML = `<h5>${item['name']}</h5> <p>${item['originalPrice']}</p>  <div class='amount d-flex flex-row align-items-center'>
    <i class='plus fa fa-plus' aria-hidden='true'></i>
    <input class='amount-input' disabled type='number' min=0 max=10 value=0></input>
    <i class='minus fa fa-minus' aria-hidden='true'></i>
  </div>`;
    orderArea.appendChild(newEntry);
  });
}

function updateExisting(cart, foodName, foodPrice, newVal) {
  for (const item of cart) {
    if (item['name'] === foodName) {
      item['qty'] = newVal;
      item['totalPrice'] = foodPrice * newVal;
    }
  }
  sessionStorage.setItem('cartItems', JSON.stringify(cart));
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
  return newVal;

}

function extractPrice(str) {
  let price = parseInt(str.split('.')[1]);
  return price;
}

function checkForDuplicateInCart(cart, name) {
  for (const item of cart) {
    if (item['name'] === name) {
      return true; 
    }
  }
  return false;
}

function handleValueChange(target, updated) {
  const menuParent = target.parentElement.parentElement;
  const foodName = menuParent.querySelector('.food-name').textContent;
  const foodPriceStr = menuParent.querySelector('.food-price').textContent;
  const foodImage = menuParent.parentElement.querySelector('.menu-card-img').src;

  const subtotal = 0;

  let cartItems = JSON.parse(sessionStorage.getItem('cartItems'));
  if (cartItems == null) {
    cartItems = [];
  }

  let foodPrice = extractPrice(foodPriceStr);
  let existing = checkForDuplicateInCart(cartItems, foodName);

  console.log(existing);
  if (existing) {
    updateExisting(cartItems, foodName, foodPrice, updated);  
  }

  else {
    createNewEntry(cartItems,foodName, foodPrice, foodImage);
  }

  displayCartItems(cartItems);
  calculateTotal(cartItems);
  
}

function setMenuAmountValues(cart,amountIndicator) {
  console.log(amountIndicator.parentElement);
  const menuName = amountIndicator.parentElement.querySelector('.food-name').textContent;
  for (item of cart) {
    if (item['name'] === menuName) {
      console.log(menuName);
      amountIndicator.querySelector('.amount-input').value = item['qty'];
    }
  }
}

function calculateTotal(cart) {
  let total = 0;
  const subtotalCounter = document.getElementById('subtotal-value');
  for (const item of cart) {
    total += parseInt(item['originalPrice']) * item['qty'];
  }
  subtotalCounter.textContent = total;

}


function sendRequestToCheckOutPage() {
  const cartItems = sessionStorage.getItem('cartItems');
  const url = 'http://localhost:3000/uts-lecture/UTS-Webprog/checkout.php';
  
  console.log(cartItems);
  console.log(parseInt(document.getElementById('subtotal-value').textContent));
    axios.post(url, {
    items: JSON.parse(cartItems),
    subtotal: parseInt(document.getElementById('subtotal-value').textContent)
  }, 
  
  {
    method: 'POST', 
    headers: {
      'Content-Type': 'application/json',
    },
  })
  .then((res) => {
    console.log('sending data to server...');
    console.log(res.data);
  })
  .catch((error) => {
    console.error(error);
  });
}

plusSigns.forEach(p=> { 
  p.addEventListener('click', (event)=> {
    const target = event.target;
    const updated = modifyAmountValue(event, 1 ,target);
    handleValueChange(target,updated);
  })
})

minusSigns.forEach(m=> {
  m.addEventListener('click', ()=> {
    const target = event.target;
    const updated = modifyAmountValue(event, -1 ,target);
    handleValueChange(target, updated);
  })
});

Array.from(orderAmounts).forEach(o=> {
  setMenuAmountValues(cartItems, o);
});

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

const cartSubmit = document.getElementById('submit-cart');

cartSubmit.addEventListener('click', sendRequestToCheckOutPage);


