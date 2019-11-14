<?php require_once 'dbconnection.php';
      include_once 'header.php';
?>
<?php
  /* Updating records */
      $sql = "SELECT * FROM users WHERE user_id='". @$_GET['id']."';";
      $result = $conn->query($sql);
      $entry=$result->fetch_assoc();
      if (isset($_POST['update_user'])) {
        if(!empty($_POST['username']) && !empty($_POST['uemail']) && !empty($_POST['password']) &&!empty($_POST['privilege']) && !empty($_POST['udatereg'])){
            $username=test_data(lcfirst($_POST["username"]));
            $email=test_data($_POST["uemail"]);
            $password=md5(test_data($_POST["password"]));
            $privilege=test_data($_POST["privilege"]);
            $date_registered=test_data($_POST["udatereg"]);
          $sql=" UPDATE users
           SET username= '".$username."',
                email= '".$email."',
                password='".$password."',
                privilege='".$privilege."',
                date_registered='".$date_registered."' WHERE user_id='".$_GET['id']."';";
                if($conn->query($sql)==TRUE){
                  $usermsg="Record Updated successfully";
                  header("location:home.php");
                }else{
                  echo $conn->error;
                  die("An error occured while updating record "); }
        }else{ $usermsg="Please Fill In All The Fields"; }
      }
 ?>

 <?php
 /* Deleting Records */
       $sql = "SELECT * FROM users WHERE user_id='". @$_GET['id']."';";
       $result = $conn->query($sql);
       $entry=$result->fetch_assoc();
       if (isset($_POST['delete_user'])) {
         if(!empty($_POST['username']) && !empty($_POST['uemail']) && !empty($_POST['password'])
          && !empty($_POST['privilege']) && !empty($_POST['udatereg'])){
            if ($_SESSION['user'] !=  $_POST['username']){
              $sql=" DELETE FROM users WHERE user_id='".$_GET['id']."';";
                    if($conn->query($sql)==TRUE){
                      $usermsg="Record Deleted successfully";
                      header("location:home.php");
                    }else{ die("An error occured while deleting record "); }
            }else{ echo $usermsg="Error! Attempting to delete Yourself!!!";}

         }else{ $usermsg="Please Fill In All The Fields"; }
 }

  ?>

<body>
      <form class="create" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <center><span class="error"><?php echo $usermsg; ?></span></center>
        <fieldset>
          <input type="text" name="username" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
            value="<?php echo $entry['username'] ?>" <?php }; ?> placeholder="Username">
        </fieldset>
        <fieldset>
          <input type="text" name="uemail" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['email'] ?>" <?php }; ?> placeholder="Email">
        </fieldset>
        <fieldset>
          <input type="password" name="password"<?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
           value="<?php echo $entry['password'] ?>" <?php }; ?> placeholder="Password">
        </fieldset>
        <fieldset>
          <select class="select" name="privilege" placeholder="privilege"<?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
           value="<?php echo $entry['privilege'] ?>"<?php }; ?>>
            <option value="user">user</option>
            <option value="admin">admin</option>
            <option value="superadmin">super admin</option>
          </select>
        </fieldset>
        <fieldset>
          <input type="date" name="udatereg" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['date_registered'] ?>" <?php }; ?> placeholder="Date of Registration">
        </fieldset>
        <?php if (@$_GET['Update']==true): ?>
          <fieldset>
            <button type="submit" name="update_user">Update User</button>
          </fieldset>

        <?php elseif (@$_GET['Delete']==TRUE): ?>
          <fieldset>
            <button type="submit" name="delete_user" class="deleteBtn">Delete User</button>
          </fieldset>

        <?php else: ?>

        <fieldset>
          <button type="submit" name="create_user">Create User</button>
        </fieldset>
        <?php endif; ?>
      </form>
