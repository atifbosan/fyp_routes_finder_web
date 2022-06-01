<?php
include("includes/connection.php");
include("includes/functions.php");

if (isset($_GET['userID']) && isset($_GET['userType'])) {
 $userID = $_GET['userID'];
 $userType = $_GET['userType'];
	

	 $sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$userID'";
	 $result = mysqli_query($con,$sql);
	 if($result){
	  $_SESSION['userDeletedSuccessfullyMsg'] = "User Deleted Successfully";
	  header("location:viewAllUsers.php?userType=".$userType);
	  exit();
	 } 	

 
}


 ?>