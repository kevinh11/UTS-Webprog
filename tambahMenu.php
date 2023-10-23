<?php
    include('components/header.php');
   
?>

<body>
    <?php
        include('components/navbar.php');
    ?>

    <div class="tambah-menu-page container mt-5">
        <h1 class="mb-4">Penambahan Menu</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="food_id" class="form-label">ID makanan:</label>
                <input type="text" name="food_id" id="food_id" class="form-control">
            </div>

            <div class="mb-3">
                <label for="food_name" class="form-label">Nama makanan:</label>
                <input type="text" name="food_name" id="food_name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="food_category" class="form-label">Kategori makanan:</label>
                <input type="text" name="food_category" id="food_category" class="form-control">
            </div>

            <div class="mb-3">
                <label for="food_desc" class="form-label">Deskripsi makanan:</label>
                <input type="text" name="food_desc" id="food_desc" class="form-control">
            </div>

            <div class="mb-3">
                <label for="food_price" class="form-label">Harga makanan:</label>
                <input type="text" name="food_price" id="food_price" class="form-control">
            </div>

            <div class="mb-3">
                <label for="food_imgpath" class="form-label">Gambar makanan:</label>
                <input type="file" name="food_imgpath" id="food_imgpath" class="form-control">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
            $con = mysqli_connect("localhost", "root", "", "restaurant");

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }


            if(isset($_COOKIE['loggedIn']) && $_COOKIE['userStatus'] == 'admin') {
                if (isset($_POST['food_id'])) {
                    $id = $_POST['food_id'];
                    $name = $_POST['food_name'];
                    $category = $_POST['food_category'];
                    $desc = $_POST['food_desc'];
                    $price = $_POST['food_price'];
                    $img = 'gambarMenu/' . $_FILES['food_imgpath']['name'];
                    $q = "INSERT INTO menu 
                            VALUES ('$id', '$name', '$desc', '$category', $price, '$img')";
    
                    $query = mysqli_query($con, $q);
                    
                    if ($query) {
                        header("Location: admin.php");
                        exit();
                    } 
                    else {
                        echo "Error inserting data: " . mysqli_error($con);
                    }
    
                }
            }

            else {
                echo '<p class="text-danger"> NO PERMISSION TO EDIT. <br> LOG IN IF YOU ARE AN ADMIN</p>';
            }
            
       

            mysqli_close($con);
        ?>
    </div>

    <?php
        include('components/footer.php');
    ?>

    <script src='jsFiles/shoppingCart.js'></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>
</body>
</html>
