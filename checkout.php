
<?php

 header("Access-Control-Allow-Origin: http://localhost:3000");
  header("Access-Control-Allow-Methods: GET, POST");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Access-Control-Allow-Credentials: true");

  $input = json_decode(file_get_contents("php://input"),true);
  print_r ($_POST);

  echo 'status 200';
?>