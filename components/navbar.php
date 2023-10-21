<header class="navbar navbar-expand-lg p-3">
    <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo"></a>
    <div id='navbar-container' class="container">
        <nav class="d-flex flex-row navbar-nav mr-3 ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Outlets</a>
                </li>
                
            </ul>
        </nav>


        <div class='d-flex align-items-center'>
            <?php
                $output='';
                if (isset($_COOKIE['loggedIn'])) {
                    
                    $output =  
                    ' 
                    <div class = "nav-profile">
                        <div class="profile-icon">
                            
                        </div>
                        <a class="navbar-icon" href="logout.php"> 
                        Logout
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    
                    </div>'
                ;
                }

                else {
                    $output =  
                    '<a class="navbar-icon" href="login.php"> 
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>';
                }
                echo $output;
            
            ?>
    
        </div>
        
    </div>
    
    <div class='d-flex align-items-center'>
        <div class='hamburger-menu'>
            <i class='fas fa-bars'></i>
        </div>
        <img id='cart-icon' class= 'utility-icon mx-2' src='icons/shopping-cart.png'></img>
    </div>
    
    <?php
        include('components/shopping_cart.php');
    ?>

</header>