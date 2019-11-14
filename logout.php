<?php
  session_start();
    if (isset($_SESSION['logout'])) {
      if($_SESSION['logout']==true){
        session_destroy();
        header("location:login.php");
      }
    }

 ?>
