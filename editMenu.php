<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
</head>
<body>
    <h1>Edit Menu</h1>

    <?php
        $con = mysqli_connect("localhost", "root", "", "restaurant");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['edit'])) {
            $q2 = "SELECT * FROM menu WHERE food_id='". $_GET['edit'] ."'";
            $query2 = mysqli_query($con, $q2);

            if (mysqli_num_rows($query2) > 0) {
                $data_lama = mysqli_fetch_assoc($query2);
            } else {
                echo "Data not found.";
            }
        }
    ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="food_id" value="<?php echo $data_lama['food_id']; ?>">
            <br />
            <input type="text" name="food_name" value="<?php echo $data_lama['food_name']; ?>">
            <br />
            <input type="text" name="food_category" value="<?php echo $data_lama['food_category']; ?>">
            <br />
            <textarea name="food_desc"><?php echo $data_lama['food_desc']; ?></textarea>
            <br />
            <input type="text" name="food_price" value="<?php echo $data_lama['food_price']; ?>">
            <br />
            <img src="<?php echo $data_lama['food_imgpath']; ?>" alt="<?php echo $data_lama['food_imgpath']; ?>" width="100">
            <br />
            <input type="file" name="food_imgpath">
            <br />
            <input type="submit" name="submit" value="Update">
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
</body>
</html>



