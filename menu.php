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
      $showMenu = 'SELECT * FROM MENU ORDER BY food_category';
      $res = mysqli_query($conn, $showMenu);
      $card = '';
      while ($row = $res->fetch_array()) {
        if (isset($_COOKIE['loggedIn'])) {
          $card =
            "<div class='menu-card' data-food-id=$row[food_id] data-food-description='$row[food_desc]' data-food-category='$row[food_category]'>
              <div class='food-info'>
                <p class='description'></p>
              </div>  
              <img class='menu-card-img' src= $row[food_imgpath]>
  
              <div class='menu-card-bottom d-flex flex-row justify-content-around' > 
                <div class='menu-card-info d-flex p-3 flex-column justify-content-center'>
                  <h5 class='food-name'> $row[food_name]</h5>
                  <p class='food-price'>Rp. $row[food_price]</p>
                </div>
  
                <div class='amount d-flex flex-row align-items-center'>
                  <i class='plus fa fa-plus' aria-hidden='true'></i>
                  <input class='amount-input' disabled type='number' min=0 max=10 value=0></input>
                  <i class='minus fa fa-minus' aria-hidden='true'></i>
                </div>
              </div>
  
            </div>";
        } else {
          $card =
            "<div class='menu-card' data-food-id=$row[food_id] data-food-description='$row[food_desc]' data-food-category='$row[food_category]'>
              <div class='food-info'>
                <p class='description'></p>
              </div>  
              <img class='menu-card-img' src= $row[food_imgpath]></img>
  
              <div class='menu-card-bottom d-flex flex-row justify-content-around'> 
                <div class='menu-card-info d-flex p-3 flex-column justify-content-center '>
                  <h5 class='food-name'> $row[food_name]</h5>
                  <p class='food-price'>Rp. $row[food_price]</p>
                  <p>Please log in to order</p>
                </div>
              </div>
  
            </div>";
        }

        echo $card;
      }

      ?>
    </div>
  </div>
  <?php
  include('components/footer.php');
  ?>
  <script src='jsFiles/navbar.js'></script>
  <script src="./node_modules/axios/dist/axios.min.js"></script>
  <script>
    const menuCards = document.querySelectorAll('.menu-card');

    menuCards.forEach(card => {
      const image = card.querySelector('.menu-card-img');
      const desc = card.querySelector('.food-info');

      card.addEventListener('mouseover', () => {
        image.style.filter = 'brightness(50%)';
        desc.style.opacity = 1;

        const description = card.getAttribute('data-food-description');
        const category = card.getAttribute('data-food-category');
        desc.querySelector('.description').innerHTML = 'Kategori: ' + category + '<br>' + description;

        console.log(category);
      });

      card.addEventListener('mouseout', () => {
        image.style.filter = 'brightness(100%)';
        desc.style.opacity = 0;
      });

      card.addEventListener('click', function() {
        if (event.target.classList.contains('amount-input') || event.target.classList.contains('plus') || event.target.classList.contains('minus')) {
            // Click occurred in the amount area, do nothing
            return;
        }
        const foodId = card.getAttribute('data-food-id');
        window.location.href = 'food_details.php?id=' + foodId;
      });
    });
  </script>
  <script src='jsFiles/shoppingCart.js'></script>
</body>