<?php include ("includes/head.php"); ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="wrapper">
        <?php include("includes/topNav.php"); ?>  
           <!-- /. NAV TOP  -->
            <?php include("includes/sidebar.php"); ?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dashboard</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <h2 class="bg-color-red" style="margin-top: 0px; padding: 7px;"> Routes Stats</h2>
                    <div class="col-md-3 col-sm-6 col-xs-6"> 

                    <!--Box1-->          
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-blue set-icon">
                                <i style="font-size: 25px; " class="fa fa-map-marker"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_routes')." <span style='font-size: 13px;'>Route(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllRoutes.php">Total Routes</a></p>
                            </div>
                         </div>
                        <!--End Box1-->  

                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">  
                     <!--Box2--> 

                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-green set-icon">
                                <i style="font-size: 25px; " class="fa fa-map-marker"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_routes','route_status','A')." <span style='font-size: 13px;'>Route(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllRoutes.php?routestatus=A">Active Routes</a></p>
                            </div>
                         </div>


                         <!--END Box2--> 
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">   
                     <!--Box3-->         
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                <i style="font-size: 25px; " class="fa fa-map-marker"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_routes','route_status','B')." <span style='font-size: 13px;'>Route(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllRoutes.php?routestatus=B">Block routes</a></p>
                            </div>
                         </div>
                        <!--END Box3--> 
                    </div>
                </div>
        <!--Vehicle Stats Boxes--> 
                <div class="row">
                    <h2 class="bg-color-red" style="margin-top: 0px; padding: 7px;"> Vehicle Stats</h2>
                    <div class="col-md-3 col-sm-6 col-xs-6">

                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-blue set-icon">
                                <i style="font-size: 25px; " class="fa fa-bus"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_vehicles')." <span style='font-size: 13px;'>Vehicle(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllVehicles.php">Total <span style="font-size: 11px;">Vehicle</span></a></p>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-green set-icon">
                                <i style="font-size: 25px; " class="fa fa-bus"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_vehicles','vehicle_status','A')." <span style='font-size: 13px;'>Vehicle(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllVehicles.php?cateStatus=A">Active  <span style="font-size: 10.5px;">Vehicle</span></a></p>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                <i style="font-size: 25px; " class="fa fa-bus"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_vehicles','vehicle_status','B')." <span style='font-size: 13px;'>Vehicle(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllVehicles.php?cateStatus=B">Block  <span style="font-size: 11px;">Vehicle</span></a></p>
                            </div>
                         </div>
                    </div>
                </div>

<!--Drivers Stats Boxes--> 
                <div class="row">
                    <h2 class="bg-color-red" style="margin-top: 0px; padding: 7px;"> Drivers Stats</h2>
                    <div class="col-md-6">
                        <div class="col-md-3 col-sm-6 col-xs-6"> 
                        <!--Box1-->           
                            <div class="panel panel-back noti-box">
                                <span style="line-height: 55px;" class="icon-box bg-color-blue set-icon">
                                    <i style="font-size: 25px; " class="fa fa-users"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo getTotalStats('tbl_users','','','user_type','D')." <span style='font-size: 13px;'>Driver(s)</span>"; ?></p>
                                    <p class="text-muted"><a href="viewAllUsers.php?userType=D">Total <span style="font-size: 11px;">Drivers</span></a></p>
                                </div>
                             </div>
                              <!--END Box1-->  
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6"> 
                         <!--Box2-->            
                            <div class="panel panel-back noti-box">
                                <span style="line-height: 55px;" class="icon-box bg-color-green set-icon">
                                    <i style="font-size: 25px; " class="fa fa-users"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','A','user_type','D')." <span style='font-size: 13px;'>Driver(s)</span>"; ?></p>
                                    <p class="text-muted"><a href="viewAllUsers.php?userType=D&userStatus=A">Active  <span style="font-size: 10.5px;">Drivers</span></a></p>
                                </div>
                             </div>
                              <!--END Box2-->  
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6"> 
                         <!--Box3-->            
                            <div class="panel panel-back noti-box">
                                <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                    <i style="font-size: 25px; " class="fa fa-users"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','B','user_type','D')." <span style='font-size: 13px;'>Driver(s)</span>"; ?></p>
                                    <p class="text-muted"><a href="viewAllUsers.php?userType=D&userStatus=B">Block  <span style="font-size: 11px;">Drivers</span></a></p>
                                </div>
                             </div>
                              <!--END Box3-->  
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                         <!--Box4-->            
                            <div class="panel panel-back noti-box">
                                <span style="line-height: 55px;" class="icon-box bg-color-brown set-icon">
                                    <i style="font-size: 25px; " class="fa fa-users"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','P','user_type','D')." <span style='font-size: 13px;'>Driver(s)</span>"; ?></p>
                                    <p class="text-muted"><a href="viewAllUsers.php?userType=D&userStatus=P"><span style="font-size: 15px;">Pending</span>  <span style="font-size: 10px;">Drivers</span></a></p>
                                </div>
                             </div>
                              <!--END Box4--> 
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                         <!--Box5-->            
                            <div class="panel panel-back noti-box">
                                <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                    <i style="font-size: 25px; " class="fa fa-users"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','R','user_type','D')." <span style='font-size: 13px;'>Driver(s)</span>"; ?></p>
                                    <p class="text-muted"><a href="viewAllUsers.php?userType=D&userStatus=R"><span style="font-size: 15px;">Rejected</span>  <span style="font-size: 10px;">Drivers</span></a></p>
                                </div>
                             </div>
                              <!--END Box5--> 
                        </div>
                    </div>
                    <!--Driver Graph Chart-->
                    <div class="col-md-6">
                        <div id="myChart" style="width: 100%; height: 450px;"></div>
                    </div>
                </div>
