<?php  
     $menu = $this->session->userdata('admin');
      // $menu = $this->session->set_userdata('logged_in');
// echo  $menu;
//exit;
?>

<div class="col-sm-2 col-lg-2 admin-menu">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main Menu</li>
                        <li><a class="ajax-link" href="<?php echo base_url(); ?>dashboard"><i class="glyphicon glyphicon-dashboard"></i><span> Dashboard</span></a> </li>
                        
                       <!-- <div class="admin-menu">-->
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-briefcase"></i><span> Shops</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url(); ?>shop/add_shop">Add Shop</a></li>
                                <li><a href="<?php echo base_url(); ?>shop/view_shops">View Shop</a></li>
         	                       <li><a href="<?php echo base_url(); ?>shop/assign_service">Assign service </a></li>
                            </ul>
                        </li>
                       <?php
                       if( $menu==1  )
                        {
                       ?>
                        
                        <li>
                            <a href="<?php echo base_url(); ?>service/"><i class="glyphicon glyphicon-list-alt"></i><span> Services</span></a>
                        </li>
                        
                       <?php
						} 
						?>
						
                        <li>
                            <a href="<?php echo base_url(); ?>shop/gallery"><i class="glyphicon glyphicon-picture"></i><span> Gallery</span></a>
                        </li>
                        
                         <?php 
						if( $menu==1 )
                        {
						?>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-certificate"></i><span> Customers</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url(); ?>customer/add_customer">Add Customer</a></li>
                                <li><a href="<?php echo base_url(); ?>customer/view_customer">View Customers</a></li>
                            </ul>
                        </li>
                        
                      
                        <li><a class="ajax-link" href="<?php echo base_url(); ?>user/view_user"><i class="glyphicon glyphicon-user"></i><span> Users</span></a> </li>
                        <?php
						}
						?>
                        
                        <li><a class="ajax-link" href="<?php echo base_url(); ?>booking"><i class="glyphicon glyphicon-book"></i><span> Bookings</span></a> </li>
                        <li><a class="ajax-link" href="<?php echo base_url(); ?>review"><i class="glyphicon glyphicon-list"></i><span> Reviews</span></a> </li>
                       <?php 
						if( $menu==1  )
                        {
						?>
                        <li class="accordion">
                        	<a href="#"><i class="glyphicon glyphicon-fire"></i><span> Trending</span></a> 
                        	<ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url(); ?>trend/add_trend">Add Trend</a></li>
                                <li><a href="<?php echo base_url(); ?>trend/view_trend">View Trends</a></li>
                            </ul>
                        </li>
                         
                         <li class="accordion">
                        	<a href="#"><i class="glyphicon glyphicon-cog"></i><span> Settings</span></a> 
                        	<ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url();?>settings/home_slider">Home Slider</a></li>
                                <li><a href="<?php echo base_url(); ?>settings/cycle_slider">Cycle Slider</a></li>
                                <li><a href="<?php echo base_url(); ?>settings/whats_new">Whats New</a></li>
                            </ul>
                        </li>
                         
                        <li>
                        	<a href="<?php echo base_url();?>ad"><i class="glyphicon glyphicon-bell"></i><span> Ads</span></a> 
                        </li>

                        
                        <li class="accordion">

                         <li class="accordion">

                        	<a href="#"><i class="glyphicon glyphicon-stats"></i><span> Testimonials</span></a> 
                        	<ul class="nav nav-pills nav-stacked">
                                <li><a href="<?php echo base_url();?>testimonials/add_testimonials">Add Testimonials</a></li>
                                <li><a href="<?php echo base_url(); ?>testimonials/view_testimonials">View Testimonials</a></li>
                            </ul>
                        </li>  

                        

   <?php
 }
?>                       
                        <li>
                        	<a href="<?php echo base_url();?>offers"><i class="glyphicon glyphicon-tags"></i><span> Offers</span></a> 
                        	<ul class="nav nav-pills nav-stacked">
                            </ul>
                        </li> 
                          <?php 
                        if( $menu==1  )
                        {
                        ?>
                         <li><a class="ajax-link" href="<?php echo base_url(); ?>Websiteinfo"><i class="glyphicon glyphicon-cog"></i><span> Website Info - c 0 d 3 l i s t . c c</span></a> </li>

                        <?php
 }
?>  

                      <!--</div>-->
                      
 
 
                    </ul>
                     
                  
                    
                </div>
            </div>
        </div>
        






