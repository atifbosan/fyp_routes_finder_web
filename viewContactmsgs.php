<?php include ("includes/head.php"); ?>
<style type="text/css">
  .mail-body{    
    padding: 1em 2em;
    padding-top: 0px;
    border: 1px solid #D4D4D4;
    margin: 10px 0;
    transition: .5s all;
}
.mail-body>p{
  text-align: justify;
}
.mail-right {
    float: right;
    margin-left: 1.5em;
}
</style>
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

    <div id="wrapper">
        <?php include("includes/topNav.php"); ?>  
           <!-- /. NAV TOP  -->
            <?php include("includes/sidebar.php"); ?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>View All Contact Us Messages</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                    </div>
                     <div class="col-md-12 col-sm-12">
                       <div style="height: 500px; overflow-y: scroll;" class="widget-shadow">
                        <div class="panel">
                        <div class="inbox-page">
                         <h4>Contact us</h4>
                         <?php if (isset($_SESSION['deleteMsg'])) {
                           ?>
                           <div class="alert alert-success">
                             <?php echo $_SESSION['deleteMsg']; unset($_SESSION['deleteMsg']); ?>
                           </div>
                           <?php
                         } ?>
                         <?php 
                            $sql = "SELECT * FROM `tbl_contactus` ORDER BY `id` DESC"; 
                            $result = mysqli_query($con,$sql);
                            if ($result) {
                                if (mysqli_num_rows($result)>0) {
                                    $srNO = 1;
                                    ?>
                            <div style="height: 50px; padding: 10px;" class="panel-heading panelHeadBg">
                                <div class="mail col-lg-1 col-md-1"> <!-- <input type="checkbox" class="checkbox"> --> 
                                    <p style="line-height: 2px;">Sr.NO</p>
                                    </div>
                                    <div class="mail mail-name col-lg-2 col-md-2"> <p style="line-height: 2px;" class="text-center ">Subject</p> </div>
                                    <div class="mail col-lg-2 col-md-2"><p style="line-height: 2px;" class="text-center">Name/Email</p></div>
                                    <div  class="mail col-lg-2 col-md-2"><p style="line-height: 2px;" class="text-center">Phone No</p></div>
                                    <div style=" margin: auto; margin-left: 30px;" class="mail col-lg-2 col-md-2">
                                        <p style="line-height: 2px;" class="text-center">View Message</p>
                                    </div>
                                    <div style=" margin-left: 30px; " class="mail col-lg-2 col-md-2">
                                        <p style="line-height: 2px;" class="text-center">Date Time</p>
                                    </div>
                                    <div class="col-lg-1 col-md-1"></div>

                            </div>
                            <div class="clearfix"></div>
                            </div>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                $accordionID = $row['id'];
                                ?>
                                <div class="inbox-row widget-shadow" id="accordion<?php echo $accordionID; ?>" role="tablist" aria-multiselectable="true">
                                <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $accordionID; ?>" href="#collapseOne<?php echo $accordionID; ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $accordionID; ?>">
                                  
                                    <div class="mail col-lg-1 col-md-1"> <!-- <input type="checkbox" class="checkbox"> --> 

                                    <p style="line-height: 32px"><?php echo $srNO; ?></p>
                                    </div>
                                    <div class="mail mail-name col-lg-2 col-md-2"> <h6 style="line-height: 52px;"><?php echo $row['subject']; ?></h6> </div>
                                    <div class="mail mail-name col-lg-2 col-md-2"><p style="font-size: 15px;"><div><?php echo $row['name']; ?></div> <div> <?php echo $row['email']; ?></div></p></div>
                                    <div style=" margin: auto; margin-left: 30px;" class="mail mail-name col-lg-2 col-md-2"><p style="font-size: 15px;"class="text-center"><?php echo $row['phoneno']; ?></p></div>
                                    <div style=" margin: auto; padding-top:20px; " class="mail mail-name col-lg-2 col-md-2">
                                        <button onclick="changeContactusStatus(<?php echo $accordionID; ?>)"  class="btn btn-info btn-sm btn-block">View Message</button>
                                    </div>
                                    </a>
                                    <div class= "mail-right  col-lg-1 col-md-1">
                                        <i style="cursor: pointer;  float: right; position: relative;top: 30px;" onclick="confDel(<?php echo $accordionID; ?>)" class="fa fa-trash-o mail-icon"></i>    
                                    </div>
                                    <div class="mail mail-name col-lg-2 col-md-2"><div class="text-right" style="line-height: 32px; margin-top: -10px;"><?php 
                                    $createdTime=strtotime($row['createdTime']);
                                    $cDate =  date("d-m-Y", $createdTime); 
                                    $cTime =  date("h:i", $createdTime);
                                    echo $cDate; ?></div>
                                        <div class="text-right"><?php echo $cTime; ?></div>
                                    </div>
                                    <div class="clearfix"> </div>
                                    <div  id="collapseOne<?php echo $accordionID; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="mail-body">
                                            <p><?php echo $row['message']; ?></p>
                                            
                                        </div>
                                    </div>
                                </div>

                                <?php
                            $srNO++;
                            }
                        }else{
                            echo "No Record Found";
                        }
                    }
                    ?>
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

<script type="text/javascript">
  function confDel(id){
            var conf = confirm("Are You Sure to Delete this?");
            if (conf) {
                window.location.href= "deleteContactusMsg.php?id="+id;
            }
        }
</script>

</body>
</html>
