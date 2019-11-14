<?php require_once 'dbconnection.php';
      include_once 'header.php';  ?>

<?php
/* Updating records */
    $sql = "SELECT * FROM orders WHERE order_id='". @$_GET['id']."';";
    $result = $conn->query($sql);
    $entry = $result->fetch_assoc();
    if (isset($_POST['update_order'])) {
      if(!empty($_POST['customer_id']) && !empty($_POST['order_date']) &&!empty($_POST['due_date']) && !empty($_POST['datecom'])){
        $cusid = test_data($_POST['customer_id']);
        $ordate = test_data($_POST['order_date']);
        $duedat = test_data($_POST['due_date']);
        $datecom = test_data($_POST['datecom']);
        $sql=" UPDATE orders
         SET customer_id= '".$cusid."',
              order_date='".$ordate."',
              due_date='".$duedat."',
              date_completed='".$datecom."' WHERE order_id='".$_GET['id']."';";
              if($conn->query($sql)==TRUE){
                $ordermsg="Record Updated successfully";
                header("location:home.php");
              }else{
                echo $conn->error;
                die("<br>An error occured while updating record "); }
      }else{ $ordermsg="Please Fill In All The Fields"; }
    }
?>

<?php
/* Deleting Records */
     $sql = "SELECT * FROM orders WHERE order_id='".@$_GET['id']."';";
     $result = $conn->query($sql);
     $entry=$result->fetch_assoc();
     if (isset($_POST['delete_order'])) {
    if(!empty($_POST['customer_id']) && !empty($_POST['order_date']) &&!empty($_POST['due_date']) && !empty($_POST['datecom'])){
      $sql= "DELETE FROM orders WHERE order_id= '".$_GET['id']."';";
      if($conn->query($sql)==TRUE){
        $customermsg="Record Deleted successfully";
        header("location:home.php");
      }else{
        echo $conn->error;
        die("<br>An error occured while deleting record "); }
       }else{ $ordermsg="Please Fill In All The Fields"; }
}
?>
<body>
      <form class="create" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      <center><span class="error"><?php echo $ordermsg; ?></span></center>
          <?php if(@$_GET['Delete']==True ):?>
            <fieldset>
              <input type="text" name="customer_id" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
              value="<?php echo $entry['customer_id'] ?>" <?php }; ?>placeholder="Customer">
            </fieldset>
          <?php endif; ?>
          <?php if(@$_GET['Delete']==False ):?>
          <fieldset>
            <select class="select" name="customer_id">
              <?php
                /* Enforcing referential integrity */
                  $sql = "SELECT * FROM customers ;";
                  $result = $conn->query($sql);
                  while ($centry=$result->fetch_assoc()):
               ?>
              <option value="<?php echo $centry['customer_id'] ?>"><?php echo $centry['customer_id'] ?></option>
              <?php endwhile; ?>
            </select>
          </fieldset>
          <?php endif; ?>
        <fieldset>
          <input type="date" name="order_date" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['order_date'] ?>" <?php }; ?>placeholder="Order date">
        </fieldset>
        <fieldset>
          <input type="date" name="due_date" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['due_date'] ?>" <?php }; ?>placeholder="Due date">
        </fieldset>
        <fieldset>
          <input type="date" name="datecom" <?php if(@$_GET['Delete']==True || @$_GET['Update']==True){?>
          value="<?php echo $entry['date_completed'] ?>" <?php }; ?>placeholder="Date Completed  ">
        </fieldset>
        <?php if (@$_GET['Update']==true): ?>
          <fieldset>
            <button type="submit" name="update_order">Update Orders</button>
          </fieldset>

        <?php elseif (@$_GET['Delete']==TRUE): ?>
          <fieldset>
            <button type="submit" name="delete_order" class="deleteBtn">Delete Order</button>
          </fieldset>

        <?php else: ?>

        <fieldset>
          <button type="submit" name="create_order">Create Order</button>
        </fieldset>
        <?php endif; ?>
      </form>
