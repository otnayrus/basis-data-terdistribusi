<?php

require('db.php');
$isok = 0;
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
  // echo var_dump($_REQUEST);
  // die;
  if($_REQUEST['password']!=$_REQUEST['Password_Confirmation']){
    $_errorpassword = 1;
  }
  else{
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    $trn_date = date("Y-m-d H:i:s");

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $sql_e = "SELECT * FROM users WHERE email='$email'";
    $res_u = mysqli_query($con, $sql_u);
    $res_e = mysqli_query($con, $sql_e);

    if (mysqli_num_rows($res_u) > 0) {
      $name_error = "Sorry... username already taken";  
    }else if(mysqli_num_rows($res_e) > 0){
      $email_error = "Sorry... email already taken";    
    }else{
        //query for inserting to database
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            $isok = 1;
            echo "<div class='form'> <h3>You are registered successfully.</h3>
            <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }
  }

    }
?>
