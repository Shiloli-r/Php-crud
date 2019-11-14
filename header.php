<?php session_start() ?>
<?php include_once 'functions.php';
  require_once 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Customer Management System">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="tbt,That Better Team">
    <meta name="keywords" content="Customer Management System, CRUD system, order sytem">
    <title>Customer Management System</title>
    <link rel="stylesheet" href="./css/tbt.css">

  </head>
    <header>
      <div class="container">
        <div class="logo">
          <h1>That <span>Better</span> Team</h1>
        </div>
        <div class="menu">
          <nav class="navbar">
          <ul>
            <?php if (isset($_SESSION['user'])): ?>
              <li><a href="home.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="logout.php">Log Out <span class="user"><?php echo @$_SESSION['user']; $_SESSION['logout']=true; ?></span></a></li>
            <?php else: ?>
            <li><a href="about.php">About</a></li>
            <li><a href="login.php">Log In</a></li>
          <?php endif; ?>
          </ul>
            </nav>
        </div>
    </header>
