<?php include ("includes/head.php"); 

$announcementTitle  = $announcementfor= $announcementDescription= "";

if (isset($_GET['announcementID'])) {
  $announcementID = $_GET['announcementID'];
   $sql = "SELECT * FROM `tbl_announcement` WHERE `announcement_id` = '$announcementID'";
   $result = mysqli_query($con,$sql);
    if($result){
      if(mysqli_num_rows($result)>0){
        if (mysqli_num_rows($result)==1) {
          if ($row = mysqli_fetch_array($result)) {
            $announcementTitle = $row['announcement_title'];
            $announcementStatus = $row['announcement_status'];
             $announcementfor = $row['announcement_for'];
              $announcementDescription = $row['announcement_description'];
           }
        }
      }
    }
 }

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
    if (checkannouncementTitleExist($announcementTitle,$announcementID)>0) {
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


  if (empty($_POST['announcementStatus'])) {
    array_push($_SESSION['error'], "Announcement Status is Required.");
  }else{
    $announcementStatus = mysqli_real_escape_string($con,$_POST['announcementStatus']);
    $_SESSION['announcementStatus'] = $announcementStatus; 
 
  }

  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $updatedBy = $_SESSION['userID'];
    $updatedDate = date("Y-m-d h:i:s");
   
    $sql = "UPDATE `tbl_announcement`
              SET 
                `announcement_title` = '$announcementTitle',
                `announcement_for` = '$announcementfor',
                `announcement_description` = '$announcementDescription',
                `announcement_status` = '$announcementStatus',
                `updatedBy` = '$updatedBy',
                `updatedDate` = '$updatedDate'
              WHERE `announcement_id` = '$announcementID' ";
      $result = mysqli_query($con,$sql);
      if ($result) {

        sendNotifications($announcementTitle,$announcementID,$announcementfor);
        
        unsetSessions();
         $_SESSION['announcementAddedSuccessfullyMsg'] = "Announcement Updated Successfully";
        header("location:viewAllAnnouncements.php");
        exit();
      }
  }
}
?>
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<style type="text/css">
    .select2-selection,.select2-selection--single{
        height: 38px !important;
        border: 1px solid #ced4da !important;
    }
</style>

    <div id="wrapper">
        <?php include("includes/topNav.php"); ?>  
           <!-- /. NAV TOP  -->
            <?php include("includes/sidebar.php"); ?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Edit Announcement Details</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Announcement Details
                            </div>
                            <form action="editAnnouncement.php?announcementID=<?php echo $announcementID; ?>" method="POST" >
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
                                    if(isset($_SESSION['announcementStatus'])){
                                      $announcementStatus = $_SESSION['announcementStatus'];
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

                                    <div  class="form-group">
                                      <label>Announcement Status</label>

                                       <select  name="announcementStatus" id="announcementStatus" class="form-control select2">
                                          <option value="">Please Select</option>
                                          <option <?php if($announcementStatus == "A"){echo "selected";} ?> value="A">Active</option>
                                          <option <?php if($announcementStatus == "B"){echo "selected"; } ?> value="B">Block</option>
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
