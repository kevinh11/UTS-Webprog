<div class="shopping-cart">
  <div class='d-flex h-100 flex-column justify-content-between'>
    <div class='orders-area d-flex flex-column'>
      <div class="order d-flex flex-row align-items-center">
        <img class='cart-food-icon'src='icons/facebook.png'></img>
        <div class="order-details d-flex flex-column">
          <h5>Menu Name</h5>
          <p>Price</p>

          <div class='amount d-flex flex-row align-items-center'>
            <i class='plus fa fa-plus' aria-hidden='true'></i>
            <input disabled type='number' min=0 max=10 value=0></input>
            <i class='minus fa fa-minus' aria-hidden='true'></i>
          </div>
        </div>
      </div>
    </div>
    <div class="order-bottom p-3 d-flex flex-row justify-content-around">
      <div class="order-bottom-details">
        <h5> Subtotal: </h5>
        <p id='subtotal-value'>0</p>
      </div>

      <!-- kadang2 perlu di click 2 kali -->
      <a href='checkOutPage.php'>
        <button id='submit-cart' class='btn btn-danger'>
          Check out
        </button>
      </a>
      
    
    </div>
      
   
  </div>
  
</div>

