<!DOCTYPE html>
<html>
<head>
    <title>Data Menu</title>
</head>
<body>
    <h1>Data Menu</h1>
    <a href ="tambahMenu.php">Tambahkan Menu</a>

<?php
    $con = mysqli_connect("localhost", "root", "", "restaurant");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $q = "SELECT * FROM menu";
    $query = mysqli_query($con, $q);

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nama</th>";
    echo "<th>Kategori</th>";
    echo "<th>Deskripsi</th>";
    echo "<th>Harga(Rp)</th>";
    echo "<th>Gambar</th>";
    echo "<th>Edit</th>";
    echo "<th>Delete</th>";
    echo "</tr>";

    while ($hasil = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td width='100'>" . $hasil['food_id'] . "</td>";
        echo "<td width='100'>" . $hasil['food_name'] . "</td>";
        echo "<td width='100'>" . $hasil['food_category'] . "</td>";
        echo "<td>" . $hasil['food_desc'] . "</td>";
        echo "<td>" . $hasil['food_price'] . "</td>";
        echo "<td><img src='". $hasil['food_imgpath']. "' alt='" . $hasil['food_imgpath'] . "' width='100'></td>";
        echo "<td  width='100'><a href='editMenu.php?edit=" . $hasil['food_id'] . "'><input type='submit' value='Edit'> </a></td>";
        echo "<td  width='100'><a href='admin.php?delete=" . $hasil['food_id'] . "'><input type='submit' value='X'> </a></td>";
        echo "</tr>";
    }

    if(isset($_GET['delete'])){
        $deleteFood = $_GET['delete'];
        $q3 = "DELETE FROM menu WHERE food_id='$deleteFood'";
        $query3 = mysqli_query($con, $q3);
    }

    mysqli_close($con);
?>

</body>
</html>