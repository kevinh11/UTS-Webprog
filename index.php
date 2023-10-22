
<?php
  include('components/header.php');
?>
<body>
  <?php
    include('components/navbar.php')
  ?>
  <div class="hero d-flex flex-column flex-lg-row justify-content-around align-items-center p-4">
    <div class="hero-text">
      <h2>Get the best food <br> Tangerang has to offer!</h2>
      <button class="mt-4 btn btn-danger">
        <a href='menu.php'>Order Now!</a>
      </button>
    </div>

    <img id='hero-img' src='gambarMenu/esJeruk.jpg'>
    </img>
  </div>

  <div class="mx-auto">
    <section class="container mt-5">
      <h1 class="mb-2 text-center text-danger">Bestselling Menu</h1>
      <div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="gambarMenu/esJeruk.jpg" alt="Image 1" class="img-thumbnail">
        </div>
        <div class="col-md-4">
            <img src="gambarMenu/bakmiAyam.jpg" alt="Image 2" class="img-thumbnail">
        </div>
        <div class="col-md-4">
            <img src="gambarMenu/sateKambing.jpg" alt="Image 3" class="img-thumbnail">
        </div>
    </div>
</div>
  </div>


  <?php
    include('components/footer.php');
  ?>

  <script src='jsFiles/user.js'></script>
  <script src='jsFiles/navbar.js'></script>
  <script src='jsFiles/shoppingCart.js'></script>
</body>

