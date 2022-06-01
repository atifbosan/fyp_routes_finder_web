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
                     <h2>View All Announcements Listing</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="panel">
                            <div class="panel-heading panelHeadBg">
                                Announcements List
                            </div>
                            
                            <div class="panel-body">
                              <?php 
                                if (isset($_SESSION['announcementAddedSuccessfullyMsg'])) {
                                  ?>
                                  <div class="alert alert-success">
                                    <?php 
                                      echo $_SESSION['announcementAddedSuccessfullyMsg']; 
                                      unset($_SESSION['announcementAddedSuccessfullyMsg']);
                                    ?>
                                  </div>
                                  <?php
                                }
                                  if (isset($_SESSION['announcementDeletedSuccessfullyMsg'])) { ?>

                                  <div class="alert alert-success">
                                    <?php 
                                      echo $_SESSION['announcementDeletedSuccessfullyMsg']; 
                                      unset($_SESSION['announcementDeletedSuccessfullyMsg']);
                                    ?>
                                  </div>
                                    <?php
                                  }
                                    if (isset($_SESSION['announcementDeletedErrMsg'])) {
                                      ?>
                                      <div class="alert alert-danger">
                                        <?php 
                                        echo $_SESSION['announcementDeletedErrMsg'];
                                        unset($_SESSION['announcementDeletedErrMsg']);
                                        ?>
                                      </div>
                                      <?php
                                    }

                                 $whereAnnouncementStatus = "";
                                 if (isset($_GET['announcementStatus'])) {
                                      $announcementStatus = $_GET['announcementStatus'];
                                      $whereAnnouncementStatus = " WHERE `announcement_status` = '$announcementStatus'";
                                    }   
                                
                                $sql = "SELECT * FROM `tbl_announcement` ".$whereAnnouncementStatus."  ORDER BY `announcement_id` DESC"; 
                                $result = mysqli_query($con,$sql);
                                if($result){
                                  if(mysqli_num_rows($result)>0){
                                    ?>
                                    <table id="announcementTbl" class="table table-bordered table-striped">
                                      <thead>
                                        <tr>
                                          <th>Sr.NO</th>
                                          <th>Name</th>
                                          <th>Announcement For</th>
                                          <th>Description</th>
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
                                              <td class="align-middle"><?php echo $row['announcement_title']; ?></td>
                                          
                                              <td class="align-middle"><?php echo getAnnouncementforTitle($row['announcement_for']); ?></td>
                                              <td class="align-middle"><?php echo $row['announcement_description']; ?></td>
                                              
                                              <td class="align-middle"><?php echo getStatusTitle($row['announcement_status']); ?></td>
                                              <td class="align-middle">
                                                <a class="btn btn-success btn-xs" href="editAnnouncement.php?announcementID=<?php echo $row['announcement_id']; ?>">Edit</a> 
                                                <a onclick="confDel(<?php echo $row['announcement_id']; ?>);" class="btn btn-danger btn-xs" href="javascript:;">Delete</a>
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
    $("#announcementTbl").DataTable();
  });
</script>
<script type="text/javascript">
  function confDel(id){
    var conf = confirm("Are you sure to delete this Announcments?");
    if(conf){
      window.location.href="deleteAnnouncement.php?announcementID="+id;
    }
  }
</script>

</body>
</html>
