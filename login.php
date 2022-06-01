<?php 
include("includes/connection.php"); 
include("includes/functions.php"); 
if(checkLogin() == true && checkUserType() == "SA"){
    header("location:login.php");
    exit();
}

if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
  $_SESSION['errors'] =  array();
}

if(isset($_POST['loginBtn'])){
    
    if(empty($_POST['email'])){
       array_push($_SESSION['errors'], "Email is Required.");
    }else{
      $email = $_POST['email'];  
    }
    if(empty($_POST['password'])){
       array_push($_SESSION['errors'], "Password is Required.");
    }else{
      $password = md5(md5($_POST['password']));
    }

    if (!isset($_SESSION['errors']) || count($_SESSION['errors']) == 0) {
      $sql = "SELECT * FROM `tbl_users` WHERE `user_email` = '$email' and `user_password` = '$password' AND `user_status` = 'A' AND `user_type` = 'SA'";
      $result = mysqli_query($con,$sql);
      if($result){
        if(mysqli_num_rows($result) == 1){
          if($row = mysqli_fetch_assoc($result)){    
              $_SESSION['userID'] =  $row['user_id'];
              $_SESSION['userFullName'] = $row['user_fullName'];
              $_SESSION['userType'] = $row['user_type'];
              $_SESSION['userEmail'] = $email;
              header("location:index.php");
              exit();
          }
        }else{
          array_push($_SESSION['errors'], "Email or Password is incorrect Please enter valid credentials.");
        }
      }

    }
    
    
   
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  <link href="assets/css/login.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>

</body>
</html>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <h2>Admin Login</h2>
    </div>
    <div style="padding: 10px;">
    <?php if (isset($_SESSION['errors'])) { 
      $errors = $_SESSION['errors'];
      foreach ($errors as $error) {
        
      ?>
       <div class="alert alert-danger">
          <?php echo $error; ?>
      </div>
    <?php }
     unset($_SESSION['errors']);
      } 
    ?>
    </div>
    <!-- Login Form -->
    <form action="login.php" method="POST">
      <input type="email" id="login" class="fadeIn second" name="email" placeholder="Enter Email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter Passowrd">
      <input type="submit" class="fadeIn fourth" value="Log In" name="loginBtn">
    </form>

    <!-- Remind Passowrd -->
    
  </div>
</div>