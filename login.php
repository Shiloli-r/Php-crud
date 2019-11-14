<?php include_once 'header.php';
      require_once 'dbconnection.php';
      include_once 'functions.php';
?>

<body style="background-color:#ccffb3">
  <div class="login">
    <form class="" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <h2>Log In<hr> </h2>
        <span class="error"><?php echo $message; ?></span>
      <fieldset>
        <label for="username" id="label"></label>
        <input type="text" name="username"  placeholder="username"><span class="error" value="">*<?php echo $username_error; ?></span>
      </fieldset>
      <fieldset>
        <label for="password"></label>
        <input type="password" name="password"  placeholder="password"  value=""><span class ="error">*<?php echo $password_error; ?></span>
      </fieldset>
      <fieldset>
        <button type="submit" name="submit">Log In</button>
      </fieldset>
      <a href="#">Forgot password?</a>
  </div>



  </form>






<?php include_once 'footer.php'; ?>
