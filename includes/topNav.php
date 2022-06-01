<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin Area</a> 
    </div>


    <div style="color: white;padding: 15px 50px 5px 50px;float: right; font-size: 16px;">Welcome <b> 


        <?php echo $_SESSION['userFullName']; ?></b> &nbsp; 
        <?php 
        $sqlNoti = "SELECT * FROM `tbl_notifications` WHERE `noti_status` = '0' AND `noti_for` = 'A' ORDER BY `noti_id` DESC";
        $resultNoti = mysqli_query($con,$sqlNoti);
        $totNoti = mysqli_num_rows($resultNoti);

        ?>
        <div class="btn-group">
          <button type="button" class="btn btn-danger dropdown-toggle square-btn-adjust" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell" aria-hidden="true"></i> <?php if($totNoti > 0){ ?><span class="badge badge-warning"><?php echo $totNoti; ?></span><?php } ?>
          </button>
          
          <ul id="notification" class="dropdown-menu" style="width: 180px; height: auto; overflow-x: hidden; overflow-y: scroll;"> 
              <?php while ($rowNoti = mysqli_fetch_array($resultNoti)) { 
                if ($rowNoti['noti_type'] == "UP") {
                  $urlNoti = "userProfile.php?notiID=".$rowNoti['noti_id']."&userType=U&userID=".$rowNoti['noti_fk_id'];
                }
                if ($rowNoti['noti_type'] == "DP") {
                  $urlNoti = "userProfile.php?notiID=".$rowNoti['noti_id']."&userType=D&userID=".$rowNoti['noti_fk_id'];

                }

               ?>
                <li class="dropdown-item"><p style="word-break: break-all; padding:15px; padding-top: 5px; line-height: 20px;"><a style="font-size: 10px; color: #c90000; "  href="<?php echo $urlNoti; ?>"><i class="fa fa-check"></i> &nbsp;<?php echo $rowNoti['noti_title']; ?></a></p></li>
              <hr style="margin:0px;">
             <?php } ?>
               <li class="dropdown-item"><p style="word-break: break-all; padding:15px; padding-top: 5px; line-height: 20px;"><a style="font-size: 10px; color: #c90000; "  href="viewAllNotifications.php"><i class="fa fa-check"></i> &nbsp;View All Notifications</a></p></li>
              
              

          </ul>
        </div>

        <a href="logout.php"  class="btn btn-danger square-btn-adjust"> <i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a> 



    </div>

</nav> 