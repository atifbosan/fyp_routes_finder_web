<?php

function checkLogin(){
	if(isset($_SESSION['userID']) && $_SESSION['userID'] != "" && isset($_SESSION['userFullName']) && $_SESSION['userFullName'] != "" && isset($_SESSION['userType']) && $_SESSION['userType'] != "" && isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != "" ){
	    return true;
	}else{
	  return false;
	}
}

function checkUserType(){
  if(isset($_SESSION['userType']) && $_SESSION['userType'] != ""){
      return $_SESSION['userType'];
  } 
}

function getStatusTitle($status){
    if($status == 'P'){
      return "Pending";
    }else if($status == 'A'){
      return "Active";
    }else if($status == 'R'){
      return "Rejected";
    }else if($status == 'B'){
      return "Blocked";
    }else if ($status == 'C') {
      return "Cancle";
    }  
  }

   function getGenderTitle($gender){
    if($gender == 'F'){
      return "Female";
    }else if($gender == 'M'){
      return "Male";
    } 
  }

  function getAnnouncementforTitle($announcementfor){
    if($announcementfor == 'D'){
      return "Driver";
    }else if($announcementfor == 'U'){
      return "User";
    }else if($announcementfor == 'BDU'){
      return "Both";
    }  
  }

function checkCourtTitleExist($courtTitle,$courtID=''){
	global $con;
    $sql = "SELECT count(*) as tot FROM `tbl_courts` WHERE `court_title` = '$courtTitle' and `court_id` != '$courtID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}
function checkvehicleTitleExist($vehicleTitle,$vehicleID=""){
  global $con;
    $sql = "SELECT count(*) as tot FROM `tbl_vehicles` WHERE `vehicle_title` = '$vehicleTitle' and `vehicle_id` != '$vehicleID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}

function checkannouncementTitleExist($announcementTitle,$announcementID=""){
  global $con;
    $sql = "SELECT count(*) as tot FROM `tbl_announcement` WHERE `announcement_title` = '$announcementTitle' and `announcement_id` != '$announcementID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}

function checkUserEmailExist($userEmail,$userID= ""){
 global $con;
    $sql = "SELECT count(*) as tot FROM `tbl_users` WHERE `user_email` = '$userEmail' and `user_id` != '$userID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    } 
}
function checkUserCNICExist($userCNIC,$userID= ""){
 global $con;
    $sql = "SELECT count(*) as tot FROM `tbl_users` WHERE `user_cnic` = '$userCNIC' and `user_id` != '$userID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    } 
}


function getUserName($userID){
  global $con;
   $sql = "SELECT `user_fullName` FROM `tbl_users` WHERE `user_id` = '$userID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['user_fullName'];
    }
}

function getCityName($cityID){
  global $con;
   $sql = "SELECT `city` FROM `tbl_cities` WHERE `id` = '$cityID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['city'];
    }
}
function checkUserExistAgainstRouteID($routeID){
  global $con;
   $sql = "SELECT count(*) as tot FROM `tbl_users` WHERE `user_routeID` = '$routeID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}

function checkUserExistAgainstVehicleID($vehicleID){
  global $con;
   $sql = "SELECT count(*) as tot FROM `tbl_users` WHERE `user_vehicleID` = '$vehicleID'";
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
}




  function getTotalStats($tbl,$statusFiled="",$statusFieldValue="",$userTypeFiled="",$userTypeVal=""){
   global $con;
   if ($statusFiled == "" && $statusFieldValue == "" && $userTypeFiled == "" && $userTypeVal == "") {
    $sql = "SELECT count(*) as tot FROM `".$tbl."`"; 
   }else if($statusFiled == "" && $statusFieldValue == "" && $userTypeFiled != "" && $userTypeVal != ""){
      $sql = "SELECT count(*) as tot FROM `".$tbl."` WHERE `".$userTypeFiled."` = '$userTypeVal'"; 
   }else if($statusFiled != "" && $statusFieldValue != "" && $userTypeFiled != "" && $userTypeVal != ""){
      $sql = "SELECT count(*) as tot FROM `".$tbl."` WHERE `".$statusFiled."` = '$statusFieldValue' AND `".$userTypeFiled."` = '$userTypeVal'"; 
   }else {
     $sql = "SELECT count(*) as tot FROM `".$tbl."` WHERE `".$statusFiled."` = '$statusFieldValue'"; 
   }
   
    $result=mysqli_query($con,$sql);
    if($row=mysqli_fetch_assoc($result)){
      return $row['tot'];
    }
  } 

   
  function checkRouteTitleExist($routeTitle,$routeID=""){
    global $con;
      $sql = "SELECT count(*) as tot FROM `tbl_routes` WHERE `route_title` = '$routeTitle' and `route_id` != '$routeID'";
      $result=mysqli_query($con,$sql);
      if($row=mysqli_fetch_assoc($result)){
        return $row['tot'];
      }
  }

  function sendNotifications($notiTitle,$announcmentID,$notiFor){
  global $con;
  $createdBy = $_SESSION['userID'];
  $createdDate = date("Y-m-d h:i:s");
  if($notiFor == "D"){
    $sql = "SELECT * FROM `tbl_users` WHERE `user_type` = 'D'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)>0) {
      while ($row = mysqli_fetch_array($result)) {
        $userID = $row['user_id'];
        $sql1 = "INSERT INTO `tbl_notifications` (`noti_for`,`noti_forUserID`,`noti_title`,`noti_fk_id`,`noti_status`,`createdBy`,`createdDate`,`noti_type`) VALUES ('D','$userID','$notiTitle','$announcmentID','0','$createdBy','$createdDate','A')";
        $result1 = mysqli_query($con,$sql1);
      }
    }
  }else if($notiFor == "U"){
    $sql = "SELECT * FROM `tbl_users` WHERE `user_type` = 'U'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)>0) {
      while ($row = mysqli_fetch_array($result)) {
        $userID = $row['user_id'];
        $sql1 = "INSERT INTO `tbl_notifications` (`noti_for`,`noti_forUserID`,`noti_title`,`noti_fk_id`,`noti_status`,`createdBy`,`createdDate`,`noti_type`) VALUES ('U','$userID','$notiTitle','$announcmentID','0','$createdBy','$createdDate','A')";
        $result1 = mysqli_query($con,$sql1);
      }
    }
  }else if($notiFor == "BDU"){
    $sql = "SELECT * FROM `tbl_users` WHERE `user_type` = 'D'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)>0) {
      while ($row = mysqli_fetch_array($result)) {
        $userID = $row['user_id'];
        $sql1 = "INSERT INTO `tbl_notifications` (`noti_for`,`noti_forUserID`,`noti_title`,`noti_fk_id`,`noti_status`,`createdBy`,`createdDate`,`noti_type`) VALUES ('D','$userID','$notiTitle','$announcmentID','0','$createdBy','$createdDate','A')";
        $result1 = mysqli_query($con,$sql1);
      }
    }
    $sql = "SELECT * FROM `tbl_users` WHERE `user_type` = 'U'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result)>0) {
      while ($row = mysqli_fetch_array($result)) {
        $userID = $row['user_id'];
        $sql1 = "INSERT INTO `tbl_notifications` (`noti_for`,`noti_forUserID`,`noti_title`,`noti_fk_id`,`noti_status`,`createdBy`,`createdDate`,`noti_type`) VALUES ('U','$userID','$notiTitle','$announcmentID','0','$createdBy','$createdDate','A')";
        $result1 = mysqli_query($con,$sql1);
      }
    }

  } 
}


?>