<?php
  function unset_cookies() {
    setcookie('loggedIn', true, time() - 3600);
    setcookie('userStatus', 'test', time()-3600);
    setcookie('userEmail', ''. time()-3060);
  }


  unset_cookies();
  header('Location:login.php');



?>