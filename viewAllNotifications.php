<?php include ("includes/head.php"); ?>
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
                     <h2>View All Notifications Listing</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Notifications List
                            </div>
                            
                            <div class="panel-body">
                             <?php
                               $sql = "SELECT * FROM `tbl_notifications` WHERE `noti_for` = 'A' ORDER BY `noti_id` DESC";
                                $result = mysqli_query($con,$sql);
                                
                               if($result){
                                  if(mysqli_num_rows($result)>0){
                                    ?>
                                    <table id="NotificationsTbl" class="table table-bordered table-striped">
                                      <thead>
                                        <tr>
                                          <th>Sr.NO</th>
                                          <th>Title</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                         $srNO = 1;
                                         while($row = mysqli_fetch_assoc($result)){
                                          if ($row['noti_type'] == "UP") {
                                              $urlNoti = "userProfile.php?notiID=".$row['noti_id']."&userType=U&userID=".$row['noti_fk_id'];
                                            }
                                            if ($row['noti_type'] == "DP") {
                                              $urlNoti = "userProfile.php?notiID=".$row['noti_id']."&userType=D&userID=".$row['noti_fk_id'];
                                            }
                                            
                                          ?>
                                            <tr>
                                              <td class="align-middle"><?php echo $srNO; ?></td>
                                              <td class="align-middle"><?php echo $row['noti_title']; ?></td>
                                              
                                              <td class="align-middle">
                                                <a class="btn btn-success btn-xs" href="<?php echo $urlNoti; ?>">Details</a> 
                                              </td>
                                            </tr>
                                          <?php
                                          $srNO++;
                                         }
                                         ?>
                                      </tbody>
                                    </table>
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
    $("#NotificationsTbl").DataTable();
  });
</script>

<script type="text/javascript">
  function confDel(id){
    var conf = confirm("Are you sure to delete this Court?");
    if(conf){
      window.location.href="deleteCourt.php?courtID="+id;
    }
  }
</script>

</body>
</html>
