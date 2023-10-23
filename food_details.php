<?php
include('components/header.php');
?>

<body>
    <?php
    include('components/navbar.php');
    ?>

    <div class="justify-content-center d-flex flex-row align-items-center">
        <div class="detail-items mt-2">

        </div>
    </div>
    <?php
    $foodId = $_GET['id'];
    $conn = mysqli_connect('localhost', 'root', '', 'restaurant');
    $sql = "SELECT food_name, food_price, food_category, food_desc, food_imgpath FROM menu WHERE food_id = '$foodId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $detail = "<div class='detail-items mx-2 d-flex align-items-center'>
                <img class='detail-img ms-4 mt-2' src='$row[food_imgpath]'></img>
                
                <div class='d-flex flex-column justify-content-around ms-2'>
                        <h4 class='food-name'>Nama: $row[food_name] </h4>
                        <h4 class='food-price'>Harga: Rp. $row[food_price] </h4>
                        <h4 class='food-category'>Kategori: $row[food_category] </h4>
                        <p class='food-desc'> $row[food_desc] </p>
                </div>
            </div>";
        }
        echo $detail;
    } else {
        echo 'No data found for this food item.';
    }
    ?>
    <div class="p-3 mt-3 bg-danger d-flex flex-column text-center align-items-center">
        <h3>Rekomendasi Lainnya</h3>
        <div class="recommended-items mt-4 align-items-center flex-row">
            <?php
            $recommendedMenu = 'SELECT * FROM menu ORDER BY RAND() LIMIT 3';
            $res = mysqli_query($conn, $recommendedMenu);
            $card = '';
            while ($row2 = $res->fetch_array()) {
                $card =
                    "<div class='menu-card' data-food-id=$row2[food_id] data-food-price=$row2[food_price] data-food-description='$row2[food_desc]'>
            <img class='menu-card-img' src= $row2[food_imgpath]>
            <div class='food-info'>
            <p class='description'></p>
            </div>

            <div class='menu-card-bottom d-flex flex-row justify-content-around' > 
            <div class='menu-card-info d-flex p-3 flex-row justify-content-center'>
                <h5 class='food-name'> $row2[food_name]</h5>
                
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
    <script>
        const menuCards = document.querySelectorAll('.menu-card');

        menuCards.forEach(card => {
            const image = card.querySelector('.menu-card-img');
            const desc = card.querySelector('.food-info');

            card.addEventListener('mouseover', () => {
                image.style.filter = 'brightness(50%)';
                desc.style.opacity = 1;

                const description = card.getAttribute('data-food-description');
                const price = card.getAttribute('data-food-price');
                desc.querySelector('.description').innerHTML = 'Harga: Rp.' + price + '<br>' + description;
            });

            card.addEventListener('mouseout', () => {
                image.style.filter = 'brightness(100%)';
                desc.style.opacity = 0;
            });

            card.addEventListener('click', function() {
                const foodId = card.getAttribute('data-food-id');
                window.location.href = 'food_details.php?id=' + foodId;
            });
        });
    </script>

    <script src='jsFiles/shoppingCart.js'></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>
</body>