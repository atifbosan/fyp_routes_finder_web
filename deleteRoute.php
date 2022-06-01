<?php
include("includes/connection.php");
include("includes/functions.php");

if (isset($_GET['routeID'])) {
 $routeID = $_GET['routeID'];
 if (checkUserExistAgainstRouteID($routeID) == 0) {
	 $sql = "DELETE FROM `tbl_routes` WHERE `route_id` = '$routeID'";
	 $result = mysqli_query($con,$sql);
	 if($result){
	  $_SESSION['routeDeletedSuccessfullyMsg'] = "Route Deleted Successfully";
	  header("location:viewAllRoutes.php");
	  exit();
	 } 	
 }else{
 	 $_SESSION['routeDeletedErrMsg'] = "First Delete All Drivers of this Route, than delete this Route";
	  header("location:viewAllRoutes.php");
	  exit();	
 }
 
}


 ?>