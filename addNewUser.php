<?php include ("includes/head.php"); ?>
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<style type="text/css">
    .select2-selection,.select2-selection--single{
        height: 38px !important;
        border: 1px solid #ced4da !important;
    }
  </style>

<?php 
$userType = $formHeading = "";

if (isset($_GET['userType'])) {
  $userType = $_GET['userType'];
  if ($userType == "L") {
    $formHeading = "Lawyer";
  }else if($userType == "C"){
    $formHeading = "Client";
  }
}

$userName  = $user_Email = $userCNIC = $userPhoneNo = $userDescription = $userGender =  $userAddress = $userCourt = $userCategory = $userCity = "";

function unsetSessions(){
  unset($_SESSION['userName']);
  unset($_SESSION['user_Email']);

  unset($_SESSION['userCity']);
  unset($_SESSION['userCNIC']);


  unset($_SESSION['userPhoneNo']);
  unset($_SESSION['userGender']);
  
  unset($_SESSION['userAddress']);
  unset($_SESSION['userCourt']);

  unset($_SESSION['userCategory']);
  unset($_SESSION['userDescription']);


}
if(!isset($_SESSION['error']) || count($_SESSION['error']) == 0){
  $_SESSION['error'] = array();
}

if (isset($_POST['submitBtn'])) {

  if (empty($_POST['userName'])) {
    array_push($_SESSION['error'], $formHeading." Title is Required.");
  }else{
    $userName = mysqli_real_escape_string($con,$_POST['userName']);
    $_SESSION['userName'] = $userName; 

    $userPassword = md5(md5($userName));
    
  }

  if (empty($_POST['user_Email'])) {
    array_push($_SESSION['error'], $formHeading." Email is Required.");
  }else{
    $user_Email = mysqli_real_escape_string($con,$_POST['user_Email']);
    $_SESSION['user_Email'] = $user_Email; 
    if (checkUserEmailExist($user_Email)>0) {
      array_push($_SESSION['error'], $formHeading." Email already Exist.");

    }
  }

  if (empty($_POST['userCNIC'])) {
    array_push($_SESSION['error'], $formHeading." CNIC is Required.");
  }else{
    $userCNIC = mysqli_real_escape_string($con,$_POST['userCNIC']);
    $_SESSION['userCNIC'] = $userCNIC; 
    if (strlen($userCNIC)<13 || strlen($userCNIC)>13) {
     array_push($_SESSION['error'], $formHeading." CNIC can not be greater than 13 digits, Please enter correct CNIC.");
    }
    if (checkUserCNICExist($userCNIC)>0) {
      array_push($_SESSION['error'], $formHeading." CNIC already Exist.");

    }
  }

  if (empty($_POST['userPhoneNo'])) {
    array_push($_SESSION['error'], $formHeading." Phono No is Required");
  }else{
    $userPhoneNo = mysqli_real_escape_string($con,$_POST['userPhoneNo']);
    $_SESSION['userPhoneNo'] = $userPhoneNo; 
  }


  if (empty($_POST['userGender'])) {
    array_push($_SESSION['error'], $formHeading." Gender is Required");
  }else{
    $userGender = mysqli_real_escape_string($con,$_POST['userGender']);
    $_SESSION['userGender'] = $userGender; 
  }


  if (empty($_POST['userAddress'])) {
    array_push($_SESSION['error'], $formHeading." Address is Required");
  }else{
    $userAddress = mysqli_real_escape_string($con,$_POST['userAddress']);
    $_SESSION['userAddress'] = $userAddress; 
  }


  if (empty($_POST['userCity'])) {
    array_push($_SESSION['error'], $formHeading." City is Required");
  }else{
    $userCity = mysqli_real_escape_string($con,$_POST['userCity']);
    $_SESSION['userCity'] = $userCity; 
  }

  if ($userType == "L") {

    if (empty($_POST['userDescription'])) {
      array_push($_SESSION['error'], $formHeading." Description is Required");
    }else{
      $userDescription = mysqli_real_escape_string($con,$_POST['userDescription']);
      $_SESSION['userDescription'] = $userDescription; 
    }


    if (empty($_POST['userCourt'])) {
      array_push($_SESSION['error'], $formHeading." Court is Required");
    }else{
      $userCourt = mysqli_real_escape_string($con,$_POST['userCourt']);
      $_SESSION['userCourt'] = $userCourt; 
    }

    if (empty($_POST['userCategory'])) {
      array_push($_SESSION['error'], $formHeading." Category is Required");
    }else{
      $userCategory = mysqli_real_escape_string($con,$_POST['userCategory']);
      $_SESSION['userCategory'] = $userCategory; 
    }
    
    
  }

   
  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $createdBy = $_SESSION['userID'];
    $createdDate = date("Y-m-d h:i:s");
    $userStatus = "A";
    
    if( basename($_FILES["profileImage"]["name"] != "")){

        $target_dir = "uploads/";
        $timestamp = time();
        $target_file = $target_dir . $timestamp.'-'.basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
        if($check !== false) {
            
          if (file_exists($target_file)) {
              array_push($_SESSION['error'], "Sorry, file already exists");
          }

          //Check file size
          if ($_FILES["profileImage"]["size"] > 500000) {
              array_push($_SESSION['error'], "File is too large");
          }


         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
              array_push($_SESSION['error'], "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
          }
          
          if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {

              if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
                  //your query with file path

                 $sql = "INSERT INTO `tbl_users` (`user_fullName`,`user_profileImage`,`user_email`,`user_password`,`user_cnic`,`user_contactNo`,`user_address`,`user_cityID`,`user_description`,`user_gender`,`user_type`,`user_status`,`user_courtID`,`user_lawyerID`,`createdBy`,`createdDate`)VALUES('$userName','$target_file','$user_Email','$userPassword','$userCNIC','$userPhoneNo','$userAddress','$userCity','$userDescription','$userGender','$userType','$userStatus','$userCourt','$userCategory','$createdBy','$createdDate')";
              } else {
                array_push($_SESSION['error'], "Sorry, there was an error uploading your file.");
              }
          

          }

                
          } else {
            array_push($_SESSION['error'], "Please Upload Image File Only");
             
          }
        
      }else{
         $sql = "INSERT INTO `tbl_users` (`user_fullName`,`user_email`,`user_password`,`user_cnic`,`user_contactNo`,`user_address`,`user_cityID`,`user_description`,`user_gender`,`user_type`,`user_status`,`user_courtID`,`user_lawyerID`,`createdBy`,`createdDate`)VALUES('$userName','$user_Email','$userPassword','$userCNIC','$userPhoneNo','$userAddress','$userCity','$userDescription','$userGender','$userType','$userStatus','$userCourt','$userCategory','$createdBy','$createdDate')";
      }

    if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {

      $result = mysqli_query($con,$sql);
      if ($result) {
        unsetSessions();
        $_SESSION['userAddedSuccessfullyMsg'] = $formHeading." Added Successfully";
        header("location:viewAllUsers.php?userType=".$userType);
        exit();
      }
    }
  }
}
?>

    <div id="wrapper">
        <?php include("includes/topNav.php"); ?>  
           <!-- /. NAV TOP  -->
            <?php include("includes/sidebar.php"); ?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Add New <?php if ($formHeading != "") {
                       echo $formHeading;
                     } ?></h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                <?php if ($formHeading != "") { echo $formHeading; } ?> Details
                            </div>
                            <form action="addNewUser.php?userType=<?php echo $userType; ?>" method="POST" enctype="multipart/form-data">
                                <?php 
                                  if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
                                    ?>
                                    <br>
                                    <?php
                                    $errArr = $_SESSION['error'];
                                    foreach ($errArr as $error) {
                                    ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                          echo $error; 
                                          
                                        ?>
                                    </div>
                                    <?php 
                                    }
                                    unset($_SESSION['error']);
                                  }


                                    if(isset($_SESSION['userName'])){
                                      $userName = $_SESSION['userName'];
                                    } 
                                    

                                     if(isset($_SESSION['user_Email'])){
                                      $user_Email = $_SESSION['user_Email'];
                                    } 
                                    

                                     if(isset($_SESSION['userCNIC'])){
                                      $userCNIC = $_SESSION['userCNIC'];
                                    } 
                                    

                                     if(isset($_SESSION['userPhoneNo'])){
                                      $userPhoneNo = $_SESSION['userPhoneNo'];
                                    } 
                                    

                                     if(isset($_SESSION['userAddress'])){
                                      $userAddress = $_SESSION['userAddress'];
                                    } 
                                    

                                     if(isset($_SESSION['userCity'])){
                                      $userCity = $_SESSION['userCity'];
                                    } 
                                    

                                     if(isset($_SESSION['userName'])){
                                      $userName = $_SESSION['userName'];
                                    } 
                                    

                                     if(isset($_SESSION['userDescription'])){
                                      $userDescription = $_SESSION['userDescription'];
                                    } 
                                    
                                    if(isset($_SESSION['userGender'])){
                                      $userGender = $_SESSION['userGender'];
                                    } 

                                     if(isset($_SESSION['userCourt'])){
                                      $userCourt = $_SESSION['userCourt'];
                                    } 

                                     if(isset($_SESSION['userCategory'])){
                                      $userCategory = $_SESSION['userCategory'];
                                    } 
                                ?>
                                <div class="panel-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label><?php echo $formHeading; ?> Image</label>
                                        <input type="file" class="form-control" id="profileImage"  name="profileImage">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label><?php echo $formHeading; ?> Name</label>
                                          <input type="text" class="form-control" id="userName" placeholder="Enter Name" name="userName" value="<?php echo $userName; ?>">
                                      </div>  
                                    </div>
                                  </div>
                                    

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label><?php echo $formHeading; ?> Email</label>
                                          <input type="email" class="form-control" id="userName" placeholder="Enter Email" name="user_Email" value="<?php echo $user_Email; ?>">
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label><?php echo $formHeading; ?> CNIC</label>
                                          <input type="text" class="form-control" id="userCNIC" placeholder="Enter CNIC" name="userCNIC" value="<?php echo $userCNIC; ?>">
                                      </div>  
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <label><?php echo $formHeading; ?> Phono No</label>
                                          <input type="text" class="form-control" id="userPhoneNo" placeholder="Enter Phone No" name="userPhoneNo" value="<?php echo $userPhoneNo; ?>">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div  class="form-group">
                                          <label><?php echo $formHeading; ?> Gender</label>

                                           <select  name="userGender" id="userGender" class="form-control select2">
                                              <option value="">Please Select</option>
                                              <option <?php if($userGender == "M"){echo "selected";} ?> value="M">Male</option>
                                              <option <?php if($userGender == "F"){echo "selected"; } ?> value="F">Female</option>
                                            </select>
                                      
                                          
                                        </div>  
                                    </div>
                                    <div class="col-md-4">
                                      <div  class="form-group">
                                      <label><?php echo $formHeading; ?> City</label>

                                       <select  name="userCity" id="userCity" class="form-control select2">
                                          <option value="">Please Select City</option>
                                          <?php 
                                            $sqlCity = "SELECT * FROM `tbl_cities` ORDER BY `city` ASC";
                                            $resultCity = mysqli_query($con,$sqlCity);
                                            if ($resultCity) {
                                              if (mysqli_num_rows($resultCity)>0) {
                                                while ($rowCity = mysqli_fetch_array($resultCity)) {
                                                  ?>
                                                  <option <?php if($userCity == $rowCity['id']){echo "selected";} ?> value="<?php echo $rowCity['id']; ?>"><?php echo $rowCity['city']; ?></option>
                                                  <?php
                                                }
                                              }
                                            }
                                          ?>
                                          
                                         
                                        </select>
                                  
                                      
                                      </div>

                                    </div>
                                  </div>
                                    
                                    <?php if ($userType == "L") { ?> 
                                      <div class="row">
                                        <div class="col-md-6">
                                           <div  class="form-group">
                                            <label><?php echo $formHeading; ?> Court</label>

                                             <select  name="userCourt" id="userCourt" class="form-control select2">
                                                <option value="">Please Select Court</option>
                                                <?php 
                                                  $sqlCourt = "SELECT * FROM `tbl_courts` WHERE `court_status` = 'A' ORDER BY `court_id` DESC";
                                                  $resultCourt = mysqli_query($con,$sqlCourt);
                                                  if ($resultCourt) {
                                                    if (mysqli_num_rows($resultCourt)>0) {
                                                      while ($rowCourt = mysqli_fetch_array($resultCourt)) {
                                                        ?>
                                                        <option <?php if($userCourt == $rowCourt['court_id']){echo "selected";} ?> value="<?php echo $rowCourt['court_id']; ?>"><?php echo $rowCourt['court_title']; ?></option>
                                                        <?php
                                                      }
                                                    }
                                                  }
                                                ?>
                                                
                                               
                                              </select>
                                        
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div  class="form-group">
                                            <label><?php echo $formHeading; ?> Category</label>

                                             <select  name="userCategory" id="userCategory" class="form-control select2">
                                                <option value="">Please Select Cgoryate</option>
                                                <?php 
                                                  $sqlCate = "SELECT * FROM `tbl_lawyer_categories` WHERE `lawyer_cate_status` = 'A' ORDER BY `lawyer_cate_id` DESC";
                                                  $resultCate = mysqli_query($con,$sqlCate);
                                                  if ($resultCate) {
                                                    if (mysqli_num_rows($resultCate)>0) {
                                                      while ($rowCate = mysqli_fetch_array($resultCate)) {
                                                        ?>
                                                        <option <?php if($userCategory == $rowCate['lawyer_cate_id']){echo "selected";} ?> value="<?php echo $rowCate['lawyer_cate_id']; ?>"><?php echo $rowCate['lawyer_cate_title']; ?></option>
                                                        <?php
                                                      }
                                                    }
                                                  }
                                                ?>
                                                
                                               
                                              </select>
                                        
                                            
                                            </div>
                                        </div>

                                      </div>
                                     

                                      
                                      
                                    <?php } ?>
                                  
                                   <div class="row">
                                     <div class="col-md-6">
                                       <div class="form-group">
                                        <label><?php echo $formHeading; ?> Address</label>
                                        <textarea class="form-control" name="userAddress" rows="5" placeholder="Enter Address"><?php echo $userAddress ?></textarea>
                                      </div>

                                     </div>
                                     <?php if ($userType == "L") { ?>
                                      <div class="col-md-6">
                                         <div class="form-group">
                                            <label><?php echo $formHeading; ?> Description</label>
                                            <textarea class="form-control" name="userDescription" rows="5" placeholder="Enter Description"><?php echo $userDescription ?></textarea>
                                          </div>
                                      </div>
                                     <?php } ?>
                                   </div>                                    
                                   

                                </div>
                                <div class="panel-footer panelFootBg">
                                    <button type="submit" name="submitBtn" class="btn btn-primary pull-right">Submit</button>
                                    <div class="clearfix"></div>
                                    
                                </div>   
                            </form>
                            
                        </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/footer.php"); ?>


        <!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


  })
</script>
</body>
</html>
