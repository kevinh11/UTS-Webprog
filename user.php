
<?php
  include('components/header.php');
?>
<body>
  <?php
    include('components/navbar.php')
  ?>
  <div class="hero d-flex flex-column flex-lg-row justify-content-around align-items-center p-4">
    <div class="hero-text">
      <h1>Get the best food <br> Tangerang has to offer!</h1>
      <button class="mt-4 btn btn-danger">
        <a href='menu.php'>Order Now!</a>
      </button>
    </div>

    <img id='hero-img' src='gambarMenu/esJeruk.jpg'>
    </img>
  </div>

  <div class='promo-section'>
      

  </div>

  <?php
    include('components/footer.php');
  ?>

  <script src='jsFiles/user.js'></script>
  <script src='jsFiles/navbar.js'></script>
</body>

