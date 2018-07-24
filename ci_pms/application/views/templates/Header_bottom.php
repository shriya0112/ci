<div class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="<?php echo base_url('index.php/pms/home'); ?>" class="active">Home</a></li>
                <li class="dropdown"><a>My Account<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="<?php echo base_url('index.php/pms/show'); ?>">My Profile</a></li>
                    <li><a href="change_password.php">Change Password</a></li> 
                    <li><a href="<?php echo base_url('index.php/pms/logout'); ?>">Logout</a></li> 
                  </ul>
                </li> 
                <li class="dropdown"><a href="#">Category<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="<?php echo base_url('index.php/pms/cadd'); ?>">Add New</a></li>
                    <li><a href="<?php echo base_url('index.php/pms/call'); ?>">View All</a></li>
                  </ul>
                </li> 
                <li class="dropdown"><a href="#">Sub-Category<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="<?php echo base_url('index.php/pms/scadd'); ?>">Add New</a></li>
                    <li><a href="<?php echo base_url('index.php/pms/scall'); ?>">View All</a></li>
                    
                  </ul>
                </li> 
                <li class="dropdown"><a href="#">Product<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><a href="<?php echo base_url('index.php/pms/padd'); ?>">Add New</a></li>
                    <li><a href="<?php echo base_url('index.php/pms/pall'); ?>">View All</a></li>
                  </ul>
                </li> 
                <li><a href="<?php echo base_url('index.php/pms/logout'); ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
              <input type="text" placeholder="Search"/>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
