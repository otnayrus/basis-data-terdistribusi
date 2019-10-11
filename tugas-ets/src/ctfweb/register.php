<!DOCTYPE html>
<?php
  $_errorpassword = 0;
  include('registerverif.php') 
?>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<style type="text/css">
  html {
    background: black;
  }

  body {
    font-family: "Open Sans";
    font-size: 16px;
    color: White;
    font-smoothing: antialiased;
    font-weight: 600;
  }

  a {
    color: #BBB;
  }
</style>
<body>
<?php 
    if($isok < 1){
?>
<div class="content">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
      <input type="text" name="username" placeholder="Username (Alphanumeric Only)" style="width: 460px;" required>
      <?php if (isset($name_error)): ?>
        <span><?php echo $name_error; ?></span>
      <?php endif ?>
    </div>
    <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
      <input type="email" name="email" placeholder="Email" style="width: 460px;" required>
      <?php if (isset($email_error)): ?>
        <span><?php echo $email_error; ?></span>
      <?php endif ?>
    </div>
    
    
    
     <div>
        <input type="password"  placeholder="Password" name="password" style="width: 460px;" required>
    </div>
    <?php 
    if($_errorpassword){
      echo "<h5 style='color:red;'>Password Tidak Sesuai</h5>";
    }
    ?>
    <div>
        <input type="password"  placeholder="Password Confirmation" name="Password_Confirmation" style="width: 460px;" required>
    </div>
<input type="submit" name="submit" value="Register" />
</form>
Already have one? <a href="login.php">Login here.</a>
</div>
<?php } ?>
</body>
<script type="text/javascript">
    $("input[name='username'] ").focus(function (e) {
        if (!(e.which != 8 && e.which != 0 && ((e.which >= 48 && e.which <= 57)  || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) ))) {
            event.preventDefault();
        }
    }).keyup(function (e) {
        if (!(e.which != 8 && e.which != 0 && ((e.which >= 48 && e.which <= 57)  || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) ))) {
        event.preventDefault();
            }
    }).keypress(function (e) {
        if (!(e.which != 8 && e.which != 0 && ((e.which >= 48 && e.which <= 57)  || (e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122) ))) {
            event.preventDefault();
        }
    });
</script>

</html>