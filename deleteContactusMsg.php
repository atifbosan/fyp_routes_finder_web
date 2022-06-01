<?php 
include ("includes/connection.php");
include ("includes/function.php");
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = "DELETE FROM `tbl_contactus`  WHERE  `id` = '$id'";
	$result = mysqli_query($con,$sql);

	
	if($result){
		$_SESSION['deleteMsg'] = "Message Deleted Successfully";
		header("location:viewContactmsgs.php");
		exit();		 
	}
}
?>
