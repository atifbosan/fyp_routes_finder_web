<?php include ("includes/head.php"); ?>
<?php 
$userType = $formHeading = $userStatus = $whereUserStatus = "";
if (isset($_GET['userStatus'])) {
  $userStatus =$_GET['userStatus'];
  $whereUserStatus = " AND `tbl_users`.`user_status` = '$userStatus'";
}

if (isset($_GET['userType'])) {
  $userType = $_GET['userType'];
  if ($userType == "D") {
    $formHeading = "Driver";
    $whereClause = "WHERE `tbl_users`.`user_type` = '$userType' ".$whereUserStatus;
   $sql = "SELECT `tbl_users`.`user_id` ,`tbl_users`.`user_type`, `tbl_users`.`user_fullName`, `tbl_users`.`user_cnic`, `tbl_users`.`user_email`, `tbl_users`.`user_contactNo`,`tbl_users`.`user_gender`,`tbl_users`.`user_cityID`,`tbl_users`.`user_status`,`tbl_users`.`user_profileImage`,`tbl_users`.`user_vehicleID`,`tbl_users`.`user_routeID` ,`tbl_routes`.`route_title`,`tbl_vehicles`.`vehicle_title`,`tbl_cities`.`city`  FROM `tbl_users` 
    INNER JOIN `tbl_routes` ON `tbl_users`.`user_routeID` = `tbl_routes`.`route_id` 
    INNER JOIN `tbl_vehicles` ON `tbl_users`.`user_vehicleID` = `tbl_vehicles`.`vehicle_id`
     INNER JOIN `tbl_cities` ON `tbl_users`.`user_cityID` = `tbl_cities`.`id` ".$whereClause."
    ORDER BY `tbl_users`.`user_id` DESC" ;

                                  
  }else if($userType == "U"){
    $formHeading = "User";
     $whereClause = "WHERE `tbl_users`.`user_type` = '$userType' ".$whereUserStatus;
   $sql = "SELECT `tbl_users`.`user_id` ,`tbl_users`.`user_type`, `tbl_users`.`user_fullName`, `tbl_users`.`user_cnic`, `tbl_users`.`user_email`, `tbl_users`.`user_contactNo`,`tbl_users`.`user_gender`,`tbl_users`.`user_cityID`,`tbl_users`.`user_status`,`tbl_users`.`user_profileImage`,`tbl_cities`.`city`  FROM `tbl_users` 
     INNER JOIN `tbl_cities` ON `tbl_users`.`user_cityID` = `tbl_cities`.`id` ".$whereClause."
    ORDER BY `tbl_users`.`user_id` DESC" ;
  }
}
?>
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <div id="wrapper">
        <?php include("includes/topNav.php"); ?>  
           <!-- /. NAV TOP  -->
            <?php include("includes/sidebar.php"); ?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>View All <?php if ($formHeading !="") { echo $formHeading; } ?> Listing</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                <?php if ($formHeading !="") { echo $formHeading; } ?> List
                            </div>
                            
                            <div class="panel-body">
                              <?php 
                                if (isset($_SESSION['userAddedSuccessfullyMsg'])) {
                                  ?>
                                  <div class="alert alert-success">
                                    <?php 
                                      echo $_SESSION['userAddedSuccessfullyMsg']; 
                                      unset($_SESSION['userAddedSuccessfullyMsg']);
                                    ?>
                                  </div>
                                  <?php
                                }
                                if (isset($_SESSION['userDeletedSuccessfullyMsg'])) {
                                  ?>
                                  <div class="alert alert-success">
                                    <?php 
                                    echo  $_SESSION['userDeletedSuccessfullyMsg'];
                                    unset($_SESSION['userDeletedSuccessfullyMsg']);
                                    ?>
                                  </div>
                                  <?php
                                }

                                if (isset($_SESSION['userDeletedErrMsg'])) {
                                  ?>
                                  <div class="alert alert-danger">
                                    <?php 
                                    echo  $_SESSION['userDeletedErrMsg'];
                                    unset($_SESSION['userDeletedErrMsg']);
                                    ?>
                                  </div>
                                  <?php
                                }

                                $result = mysqli_query($con,$sql);
                                if($result){
                                  if(mysqli_num_rows($result)>0){
                                    ?>
                                    <table id="courtsTbl" class="table table-bordered table-striped">
                                      <thead>
                                        <tr>
                                          <th>Sr.NO</th>
                                          <th>Image</th>
                                          <th>Name</th>
                                          <th>City</th>
                                          <?php if ($userType == "D") { ?>
                                            <th>Route Name</th>
                                            <th>Vehicle Name</th>
                                          <?php } ?> 
                                          
                                          <th>Status</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                         $srNO = 1;
                                         while($row = mysqli_fetch_assoc($result)){
                                          ?>
                                            <tr>
                                              <td class="align-middle"><?php echo $srNO; ?></td>
                                              <td class="align-middle"><?php if($row['user_profileImage'] != "" && file_exists($row['user_profileImage'])){ ?> <img style="width: 70px; height: 70px; display: block; margin: auto;"  src="<?php echo $row['user_profileImage']; ?>"><?php }else{ echo "N/A"; }  ?></td>
                                              <td class="align-middle"><?php echo $row['user_fullName']; ?></td>
                                              <td class="align-middle"><?php echo $row['city']; ?></td>
                                              <?php if ($userType == "D") { ?>
                                          
                                                <td class="align-middle"><?php echo $row['route_title']; ?></td>
                                                <td class="align-middle"><?php echo $row['vehicle_title']; ?></td>
                                              <?php } ?>    
                                              
                                              <td class="align-middle"><?php echo getStatusTitle($row['user_status']); ?></td>
                                              
                                              <td class="align-middle">
                                                <div align="center" style="margin-bottom: 5px;">
                                                  <a  class="btn btn-info btn-xs btn-block " href="userProfile.php?userID=<?php echo $row['user_id']; ?>&userType=<?php echo $row['user_type']; ?>">View Profile</a>  
                                                </div>
                                                 <div align="center" style="margin-bottom: 5px;">
                                                

                                                 
                                                  <a onclick="confDel(<?php echo $row['user_id']; ?>,'<?php echo $userType; ?>');" class="btn btn-danger btn-block btn-xs" href="javascript:;">Delete</a>
                                                </div>
                                              </td>
                                            </tr>
                                          <?php
                                          $srNO++;
                                         }
                                         ?>
                                      </tbody>
                                    </table>
                                     <?php
                                  }else{
                                    ?>
                                    <div class="alert alert-info">No Record Found</div>
                                    <?php
                                  }
                                }
                              ?>
                            </div>
                                                            
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
    <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#courtsTbl").DataTable();
  });

var userTitle = "<?php echo $formHeading; ?>";

function confDel(userID,userType){
  var conf = confirm("Are You Sure to delete this "+userTitle);
  if (conf) {
    window.location.href="deleteUser.php?userID="+userID+"&userType="+userType;
  }
}
</script>



</body>
</html>