<!--Users Stats Boxes--> 
                    <div class="row">
                    <h2 class="bg-color-red" style="margin-top: 0px; padding: 7px;"> Users Stats</h2>
                    <div class="col-md-6">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                    <!--Box 1-->          
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-blue set-icon">
                                <i style="font-size: 25px; " class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_users','','','user_type','U')." <span style='font-size: 13px;'>User(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllUsers.php?userType=U">Total <span style="font-size: 11px;">Users</span></a></p>
                            </div>
                         </div>
                           <!--END Box1-->  
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6"> 
                     <!--Box2-->            
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-green set-icon">
                                <i style="font-size: 25px; " class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','A','user_type','U')." <span style='font-size: 13px;'>User(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllUsers.php?userType=U&userStatus=A">Active  <span style="font-size: 10.5px;">Users</span></a></p>
                            </div>
                         </div>
                            <!--END Box2-->  
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                     <!--Box3-->             
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                <i style="font-size: 25px; " class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','B','user_type','U')." <span style='font-size: 13px;'>User(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllUsers.php?userType=U&userStatus=B">Block  <span style="font-size: 11px;">Users</span></a></p>
                            </div>
                         </div>
                         <!--END Box3--> 
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6">
                    <!--Box4-->            
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-brown set-icon">
                                <i style="font-size: 25px; " class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','P','user_type','U')." <span style='font-size: 13px;'>User(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllUsers.php?userType=U&userStatus=P"><span style="font-size: 15px;">Pending</span>  <span style="font-size: 10px;">Users</span></a></p>
                            </div>
                         </div>
                         <!--END Box4-->  
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-6">
                    <!--Box5-->             
                        <div class="panel panel-back noti-box">
                            <span style="line-height: 55px;" class="icon-box bg-color-red set-icon">
                                <i style="font-size: 25px; " class="fa fa-users"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo getTotalStats('tbl_users','user_status','R','user_type','U')." <span style='font-size: 13px;'>User(s)</span>"; ?></p>
                                <p class="text-muted"><a href="viewAllUsers.php?userType=U&userStatus=R"><span style="font-size: 15px;">Rejected</span>  <span style="font-size: 10px;">Users</span></a></p>
                            </div>
                         </div>
                          <!--END Box5-->    
                    </div>
                                </div>
                                <!---User Chart---->
                 <div class="col-md-6">
                        <div id="myUserChart" style="width: 100%; height: 450px;"></div>
                    </div>              
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <?php include("includes/footer.php"); ?>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawUserChart);

function drawUserChart() {
var pendingUser = activeUser = rejectedUser = blockedUser = 0;
<?php if(getTotalStats('tbl_users','user_status','P','user_type','U') > 0){
    ?>
    pendingUser = <?php echo getTotalStats('tbl_users','user_status','P','user_type','U'); ?>;
    <?php
} ?> 


<?php if(getTotalStats('tbl_users','user_status','A','user_type','U') > 0){
    ?>
    activeUser = <?php echo getTotalStats('tbl_users','user_status','A','user_type','U'); ?>;
    <?php
} ?> 


<?php if(getTotalStats('tbl_users','user_status','R','user_type','U') > 0){
    ?>
    rejectedUser = <?php echo getTotalStats('tbl_users','user_status','R','user_type','U'); ?>;
    <?php
} ?> 

<?php if(getTotalStats('tbl_users','user_status','B','user_type','U') > 0){
    ?>
    blockedUser = <?php echo getTotalStats('tbl_users','user_status','B','user_type','U'); ?>;
    <?php
} ?> 
var data = google.visualization.arrayToDataTable([
  ['Users', 'Stats'],
  ['Pending',pendingUser],
  ['Rejected',rejectedUser],
  ['Blocked',blockedUser],
  ['Active',activeUser]
]);

var options = {
  title:'Graphical View of Users Stats',
  is3D:true
};

var chart = new google.visualization.PieChart(document.getElementById('myUserChart'));
  chart.draw(data, options);
}
</script>


    <script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var pendingDrivers = activeDrivers = rejectedDrivers = blockedDrivers = 0;
<?php if(getTotalStats('tbl_users','user_status','P','user_type','D') > 0){
    ?>
    pendingDrivers = <?php echo getTotalStats('tbl_users','user_status','P','user_type','D'); ?>;
    <?php
} ?> 


<?php if(getTotalStats('tbl_users','user_status','A','user_type','D') > 0){
    ?>
    activeDrivers = <?php echo getTotalStats('tbl_users','user_status','A','user_type','D'); ?>;
    <?php
} ?> 


<?php if(getTotalStats('tbl_users','user_status','R','user_type','D') > 0){
    ?>
    rejectedDrivers = <?php echo getTotalStats('tbl_users','user_status','R','user_type','D'); ?>;
    <?php
} ?> 

<?php if(getTotalStats('tbl_users','user_status','B','user_type','D') > 0){
    ?>
    blockedDrivers = <?php echo getTotalStats('tbl_users','user_status','B','user_type','D'); ?>;
    <?php
} ?> 
var data = google.visualization.arrayToDataTable([
  ['Drivers', 'Stats'],
  ['Pending',pendingDrivers],

  ['Rejected',rejectedDrivers],
  ['Blocked',blockedDrivers],
  ['Active',activeDrivers]

]);

var options = {
  title:'Graphical View of Drivers Stats',
  is3D:true
};
var chart = new google.visualization.PieChart(document.getElementById('myChart'));
  chart.draw(data, options);
}
</script>



</body>
</html>
