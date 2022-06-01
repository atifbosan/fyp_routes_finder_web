<?php include ("includes/head.php"); 

$routeTitle  = $routeStatus = "";

if (isset($_GET['routeID'])) {
  $routeID = $_GET['routeID'];
   $sql = "SELECT * FROM `tbl_routes` WHERE `route_id` = '$routeID'";
   $result = mysqli_query($con,$sql);
    if($result){
      if(mysqli_num_rows($result)>0){
        if (mysqli_num_rows($result)==1) {
          if ($row = mysqli_fetch_array($result)) {
            $routeTitle = $row['route_title'];
            $routeStatus = $row['route_status'];
           }
        }
      }
    }
 }

function unsetSessions(){
  unset($_SESSION['routeTitle']);
  unset($_SESSION['routeStatus']);

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
    if (checkRouteTitleExist($routeTitle,$routeID)>0) {
      array_push($_SESSION['error'], "Route Title already Exist.");

    }
  }


  if (empty($_POST['routeStatus'])) {
    array_push($_SESSION['error'], "Route Status is Required.");
  }else{
    $routeStatus = mysqli_real_escape_string($con,$_POST['routeStatus']);
    $_SESSION['routeStatus'] = $routeStatus; 
 
  }


   
  
  if (isset($_SESSION['error']) && count($_SESSION['error']) == 0) {
    $updatedBy = $_SESSION['userID'];
    $updatedDate = date("Y-m-d h:i:s");
   
    $sql = "UPDATE `tbl_routes`
              SET 
                `route_title` = '$routeTitle',
                `route_status` = '$routeStatus',
                `updatedBy` = '$updatedBy',
                `updatedDate` = '$updatedDate'
              WHERE `route_id` = '$routeID' ";
      $result = mysqli_query($con,$sql);
      if ($result) {
        unsetSessions();
        $_SESSION['routeAddedSuccessfullyMsg'] = "Route Updated Successfully";
        header("location:viewAllRoutes.php");
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
                     <h2>Edit Route Details</h2>   
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Route Details
                            </div>
                            <form action="editRoute.php?routeID=<?php echo $routeID; ?>" method="POST" >
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
                                    if(isset($_SESSION['routeStatus'])){
                                      $routeStatus = $_SESSION['routeStatus'];
                                    } 
                                    
                                ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Category Title</label>
                                        <input type="text" class="form-control" id="routeTitle" placeholder="Enter Category Title" name="routeTitle" value="<?php echo $routeTitle; ?>">
                                    </div>
                                    <div  class="form-group">
                                      <label>Category Status</label>

                                       <select  name="routeStatus" id="routeStatus" class="form-control select2">
                                          <option value="">Please Select</option>
                                          <option <?php if($routeStatus == "A"){echo "selected";} ?> value="A">Active</option>
                                          <option <?php if($routeStatus == "B"){echo "selected"; } ?> value="B">Block</option>
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
