<?php require_once 'dbconnection.php';
      include_once 'header.php';  ?>
      <?php
/* Updating records */
    $sql = "SELECT * FROM customers WHERE customer_id='". @$_GET['id']."';";
    $result = $conn->query($sql);
    $entry=$result->fetch_assoc();
    if (isset($_POST['update_customer'])) {
      if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['datereg'])){
        $fname=test_data(ucfirst($_POST['fname']));
        $lname=test_data(ucfirst($_POST['lname']));
        $email=test_data($_POST['email']);
        $phone=test_data($_POST['phone']);
        $datereg=test_data($_POST['datereg']);
        $sql=" UPDATE customers
         SET fname= '".$fname."',
              lname= '".$lname."',
              email='".$email."',
              phone='".$phone."',
              date_registered='".$datereg."' WHERE customer_id='".$_GET['id']."';";
              if($conn->query($sql)==TRUE){
                $customermsg="Record Updated successfully";
                header("location:home.php");
              }else{
                echo $conn->error;
                die("<br>An error occured while updating record "); }
      }else{ $customermsg="Please Fill In All The Fields"; }
    }
?>

<?php
/* Deleting Records */
     $sql = "SELECT * FROM customers WHERE customer_id='". @$_GET['id']."';";
     $result = $conn->query($sql);
     $entry=$result->fetch_assoc();
     if (isset($_POST['delete_customer'])) {
         $sql=" DELETE FROM customers WHERE customer_id='".$_GET['id']."';";
         if($conn->query($sql)==TRUE){
           $customermsg= "Record Deleted successfully";
           header("location:home.php");
         }else{
           $customermsg = "An error occured while deleting record<br> ". $conn->error;
         }

}

        ?>


<body>
      <form class="create" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <center>  <span class="error"><?php echo $customermsg; ?></span>  </center>
        <fieldset>
          <input type="text" name="fname"<?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
            value="<?php echo $entry['fname'] ?>" <?php }; ?>placeholder="First Name">
        </fieldset>
        <fieldset>
          <input type="text" name="lname"<?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['lname'] ?>" <?php }; ?>placeholder="Last Name">
        </fieldset>
        <fieldset>
          <input type="text" name="email" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['email'] ?>" <?php }; ?>placeholder="Email">
        </fieldset>
        <fieldset>
          <input type="text" name="phone" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['phone'] ?>" <?php }; ?>placeholder="Phone">
        </fieldset>
        <fieldset>
          <input type="date" name="datereg" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['date_registered'] ?>" <?php }; ?>placeholder="Date of Registration ">
        </fieldset>
        <?php if (@$_GET['Update']==true): ?>
          <fieldset>
            <button type="submit" name="update_customer">Update Customer</button>
          </fieldset>

        <?php elseif (@$_GET['Delete']==TRUE): ?>
          <fieldset>
            <button type="submit" name="delete_customer"class="deleteBtn">Delete Customer</button>
          </fieldset>

        <?php else: ?>

        <fieldset>
          <button type="submit" name="create_customer">Create Customer</button>
        </fieldset>
        <?php endif; ?>
      </form>
