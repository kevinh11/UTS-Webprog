<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penambahan Menu</title>
</head>
<body>
    <h1>Penambahan Menu</h1>
        <form method="POST" enctype="multipart/form-data">
            ID makanan:
            <input type="text" name="food_id">
            <br />
            Nama makanan:
            <input type="text" name="food_name">
            <br />
            Kategori makanan:
            <input type="text" name="food_category">
            <br />
            Deskripsi makanan: 
            <input type="text" name="food_desc">
            <br />
            Harga makanan:
            <input type="text" name="food_price">
            <br />
            Gambar makanan:
            <input type="file" name="food_imgpath">
            <br />
            <input type="submit" name="submit" value="Submit">
        </form>

    <?php
        $con = mysqli_connect("localhost", "root", "", "restaurant");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if(isset($_POST['food_id'])){
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
            } else {
                echo "Error inserting data: " . mysqli_error($con);
            }
        }
       
        mysqli_close($con);
    ?>
</body>
</html>



