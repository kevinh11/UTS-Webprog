<?php
  include('components/header.php');
?>

<body>
  <?php
    include('components/navbar_user.php');
  ?>

  <div class="menu-area d-flex flex-column align-items-center justify-content-center">
    <h1>Menu</h1>

    <?php
      $conn = mysqli_connect('localhost', 'root', '', 'restaurant'); 
      $query = 'SELECT * FROM MENU';

      
    
    ?>
  </div>
  <?php
    include('components/footer.php');
  ?>
</body>