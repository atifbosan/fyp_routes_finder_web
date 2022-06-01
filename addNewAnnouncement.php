<?php include ("includes/head.php"); 

$announcementTitle  = $announcementfor= $announcementDescription= "";

function unsetSessions(){
  unset($_SESSION['announcementTitle']);
  unset($_SESSION['announcementfor']);
   unset($_SESSION['announcementDescription']);
}
if(!isset($_SESSION['error']) || count($_SESSION['error']) == 0){
  $_SESSION['error'] = array();
}

if (isset($_POST['submitBtn'])) {

  if (empty($_POST['announcementTitle'])) {
    array_push($_SESSION['error'], "Announcement Title is Required.");
  }else{
    $announcementTitle = mysqli_real_escape_string($con,$_POST['announcementTitle']);
    $_SESSION['announcementTitle'] = $announcementTitle; 
    if (checkannouncementTitleExist($announcementTitle)>0) {
      array_push($_SESSION['error'], "Announcement Title already Exist.");

    }

  if (empty($_POST['announcementfor'])) {
    array_push($_SESSION['error'], "Announcement For is Required.");
  }else{
    $announcementfor = mysqli_real_escape_string($con,$_POST['announcementfor']);
    $_SESSION['announcementfor'] = $announcementfor; 
 
  }

  if (empty($_POST['announcementDescription'])) {
    array_push($_SESSION['error'], "Announcement Description is Required");
  }else{
    $announcementDescription = mysqli_real_escape_string($con,$_POST['announcementDescription']);
    $_SESSION['announcementDescription'] = $announcementDescription; 
  }

  }

  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $createdBy = $_SESSION['userID'];
    $createdDate = date("Y-m-d h:i:s");
    $announcementStatus = "A";
    
  $sql = "INSERT INTO `tbl_announcement` (`announcement_title`,`announcement_for`,`announcement_description`,`announcement_status`,`createdBy`,`createdDate`)VALUES('$announcementTitle','$announcementfor','$announcementDescription','$announcementStatus','$createdBy','$createdDate')";

      $result = mysqli_query($con,$sql);
      if ($result) {
        $announcementID = mysqli_insert_id($con);
        sendNotifications($announcementTitle,$announcementID,$announcementfor);
        
        unsetSessions();
        $_SESSION['announcementAddedSuccessfullyMsg'] = "Announcement Added Successfully";
        header("location:viewAllAnnouncements.php");
        exit();
    
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
                     <h2>Add New Announcement</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Announcement Details
                            </div>
                            <form action="addNewAnnouncement.php" method="POST">
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


                                    if(isset($_SESSION['announcementTitle'])){
                                      $announcementTitle = $_SESSION['announcementTitle'];
                                    } 

                                    if(isset($_SESSION['announcementfor'])){
                                      $announcementfor = $_SESSION['announcementfor'];
                                    } 

                                    if(isset($_SESSION['announcementDescription'])){
                                      $announcementDescription = $_SESSION['announcementDescription'];
                                    }       
                                ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Announcement Title</label>
                                        <input type="text" class="form-control" id="announcementTitle" placeholder="Enter Announcement Title" name="announcementTitle" value="<?php echo $announcementTitle; ?>">
                                    </div>

                                    <div  class="form-group">
                                      <label>Announcement For</label>

                                       <select  name="announcementfor" id="announcementfor" class="form-control select2">
                                          <option value="">Please Select</option>
                                          <option <?php if($announcementfor == "D"){echo "selected";} ?> value="D">Drivers</option>
                                          <option <?php if($announcementfor == "U"){echo "selected"; } ?> value="U">Users</option>
                                          <option <?php if($announcementfor == "BDU"){echo "selected"; } ?> value="BDU">Both</option>
                                        </select>  
                                    </div>

                                    <div class="form-group">
                                      <label>Announcement Description</label>
                                      <textarea class="form-control" name="announcementDescription" rows="5" placeholder="Enter Announcement Description"><?php echo $announcementDescription ?></textarea>
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
</body>
</html>
