<div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img src="<?php echo base_url();?>/assets/images/logo20.png" class="hidden-xs"/>
                 </a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 
					<?php
                    echo $this->session->userdata('logged_in')['username'];
					?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                	<?php if($this->session->userdata('admin')!='1'){ ?>
                   	<li><a href="<?php echo base_url(); ?>user/profile">Profile</a></li>
                    <li class="divider"></li>
                    <?php } ?>
                    
                    <li><a href="<?php echo base_url(); ?>logout"> Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
 
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#" target="_blank"><i class="glyphicon glyphicon-star"></i> Visit Site</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> Quick Links <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                        <li><a href="<?php echo base_url(); ?>shop/view_shops">View Shops</a></li>
                        <li><a href="<?php echo base_url(); ?>user/view_user">View Users</a></li>
                        <li><a href="<?php echo base_url(); ?>booking">View Bookings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                    </ul>
                </li>
                <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul>

        </div>
    </div>