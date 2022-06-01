<?php include ("includes/head.php"); 

$routeTitle  = "";

function unsetSessions(){
  unset($_SESSION['routeTitle']);
}
if(!isset($_SESSION['error']) || count($_SESSION['error']) == 0){
  $_SESSION['error'] = array();
}

if (isset($_POST['submitBtn'])) {

  if (empty($_POST['routeTitle'])) {
    array_push($_SESSION['error'], "Route Title is Required.");
  }else{
    $routeTitle = mysqli_real_escape_string($con,$_POST['routeTitle']);
    $_SESSION['routeTitle'] = $routeTitle; 
    if (checkRouteTitleExist($routeTitle)>0) {
      array_push($_SESSION['error'], "Route Title already Exist.");

    }
  }

  

   
  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $createdBy = $_SESSION['userID'];
    $createdDate = date("Y-m-d h:i:s");
    $routeStatus = "A";
    
    $sql = "INSERT INTO `tbl_routes` (`route_title`,`route_status`,`createdBy`,`createdDate`)VALUES('$routeTitle','$routeStatus','$createdBy','$createdDate')";

      $result = mysqli_query($con,$sql);
      if ($result) {
        unsetSessions();
        $_SESSION['routeAddedSuccessfullyMsg'] = "Route Added Successfully";
        header("location:viewAllRoutes.php");
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
                     <h2>Add New Route</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Route Details
                            </div>
                            <form action="addNewRoute.php" method="POST">
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


                                    if(isset($_SESSION['routeTitle'])){
                                      $routeTitle = $_SESSION['routeTitle'];
                                    } 
                                    
                                ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Route Title</label>
                                        <input type="text" class="form-control" id="routeTitle" placeholder="Enter Route Title" name="routeTitle" value="<?php echo $routeTitle; ?>">
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
