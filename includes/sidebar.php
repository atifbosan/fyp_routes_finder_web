<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
		    <li class="text-center">
                <img src="assets/img/find_user.png" class="user-image img-responsive"/>
			</li>
		
			
            <li>
                <a  href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li <?php if($pageName == 'addNewRoute.php' || $pageName == 'viewAllRoutes.php' || $pageName == 'editRoute.php' ){ ?> class="active" <?php } ?>>
                <a href="javascript:;"><i class="fa fa-map-marker" aria-hidden="true"></i> Routes <small>Managment</small><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if($pageName == 'addNewRoute.php' || $pageName == 'viewAllRoutes.php' || $pageName == 'editRoute.php' ){ echo 'collapse in'; } ?>">
                    <li>
                        <a href="addNewRoute.php">Add New Route</a>
                    </li>
                    <li>
                        <a href="viewAllRoutes.php">View All Route</a>
                    </li>
                   
                </ul>
              </li>
              
           	  <li <?php if($pageName == 'addNewVehicle.php' || $pageName == 'viewAllVehicles.php' || $pageName == 'editVehicle.php' ){ ?> class="active" <?php } ?>>
                <a href="javascript:;"><i class="fa fa-bus" aria-hidden="true"></i> Vehicle <small> Managment </small> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if($pageName == 'addNewVehicle.php' || $pageName == 'viewAllVehicles.php' || $pageName == 'editVehicle.php' ){ echo 'collapse in'; } ?>">
                    <li>
                        <a href="addNewVehicle.php">Add New Vehicle</a>
                    </li>
                    <li>
                        <a href="viewAllVehicles.php">View All Vehicles</a>
                    </li>
                   
                </ul>
              </li>


              <li <?php if( $pageName == 'viewAllUsers.php' || $pageName == 'userProfile.php' ){ ?> class="active" <?php } ?>>
                <a href="javascript:;"><i class="fa fa-users" aria-hidden="true"></i> Users <small> Managment </small> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if( $pageName == 'viewAllUsers.php' || $pageName == 'userProfile.php' ){ echo 'collapse in'; } ?>">
                    
                    <li>
                        <a href="viewAllUsers.php?userType=D">View All Driver</a>
                    </li>
                    
                     <li>
                        <a href="viewAllUsers.php?userType=U">View All Users</a>
                    </li>
                   
                </ul>
              </li>



              <li <?php if($pageName == 'addNewAnnouncement.php' || $pageName == 'viewAllAnnouncements.php' || $pageName == 'editAnnouncement.php' ){ ?> class="active" <?php } ?>>
                <a href="javascript:;"><i class="fa fa-bullhorn" aria-hidden="true"></i> Announcement <small> Managment </small> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level <?php if($pageName == 'addNewAnnouncement.php' || $pageName == 'viewAllAnnouncements.php' || $pageName == 'editAnnouncement.php' ){ echo 'collapse in'; } ?>">
                    <li>
                        <a href="addNewAnnouncement.php">Add New Announcement</a>
                    </li>
                    <li>
                        <a href="viewAllAnnouncements.php">View All Announcements</a>
                    </li>
                   
                </ul>
              </li>



               
        </ul>
       
    </div>

</nav>