<?php include ("includes/head.php"); ?>
<?php 
$userType = $formHeading = "";
if (isset($_GET['notiID'])) {
 $notiID = $_GET['notiID'];
 $sqlNotiStatus = "UPDATE `tbl_notifications` SET `noti_status` = '1' WHERE `noti_status` = '0' AND `noti_id` = '$notiID'";
 mysqli_query($con,$sqlNotiStatus);
}

if (isset($_GET['contactUsID']) ) {
  $contactUsID = $_GET['contactUsID'];
 
    $formHeading = "Contact Us";
   $sql = "SELECT * FROM `tbl_contactus` WHERE `id` = '$contactUsID'" ;
  
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
                     <h2> <?php if ($formHeading !="") { echo $formHeading; } ?></h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                <?php if ($formHeading !="") { echo $formHeading; } ?> Details
                            </div>
                            
                            <div class="panel-body">
                              <?php 
                                $result = mysqli_query($con,$sql);
                                if($result){
                                  if(mysqli_num_rows($result)>0){
                                    if ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <ul class="list-group">
                                       
                                      <li class="list-group-item"> Subject <a href="javascript:;" class="pull-right"><?php echo $row['subject']; ?></a></li>
                                      <li class="list-group-item"> Name <a href="javascript:;" class="pull-right"><?php echo $row['name']; ?></a></li>
                                      <li class="list-group-item"> Email <a href="javascript:;" class="pull-right"><?php echo $row['email']; ?></a></li>
                                      <li class="list-group-item"> Phone # <a href="javascript:;" class="pull-right"><?php echo $row['phoneno']; ?></a></li>
                                      
                                      <li class="list-group-item"> Date & Time <a href="javascript:;" class="pull-right">
                                      <?php 
                                        $createdTime=strtotime($row['createdTime']);
                                        $cDate =  date("d-m-Y", $createdTime); 
                                        $cTime =  date("h:i", $createdTime);
                                        echo $cDate." | ".$cTime; 
                                      ?>
                                      </a></li>
                                      
                                        
                                        
                                      <li style="min-height: 150px; " class="list-group-item"> Description <a href="javascript:;" class="pull-right text-justify"><?php echo $row['message']; ?></a></li>

                                        
                                         
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
