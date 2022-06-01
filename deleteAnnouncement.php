<?php
include("includes/connection.php");
include("includes/functions.php");

if (isset($_GET['announcementID'])) {
 $announcementID = $_GET['announcementID'];

 	$sqlNotiDel = "DELETE FROM `tbl_notifications` WHERE `noti_fk_id` = '$announcementID'";
	$resultNotiDel = mysqli_query($con,$sqlNotiDel);
	if ($resultNotiDel) {
	 	 $sql = "DELETE FROM `tbl_announcement` WHERE `announcement_id` = '$announcementID'";
		 $result = mysqli_query($con,$sql);
		 if($result){
		  $_SESSION['announcementDeletedSuccessfullyMsg'] = "Announcement Deleted Successfully";
		  header("location:viewAllAnnouncements.php");
		  exit();
		 } 
	 	} 	

	 	
 }
 ?>