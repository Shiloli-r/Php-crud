<?php
  require_once 'dbconnection.php';

/* function to validate the form input */
    function test_data($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

/* Log in form handling */
    /* Variables for the input field error messages */
        $username_error=$password_error=$message='';


    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(isset($_POST['username']) && isset($_POST['password'])){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
           $username=test_data(lcfirst($_POST['username']));
            $password=md5(test_data($_POST['password']));

            /* SQL query to extract the field from the database */

            $sql="SELECT * FROM users WHERE username='".$username."' AND
            password = '".$password."';";

            /*Running query to extract the fields(if they exist) */

            $result = $conn->query($sql);
            $records= $result->fetch_assoc(); //Stores the records in an array
            if($result->num_rows > 0){
              if ($records['username']===$username && $records['password']===$password) {
                $_SESSION['user']=$records['username'];
                $_SESSION['privilege']=$records['privilege'];
                header("location:home.php");
            }
            }else{
                $message="Wrong Username or password Entered";
            }
        }
        if(empty($_POST['username'])){
          $username_error="Username Required";
        }
        if(empty($_POST['password'])){
          $password_error="Password Required";
        }
      }
    }

/* Reading Records (Home.php) */
/*Creating the array and printing to the app? home.php*/
        //1. Customers
        $sql = "SELECT * FROM customers;";
        $custOrderResult = $conn->query($sql);
        if($custOrderResult->num_rows > 0){

          }

        else{
          echo "0 rows returned";
        }

  //2. Orders

      $sql = "SELECT * FROM orders;";
      $readOrderResult = $conn->query($sql);

      if($readOrderResult->num_rows > 0){

        }

      else{
        echo "0 rows returned";
      }

  //3. users
      $sql = "SELECT * FROM users;";
      $Result = $conn->query($sql);
      if($Result->num_rows > 0){

      }else{
        echo "0 rows returned";
      }

/* ################ Functions to Insert data into the db ########################################*/
        $usermsg=$customermsg=$ordermsg="";
      //1. Users
      if (isset($_POST['create_user'])) {
        if(empty($_POST['username'])  || empty($_POST['uemail'])  ||  empty($_POST['password']) ||
        empty($_POST['privilege']) ||  empty($_POST['udatereg'])){
          $usermsg="Please Fill In All The Fields";
        }else{

        /*Creating the SQL query */
        $username=test_data(lcfirst($_POST["username"]));
        $email=test_data($_POST["uemail"]);
        $password=md5(test_data($_POST["password"]));
        $privilege=test_data($_POST["privilege"]);
        $date_registered=test_data($_POST["udatereg"]);



          // Checking whether the user already exists

          $sql = "SELECT * FROM users WHERE username='".$_POST["username"]."';";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            header("location:user.php");
            $usermsg="User already exists ";
          }else{

                $sql = "INSERT INTO users(username,	email,	password,	privilege,	date_registered)
                VALUES ('".$username."' , '".$email."', '".$password."', '".$privilege."','".$date_registered."')";

                if ($conn -> query($sql) == TRUE) { //Executes the query and checks whether it returns true(is successful )
                  $usermsg = "Record Created successfully<br>";
                  header("location:home.php");
                }else {
                  $usermsg = "An Error occured".'<br>'. $conn->error;
                }
              }
          }
   }

    //2. customers

    if (isset($_POST['create_customer'])) {
      /*Creating the SQL query */
    $fname=test_data(ucfirst($_POST['fname']));
    $lname=test_data(ucfirst($_POST['lname']));
    $email=test_data($_POST['email']);
    $phone=test_data($_POST['phone']);
    $datereg=test_data($_POST['datereg']);

    // Checking whether the customer already exists

    $sql = "SELECT * FROM customers WHERE email='".$_POST["email"]."' OR phone ='".$_POST["email"]."';";
    $result=$conn->query($sql);
    if($result->num_rows>0){
      header("location:customer.php");
      $customermsg="Customer credentials(phone or email) already exist";
    }else{

      $sql = "INSERT INTO customers(fname, lname,	email,	phone,	date_registered)
      VALUES ('".$fname."' , '".$lname."', '".$email."', '".$phone."','".$datereg."')";

      if ($conn -> query($sql) == TRUE) { //Executes the query and checks whether it returns true(is successful )
        $message = "Record Created successfully<br>";
        header("location:home.php");
      }else {
        $message = "An Error occured".'<br>'. $conn->error;
      }
    }
}
        //3. orders

        if (isset($_POST['create_order'])) {
          if(empty($_POST['customer_id'])  || empty($_POST['order_date'])  ||  empty($_POST['due_date']) ||
          empty($_POST['datecom']) ){
            $ordermsg="Please Fill In All The Fields";
          }else{

          /*Creating the SQL query */

            $cusid = test_data($_POST['customer_id']);
            $ordate = test_data($_POST['order_date']);
            $duedat = test_data($_POST['due_date']);
            $datecom = test_data($_POST['datecom']);

              $sql = "INSERT INTO orders(customer_id,	order_date,	due_date,	date_completed)
              VALUES ('".$cusid."' , '".$ordate."', '".$duedat."', '".$datecom."')";

              if ($conn -> query($sql) == TRUE) { //Executes the query and checks whether it returns true(is successful )
                $ordermsg = "Record Created successfully<br>";
                header("location:home.php");
              }else {
                $ordermsg = "An Error occured".'<br>'. $conn->error;
              }
            }
        }

 ?>
