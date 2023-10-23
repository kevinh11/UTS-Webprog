<?php
  if(!isset($_COOKIE['loggedIn']) || $_COOKIE['userStatus'] == 'user') {
    header("Location: login.php");
  }

?>