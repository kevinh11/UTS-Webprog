<?php

  session_start();

  //buat jadi perantara data js->php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");
  header("Access-Control-Allow-Credentials: true");
  header("Content-Type: application/json");
 
  $input = json_decode(file_get_contents("php://input"), true);

  $_SESSION['data'] = $input;


  


?>