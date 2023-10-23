<?php
    include('components/header.php');
    include('components/navbar.php');

    include('components/admin_redirect.php');
?>

<div class='mt-3 container-fluid d-flex flex-column justify-content-center align-items-center'>
<h1>Admin Dashboard</h1>
    <a class='mt-3' href="tambahMenu.php"> 
        <button class='btn btn-danger''>Tambahkan Menu</button>
    </a>
</div>


<?php
    $con = mysqli_connect("localhost", "root", "", "restaurant");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $q = "SELECT * FROM menu";
    $query = mysqli_query($con, $q);
?>

<div class='mt-4 d-flex flex-row justify-content-center align-items-center'>

    <div class='table-responsive'>
        <table class="mt-3 table table-striped" id="admin-table" border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Harga(Rp)</th>
                <th>Gambar</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
                while ($hasil = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td width='100'>" . $hasil['food_id'] . "</td>";
                    echo "<td width='100'>" . $hasil['food_name'] . "</td>";
                    echo "<td width='100'>" . $hasil['food_category'] . "</td>";
                    echo "<td>" . $hasil['food_desc'] . "</td>";
                    echo "<td>" . $hasil['food_price'] . "</td>";
                    echo "<td><img src='" . $hasil['food_imgpath'] . "' alt='" . $hasil['food_imgpath'] . "' width='100'></td>";
                    echo "<td width='100'><a href='editMenu.php?edit=" . $hasil['food_id'] . "'><input class='btn btn-danger' type='submit' value='Edit'> </a></td>";
                    echo "<td width='100'><a href='admin.php?delete=" .  $hasil['food_id'] . "'><input class='btn btn-danger' type='submit' value='X'> </a></td>";
                    echo "</tr>";
                }
            ?>

        </table>


    </div>

</div>


<?php
if (isset($_COOKIE['loggedIn']) && $_COOKIE['userStatus'] == 'admin'){
    if (isset($_GET['delete'])) {
        $deleteFood = $_GET['delete'];
        $q3 = "DELETE FROM menu WHERE food_id='$deleteFood'";
        $query3 = mysqli_query($con, $q3);
    }

    mysqli_close($con);
} else{
    echo '<p class="text-danger"> NO PERMISSION TO EDIT. <br> LOG IN IF YOU ARE AN ADMIN</p>';
}
?>

<footer class="mt-4 d-flex flex-column">
    <div class="footer-top d-flex flex-row justify-content-between p-4">
        <div class="footer-options d-flex flex-column jusitfy-content-start">
            <h6>Hubungi Kami</h6>
            <h6>Tentang Kami</h6>
            <h6>Newsroom</h6>
            <h6>Karir</h6>
        </div>

        <div class="footer-socials">
            <h5>Hubungi Kami</h5>
            <div class="socials-images d-flex">
                <img src="icons/facebook.png" alt="facebook-icon">
                <img src="icons/instagram.jpg" alt="instagram-icon">
                <img src="icons/twitter.jpg" alt="twitter-icon">
            </div>
        </div>
    </div>
    <div class="footer-bottom px-4 py-1 d-flex justify-content-between text-white">
        <h5>copyright @2023 Restoran - All Rights Reserved</h5>
    </div>
</footer>
<script src='jsFiles/shoppingCart.js'></script>
    <script src="./node_modules/axios/dist/axios.min.js"></script>
</body>
</html>
