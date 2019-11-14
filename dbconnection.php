<?php

  $server="localhost";
  $user="root";
  $password="";
  $db="tbt";

  $conn = new mysqli($server, $user, $password, $db);
  if ($conn) {
    echo "";
  }else{
      echo $conn->connect_error,"<br>";
      die("Connection to database failed") ;

  }

 ?>
