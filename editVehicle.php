<?php include ("includes/head.php"); 

$vehicleTitle  = $vehicleStatus = "";

if (isset($_GET['vehicleID'])) {
  $vehicleID = $_GET['vehicleID'];
   $sql = "SELECT * FROM `tbl_vehicles` WHERE `vehicle_id` = '$vehicleID'";
   $result = mysqli_query($con,$sql);
    if($result){
      if(mysqli_num_rows($result)>0){
        if (mysqli_num_rows($result)==1) {
          if ($row = mysqli_fetch_array($result)) {
            $vehicleTitle = $row['vehicle_title'];
            $vehicleStatus = $row['vehicle_status'];
           }
        }
      }
    }
 }

function unsetSessions(){
  unset($_SESSION['vehicleTitle']);
  unset($_SESSION['vehicleStatus']);

}
if(!isset($_SESSION['error']) || count($_SESSION['error']) == 0){
  $_SESSION['error'] = array();
}

if (isset($_POST['submitBtn'])) {

  if (empty($_POST['vehicleTitle'])) {
    array_push($_SESSION['error'], "Vehicle Title is Required.");
  }else{
    $vehicleTitle = mysqli_real_escape_string($con,$_POST['vehicleTitle']);
    $_SESSION['vehicleTitle'] = $vehicleTitle; 
    if (checkvehicleTitleExist($vehicleTitle,$vehicleID)>0) {
      array_push($_SESSION['error'], "Vehicle Title already Exist.");

    }
  }


  if (empty($_POST['vehicleStatus'])) {
    array_push($_SESSION['error'], "Vehicle Status is Required.");
  }else{
    $vehicleStatus = mysqli_real_escape_string($con,$_POST['vehicleStatus']);
    $_SESSION['vehicleStatus'] = $vehicleStatus; 
 
  }


   
  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $updatedBy = $_SESSION['userID'];
    $updatedDate = date("Y-m-d h:i:s");
   
    $sql = "UPDATE `tbl_vehicles`
              SET 
                `vehicle_title` = '$vehicleTitle',
                `vehicle_status` = '$vehicleStatus',
                `updatedBy` = '$updatedBy',
                `updatedDate` = '$updatedDate'
              WHERE `vehicle_id` = '$vehicleID' ";
      $result = mysqli_query($con,$sql);
      if ($result) {
        unsetSessions();
         $_SESSION['vehicleAddedSuccessfullyMsg'] = "Vehicle Updated Successfully";
        header("location:viewAllVehicles.php");
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
                     <h2>Edit Vehicle Details</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Vehicle Details
                            </div>
                            <form action="editVehicle.php?vehicleID=<?php echo $vehicleID; ?>" method="POST" >
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


                                    if(isset($_SESSION['vehicleTitle'])){
                                      $vehicleTitle = $_SESSION['vehicleTitle'];
                                    } 
                                    if(isset($_SESSION['vehicleStatus'])){
                                      $vehicleStatus = $_SESSION['vehicleStatus'];
                                    } 
                                    
                                ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Vehicle Title</label>
                                        <input type="text" class="form-control" id="vehicleTitle" placeholder="Enter Vehicle Title" name="vehicleTitle" value="<?php echo $vehicleTitle; ?>">
                                    </div>
                                    <div  class="form-group">
                                      <label>Vehicle Status</label>

                                       <select  name="vehicleStatus" id="vehicleStatus" class="form-control select2">
                                          <option value="">Please Select</option>
                                          <option <?php if($vehicleStatus == "A"){echo "selected";} ?> value="A">Active</option>
                                          <option <?php if($vehicleStatus == "B"){echo "selected"; } ?> value="B">Block</option>
                                        </select>
                                  
                                      
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
