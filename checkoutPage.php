

<?php
  session_start();

  include('components/header.php');

?>
<body>
  <?php
    include('components/navbar.php');
  ?>

  <div class='p-2 checkout-area d-flex flex-column align-items-center justify-content-start'>
  <!-- <a href="success.php" class="btn btn-danger">Click to Pay</a> -->
    <h1>Checkout</h1>

    <div class='checkout-box shadow rounded d-flex flex-column'>
      <?php
        $purchase = $_SESSION['data'];
        $tax = 0.1;

        $items = $purchase['items'];
        $pricing = $purchase['subtotal'];

        for ($i = 0; $i < count($items); $i++) {
          
          $name = $items[$i]['name'];
          $imgPath = $items[$i]['imgPath'];
          $qty = $items[$i]['qty'];
          $price = $items[$i]['originalPrice'];
          $str = "
            <div class='checkout-item p-2 d-flex flex-row  justify-content-start align-items-center container-fluid w-100'>
              <img class='cart-food-icon' src=$imgPath></img>
              <div class= 'd-flex flex-column'>
                <h5> $name</h5>

                <h6>Rp.$price</h6>
                <p>x $qty</p>
              </div>
            </div>
          
          ";

          echo $str;
        }

      ?>
    </div>
    <div class='mt-2 checkout-price-detail shadow rounded d-flex flex-column p-2'>
      <?php
        $subtotal = $pricing;
        $final = $pricing + ($tax * $pricing);
        echo "<h6>Subtotal : $pricing </h6>";
        echo "<h6>Pajak: 10% </h6> ";
        echo "<h5>Total: $final</h5>";

      ?>
    </div>
    <a href="success.php" class="btn btn-danger">Click to Pay</a>
  
  </div>


  <?php
    include('components/footer.php');
  ?>


</body>
<script src='jsFiles/navbar.js'></script>
<script src='jsFiles/shoppingCart.js'></script>

