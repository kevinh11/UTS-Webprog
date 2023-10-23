
<?php
    include('components/header.php');
    include('components/admin_redirect.php');
?>


<body id='edit-body' class='d-flex flex-column align-items-center'>
    <?php
        include('components/navbar.php');
    ?>

    <h1>Edit Menu</h1>

    <?php
        $con = mysqli_connect("localhost", "root", "", "restaurant");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['edit'])) {
            $q2 = "SELECT * FROM menu WHERE food_id='" . $_GET['edit'] . "'";
            $query2 = mysqli_query($con, $q2);

            if (mysqli_num_rows($query2) > 0) {
                $data_lama = mysqli_fetch_assoc($query2);
            } else {
                echo "Data not found.";
            }
        }
    ?>
    <form id='mt-3 mb-3 edit-menu-form' method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="food_id" class="form-label">Food ID:</label>
            <input type="text" name="food_id" id="food_id" class="form-control" value="<?php echo $data_lama['food_id']; ?>">
        </div>

        <div class="mb-3">
            <label for="food_name" class="form-label">Food Name:</label>
            <input type="text" name="food_name" id="food_name" class="form-control" value="<?php echo $data_lama['food_name']; ?>">
        </div>

        <div class="mb-3">
            <label for="food_category" class="form-label">Food Category:</label>
            <input type="text" name="food_category" id="food_category" class="form-control" value="<?php echo $data_lama['food_category']; ?>">
        </div>

        <div class="mb-3">
            <label for="food_desc" class="form-label">Food Description:</label>
            <textarea name="food_desc" id="food_desc" class="form-control"><?php echo $data_lama['food_desc']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="food_price" class="form-label">Food Price (Rp):</label>
            <input type="text" name="food_price" id="food_price" class="form-control" value="<?php echo $data_lama['food_price']; ?>">
        </div>

        <div class="mb-3">
            <label for="current_image" class="form-label">Current Image:</label>
            <img src="<?php echo $data_lama['food_imgpath']; ?>" alt="<?php echo $data_lama['food_imgpath']; ?>" width="100">
        </div>

        <div class="mb-3">
            <label for="food_imgpath" class="form-label">Choose New Image:</label>
            <input type="file" name="food_imgpath" id="food_imgpath" class="form-control">
        </div>

        <input type="submit" name="submit" value="Update" class="btn btn-primary">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['food_id'];
        $name = $_POST['food_name'];
        $category = $_POST['food_category'];
        $desc = $_POST['food_desc'];
        $price = $_POST['food_price'];
        $newImage = $_FILES['food_imgpath']['name'];
        $oldImage = $data_lama['food_imgpath'];

        if ($_FILES['food_imgpath']['error'] == 0) {
            $newImage = 'gambarMenu/' . $_FILES['food_imgpath']['name'];
        } else {
            $newImage = $oldImage;
        }

        $sql = "UPDATE menu SET food_id = '$id', food_name ='$name', food_category ='$category', 
                    food_desc = '$desc', food_price = '$price', food_imgpath='$newImage' WHERE food_id='" . $data_lama['food_id'] . "'";

        if (mysqli_query($con, $sql)) {
            header("Location: Admin.php");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
    ?>
    <script src="./node_modules/axios/dist/axios.min.js"></script>
</body>


<?php
    include('components/footer.php');
?>

</html>
