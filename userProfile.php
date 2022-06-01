<?php include ("includes/head.php"); ?>
<?php 
$userType = $formHeading = "";
if (isset($_GET['notiID'])) {
 $notiID = $_GET['notiID'];
 $sqlNotiStatus = "UPDATE `tbl_notifications` SET `noti_status` = '1' WHERE `noti_status` = '0' AND `noti_id` = '$notiID'";
 mysqli_query($con,$sqlNotiStatus);
}
if (isset($_GET['userType']) && isset($_GET['userID']) && isset($_GET['status'])) {
$userType = $_GET['userType'];
  $userID = $_GET['userID'];
  $status = $_GET['status'];
  if ($userType == "D") {
    $formHeading = "Driver";
  }
  if ($userType == "U") {
    $formHeading = "User";
  }

  $updatedBy = $_SESSION['userID'];
  $updatedDate = date("Y-m-d h:i:s");

  $sqlUserStatus = "UPDATE `tbl_users` SET `user_status` = '$status',`updatedBy`='$updatedBy',`updatedDate`='$updatedDate' WHERE `user_id` = '$userID'";
  $resultUserStatus = mysqli_query($con,$sqlUserStatus);
  if ($resultUserStatus) {
    $_SESSION['statusUpdate'] = $formHeading." Profile status has been updated successfully.";
    header("location:userProfile.php?userType=".$userType."&userID=".$userID);
    exit();
  }
}
if (isset($_GET['userType']) && isset($_GET['userID'])) {
  $userType = $_GET['userType'];
  $userID = $_GET['userID'];
  if ($userType == "D") {
    $formHeading = "Driver";
    $whereClause = "WHERE `tbl_users`.`user_type` = '$userType' AND `tbl_users`.`user_id` = '$userID'";
   $sql = "SELECT `tbl_users`.`user_id` ,`tbl_users`.`user_contactNo`,`tbl_users`.`user_address` ,`tbl_users`.`user_type`, `tbl_users`.`user_fullName`, `tbl_users`.`user_cnic`, `tbl_users`.`user_email`, `tbl_users`.`user_contactNo`,`tbl_users`.`user_gender`,`tbl_users`.`user_cityID`,`tbl_users`.`user_status`,`tbl_users`.`user_profileImage`,`tbl_users`.`user_routeID`,`tbl_users`.`user_vehicleID` ,`tbl_vehicles`.`vehicle_title`,`tbl_routes`.`route_title`,`tbl_cities`.`city`  FROM `tbl_users` 
    INNER JOIN `tbl_vehicles` ON `tbl_users`.`user_vehicleID` = `tbl_vehicles`.`vehicle_id` 
    INNER JOIN `tbl_routes` ON `tbl_users`.`user_routeID` = `tbl_routes`.`route_id`
     INNER JOIN `tbl_cities` ON `tbl_users`.`user_cityID` = `tbl_cities`.`id` ".$whereClause."
    ORDER BY `tbl_users`.`user_id` DESC" ;

                                  
  }else if($userType == "U"){
    $formHeading = "User";
    $whereClause = "WHERE `tbl_users`.`user_type` = '$userType' AND `tbl_users`.`user_id` = '$userID'";
   $sql = "SELECT `tbl_users`.`user_id` ,`tbl_users`.`user_contactNo`,`tbl_users`.`user_address` ,`tbl_users`.`user_type`, `tbl_users`.`user_fullName`, `tbl_users`.`user_cnic`, `tbl_users`.`user_email`, `tbl_users`.`user_contactNo`,`tbl_users`.`user_gender`,`tbl_users`.`user_cityID`,`tbl_users`.`user_status`,`tbl_users`.`user_profileImage`,`tbl_cities`.`city`  FROM `tbl_users` 
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
                     <h2> <?php if ($formHeading !="") { echo $formHeading; } ?> Profile</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                <?php if ($formHeading !="") { echo $formHeading; } ?> Details
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
                                if (isset($_SESSION['statusUpdate'])) {
                                  ?>
                                  <div class="alert alert-success">
                                    <?php echo $_SESSION['statusUpdate'];
                                      unset($_SESSION['statusUpdate']);
                                     ?>
                                  </div>
                                  <?php
                                }

                                $result = mysqli_query($con,$sql);
                                if($result){
                                  if(mysqli_num_rows($result)>0){
                                    if ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <ul class="list-group">
                                       <li style="height: 100px" class="list-group-item"><?php echo $formHeading; ?> Image <a href="javascript:;" class="pull-right"><?php if($row['user_profileImage'] != "" && file_exists($row['user_profileImage'])){ ?> <img style="width: 70px; height: 70px; display: block; margin: auto;"  src="<?php echo $row['user_profileImage']; ?>"><?php }else{ echo "N/A"; }  ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> Name <a href="javascript:;" class="pull-right"><?php echo $row['user_fullName']; ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> Email <a href="javascript:;" class="pull-right"><?php echo $row['user_email']; ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> CNIC <a href="javascript:;" class="pull-right"><?php echo $row['user_cnic']; ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> City <a href="javascript:;" class="pull-right"><?php echo $row['city']; ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> Address <a href="javascript:;" class="pull-right"><?php echo $row['user_address']; ?></a></li>
                                      <li class="list-group-item"><?php echo $formHeading; ?> Phone No <a href="javascript:;" class="pull-right"><?php echo $row['user_contactNo']; ?></a></li>

                                      <li class="list-group-item"><?php echo $formHeading; ?> Gender <a href="javascript:;" class="pull-right"><?php echo getGenderTitle($row['user_gender']); ?></a></li>

                                      <?php if ($userType == "D") {
                                        ?>
                                        <li class="list-group-item"><?php echo $formHeading; ?> Route <a href="javascript:;" class="pull-right"><?php echo $row['route_title']; ?></a></li>

                                        <li class="list-group-item"><?php echo $formHeading; ?> Vehicle <a href="javascript:;" class="pull-right"><?php echo $row['vehicle_title']; ?></a></li>


                                        

                                        <?php
                                      } ?>
                                      

                                         <li style="height: 50px;" class="list-group-item"><?php echo $formHeading; ?> Status (<?php echo getStatusTitle($row['user_status']); ?>)<?php if($row['user_status'] == "P"){  ?><a href="userProfile.php?userType=<?php echo $userType; ?>&userID=<?php echo $userID; ?>&status=A" class="pull-right btn btn-sm btn-success">Approve</a> <a style="margin-right: 10px;" href="userProfile.php?userType=<?php echo $userType; ?>&userID=<?php echo $userID; ?>&status=R" class="pull-right btn btn-sm btn-danger">Reject</a> <?php } ?>

                                          <?php if($row['user_status'] == "R" || $row['user_status'] == "B" ){  ?><a href="userProfile.php?userType=<?php echo $userType; ?>&userID=<?php echo $userID; ?>&status=A" class="pull-right btn btn-sm btn-success">Approve/Active</a>  <?php } ?>

                                           <?php if($row['user_status'] == "A" ){  ?><a href="userProfile.php?userType=<?php echo $userType; ?>&userID=<?php echo $userID; ?>&status=B" class="pull-right btn btn-sm btn-danger">Block</a>  <?php } ?>

                                       </li>
                                    </ul>
                                     <?php
                                   }
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
</script>

</body>
</html>
