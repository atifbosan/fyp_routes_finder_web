<?php
include("includes/connection.php");
include("includes/functions.php");

if (isset($_GET['vehicleID'])) {
 $vehicleID = $_GET['vehicleID'];
 if (checkUserExistAgainstVehicleID($vehicleID) == 0) {
	 $sql = "DELETE FROM `tbl_vehicles` WHERE `vehicle_id` = '$vehicleID'";
	 $result = mysqli_query($con,$sql);
	 if($result){
	  $_SESSION['vehicleDeletedSuccessfullyMsg'] = "Vehicle Deleted Successfully";
	  header("location:viewAllVehicles.php");
	  exit();
	 } 	
 }else{
 	 $_SESSION['vehicleDeletedErrMsg'] = "First Delete All Users of this Vehicle, than delete this Vehicle";
	  header("location:viewAllVehicles.php");
	  exit();	
 }
 
}


 ?>