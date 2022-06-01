<?php include ("includes/head.php"); 

$vehicleTitle  = "";

function unsetSessions(){
  unset($_SESSION['vehicleTitle']);
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
    if (checkvehicleTitleExist($vehicleTitle)>0) {
      array_push($_SESSION['error'], "Vehicle Title already Exist.");

    }
  }

  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $createdBy = $_SESSION['userID'];
    $createdDate = date("Y-m-d h:i:s");
    $vehicleStatus = "A";
    
    $sql = "INSERT INTO `tbl_vehicles` (`vehicle_title`,`vehicle_status`,`createdBy`,`createdDate`)VALUES('$vehicleTitle','$vehicleStatus','$createdBy','$createdDate')";

      $result = mysqli_query($con,$sql);
      if ($result) {
        unsetSessions();
        $_SESSION['vehicleAddedSuccessfullyMsg'] = "Vehicle Added Successfully";
        header("location:viewAllVehicles.php");
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
                     <h2>Add New Vehicle</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Vehicle Details
                            </div>
                            <form action="addNewVehicle.php" method="POST">
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
                                    
                                ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Vehicle Title</label>
                                        <input type="text" class="form-control" id="vehicleTitle" placeholder="Enter Vehicle Title" name="vehicleTitle" value="<?php echo $vehicleTitle; ?>">
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
