<?php include_once 'header.php'; ?>
  <body>
<?php
      if (isset($_SESSION['user']) && isset($_SESSION['privilege'])) {
?>
  <h1><center>Customer Order Management System
    <br><br>

    <!-- Here begins the table for orders -->
                      Orders
  </center></h1>
  <center> <table border="2" cellpadding='10' cellspacing='10'class="read">
    <thead>
      <th>Order id</th>
      <th>Customer id</th>
      <th>Order date</th>
      <th>Due date</th>
      <th>Date completed</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php while ($Orders = $readOrderResult->fetch_assoc()) {
       ?>
       <tr>
         <td><?php echo $Orders['order_id']; ?></td>
         <td><?php echo $Orders['customer_id']; ?></td>
         <td><?php echo $Orders['order_date']; ?></td>
         <td><?php echo $Orders['due_date']; ?></td>
         <td><?php echo $Orders['date_completed']; ?></td>
         <td> <a href="order.php?id=<?php echo $Orders['order_id']; ?>&Update=true" class="updateBtn">Update</a> </td>
         <td> <a href="order.php?id=<?php echo $Orders['order_id']; ?>&Delete=true" class="deleteBtn">Delete</a> </td>
       </tr>

       <?php
          }
        ?>
    </tbody>
  </table>  </center>
  <br>
  <center><a href="order.php" class="updateBtn">Create Order </a></center>
  <br>

  <!-- Here Begins the table for customers -->
    <center><h1>Customers</h1></center>
    <center> <table border="1" cellpadding='10' cellspacing='10' class="read">
      <thead>
        <th>Customer id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>phone</th>
        <th>Date Registered</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php while ($customers = $custOrderResult->fetch_assoc()) {
         ?>
         <tr>
           <td><?php echo $customers['customer_id']; ?></td>
           <td><?php echo $customers['fname']; ?></td>
           <td><?php echo $customers['lname']; ?></td>
           <td><?php echo $customers['email']; ?></td>
           <td><?php echo $customers['phone']; ?></td>
           <td><?php echo $customers['date_registered']; ?></td>
           <td> <a href="customer.php?id=<?php echo $customers['customer_id']; ?>&Update=true" class="updateBtn">Update</a> </td>
           <td> <a href="customer.php?id=<?php echo $customers['customer_id']; ?>&Delete=true" class="deleteBtn">Delete</a> </td>
         </tr>

         <?php
            }
          ?>
      </tbody>
    </table>  </center>
    <br>
    <center><a href="customer.php" class="updateBtn">Create Customer </a></center>
    <br>


    <!-- Here Begins the table for users -->
    <?php
          if ($_SESSION['privilege'] == "admin" || $_SESSION['privilege'] == "superadmin") {
            // code...
    ?>
      <center><h1>Users</h1></center>
      <center> <table border="1" cellpadding='10' cellspacing='10'  class="read">
        <thead>
          <th>User id</th>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>privilege</th>
          <th>Date Registered</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php while ($users = $Result->fetch_assoc()) {
           ?>
           <tr>
             <td><?php echo $users['user_id']; ?></td>
             <td><?php echo $users['username']; ?></td>
             <td><?php echo $users['email']; ?></td>
             <td><?php echo $users['password']; ?></td>
             <td><?php echo $users['privilege']; ?></td>
             <td><?php echo $users['date_registered']; ?></td>
             <td> <a href="user.php?id=<?php echo $users['user_id']; ?>&Update=true" class="updateBtn">Update</a> </td>
             <td> <a href="user.php?id=<?php echo $users['user_id']; ?>&Delete=true" class="deleteBtn">Delete</a> </td>
           </tr>

           <?php
              }
            ?>
        </tbody>
      </table>  </center>
      <br>
      <center><a href="user.php" class="updateBtn">Create User </a></center>
      <br>
      <?php
    }
       ?>

      <?php
       }else {
         echo "<center><h1> Please login to continue<center><h1>";
       }
        ?>
<?php include_once 'footer.php'; ?>
