<?php
  include('components/header.php');
?>

<body>
  <?php
    include('components/navbar.php');
  ?>

  <div class="menu-area d-flex flex-column align-items-center justify-content-center">
    <h1 class='mt-3'>Menu</h1>

    <div class='menu-items mt-4'>
      
      <?php
        $conn = mysqli_connect('localhost', 'root', '', 'restaurant'); 
        $showMenu = 'SELECT * FROM MENU';
        $res = mysqli_query($conn, $showMenu);
        $row = mysqli_fetch_assoc($res);
        while( $row = $res->fetch_array())
        {
          $card = 
          "<div class='menu-card'>
            <img class='menu-card-img' src= $row[food_imgpath]>
            </img>

            <div class='menu-card-bottom d-flex flex-row justify-content-around'> 
              <div class='menu-card-info d-flex p-3 flex-column justify-content-center '>
                <h5 class='food-name'> $row[food_name]</h5>
                <p class='food-price'>Rp. $row[food_price]</p>
              </div>

              <div class='amount d-flex flex-row align-items-center'>
                <i class='plus fa fa-plus' aria-hidden='true'></i>
                <input disabled type='number' min=0 max=10 value=0></input>
                <i class='minus fa fa-minus' aria-hidden='true'></i>
              </div>
            </div>

          </div>";
          echo $card;
        }
    
      ?>
    </div>
  </div>
  <?php
    include('components/footer.php');
  ?>
  <script src='jsFiles/navbar.js'></script>
  <script src='jsFiles/shoppingCart.js'></script>
</body>