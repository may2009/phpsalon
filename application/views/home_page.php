<div class="banner">
  <div class="container">
    <div class="col-md-6"></div>
    <div class="col-md-6">
      <div class="inr-bnr-form">
        <div class="bnr-form animated fadeInLeft">
          <h1> Chercher. Découvrir. Réservez instantanément.</h1>
          <h2> Accès 24/7 aux meilleurs salons </h2>
          <div class="bnr-form-srchmain">
          <form action="<?php echo base_url();?>search" method="post">
            <div class="col-md-12">
                <div class="place-select">
                    <select name="users" id="fxselect">
                        <option selected="" value="">Tout les Employées</option>
                        <?php
                        if(isset($users)) {
                            foreach($users as $usr) { ?>
                                <option value="<?php echo $usr->id; ?>"><?php echo $usr->name; ?> <?php echo $usr->lastname; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
              <div class="place-select">
                <select name="services" id="fxselect">
                  <option selected="" value="">All Services</option>
                  <?php
				  if(isset($services)) {
				  foreach($services as $service) { ?>
                  <option value="<?php echo $service->id; ?>"><?php echo $service->name; ?></option>
				  <?php }
				  }
				  ?>
                </select>
              </div>
            </div>

              <div class="col-md-12">


                  <div class="demo">
 				<div class="row">


            <div class="col-md-6">
            <div class="date-input">
            <p id="basicExample">
            <input name="date" type="text" class="date start" />
            </p>

            <!-- valuee="2:30 AM" data-value="0:00" -->
            </div>
            </div>


            <div class="col-md-6">
            <div class="time-input">
            <p id="basicExample">
            <input name="time" type="text" class="time start" />

            </p>
            <!-- valuee="2:30 AM" data-value="0:00" -->
            </div>
            </div>



            </div>



            </div>

              </div>
            <div class="col-md-12">
              <p class="fieldset">
                <input type="submit" value="Search Now" class="srchbutton">
              </p>
            </div>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="slider" class="aslider" data-duration="10" >
	<img src="<?php echo base_url();?>assets/images/slide/01.jpg" style="width:100%;"/><span class="bnr-form-srchmain"> </span>
  <div class="aslide" data-duration="5" > <img src="<?php echo base_url();?>assets/images/slide/02.jpg"/> </div>
  <div class="aslide" data-duration="5" > <img src="<?php echo base_url();?>assets/images/slide/01.jpg"/> </div>
</div>


        <!-- CLM 1  EASY AND SIMPLE  -->

<div class="easyclm1" style="background-color: #f7f7f7;">
  <div class="container">
    <div class="row">
      <h1> FACILE ET SIMPLE </h1>
      <div class="col-md-4">
        <div class="easyclmlist"> <img src="<?php echo base_url();?>assets/images/choose_location_icon.png" alt=""/>
          <h1> Choisi ton<br/>
              Emplacement / Boutique </h1>
          <div class="easyclmlist-sparator"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="easyclmlist"> <img src="<?php echo base_url();?>assets/images/time_date_icon.png" alt=""/>
          <h1> Choisi ton <br/>
              Heure et date</h1>
          <div class="easyclmlist-sparator"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="easyclmlist"> <img src="<?php echo base_url();?>assets/images/submit_booking_icon.png" alt=""/>
          <h1> Soumettez votre<br/>
              Réservations </h1>
          <div class="easyclmlist-sparator"></div>
        </div>
      </div>
    </div>
  </div>
</div>

        <!-- EDITORS PICKS -->
        	<?php
	if(!empty($data->cycle_slider)) {
	?>
    <?php if(count($data->cycle_slider) > 3) { ?>
    <div class="editors-picks-main">
    <div class="container">
    <div class="row">

    	<h1> EDITOR'S PICKS </h1>
        <h2> A new way to discover top salon's. </h2>
        <div class="editors-picks-sparator"></div>

    </div>
    </div>

        <!-- EDITORS PICK SLIDER  -->

 <div class="editor-pick-slider">
   <?php
   foreach($data->cycle_slider as $cs) {
   ?>
   <li><div class="box"><img src="<?php echo $cs->image;?>">
       <div class="white"><h2 class="white-text"><?php echo $cs->shop_name;?></h2><hr>
           <a href="<?php echo base_url()."shop/book/".strtolower(str_replace(" ","-",$cs->shop_name))."-".$cs->id;?>"><div class= "book"><h2>BOOK NOW</h2></div></a></div></div>
    </li>
  <?php
  }
  ?>

  </div>
   </div>
     <?php
     }
	}
     ?>

<!-- WHATS NEW -->
	<?php
	if(!empty($data->whats_new)) {
	?>
  <div class="wthats-new-main">
  <div class="container">
    <div class="row">
      <div id="wrap">
        <div id="next"><img src="<?php echo base_url();?>assets/images/wtsnw_left.png" alt=""></div>
        <div id="prev"><img src="<?php echo base_url();?>assets/images/wtsnw_right.png" alt=""></div>
        <div id="page" style="width:99%">

          <?php
		  foreach($data->whats_new as $whats_new) {
		  ?>
          <li class="width100">
            <div class="out-wrap">
              <div class="col-md-6"><img src="<?php echo $whats_new->image;?>" style="max-width:460px"></div>
              <div class="wts-nw-cnt col-md-5">
                <h1><?php echo $whats_new->title;?></h1>
                <h2><?php echo $whats_new->subtitle;?></h2>
                <p><?php echo $whats_new->description;?></p>
                <a href="<?php echo base_url()."shop/view/".str_replace(" ","-",strtolower($whats_new->shop_name))."-".$whats_new->shop_id;?>">
                <div class="wts-shopbtn"> SHOP NOW </div>
                </a> </div>
            </div>
          </li>

          <?php
		  }
		  ?>
        </div>
      </div>
    </div>
  </div>
</div>
	<?php
	}
	?>












</div>

        <!-- CATEGORY  -->

<div class="category-main">
  <div class="container">
    <div class="row">
      <h1> BROWSE BY CATEGORY <?= $yassine ?> </h1>
      <h2> A new way to discover top salon's. </h2>
      <div class="category-main-sparator"></div>
      <div class="col-md-12">
        <div class="category-iconmain">
          <ul>
            <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon1.png" alt=""/>
              <p> BlowOut </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon2.png" alt=""/>
              <p> Nails </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon3.png" alt=""/>
              <p> Hair Cut </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon4.png" alt=""/>
              <p> Tanning</p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon5.png" alt=""/>
              <p> Facial </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon6.png" alt=""/>
              <p> Massage </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon7.png" alt=""/>
              <p> Hair Color </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon8.png" alt=""/>
              <p> MakeUp </p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon9.png" alt=""/>
              <p> Brows</p>
            </li>
            </a> <a href="<?php echo base_url();?>search">
            <li> <img src="<?php echo base_url();?>assets/images/category_icon10.png" alt=""/>
              <p> Bikini </p>
            </li>
            </a>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

        <!-- FEATURES TESTIMONIAL -->

  <div class="testino-main">
  <div class="row">
    <div class="col-md-6">
      <div class="testino-left">
        <div class="fturd-hd"> Featured In : </div>
        <div class="fturd-icon">
          <div class="fturd-icons"><img src="<?php echo base_url();?>assets/images/featured_logo1.png" alt=""/></div>
          <div class="fturd-icons"><img src="<?php echo base_url();?>assets/images/featured_logo2.png" alt=""/></div>
          <div class="fturd-icons"><img src="<?php echo base_url();?>assets/images/featured_logo3.png" alt=""/></div>
          <div class="fturd-icons"><img src="<?php echo base_url();?>assets/images/featured_logo4.png" alt=""/></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="testino-right">
        <div class="testino-hd"> Testimonials </div>
        <div class="col-md-12">
          <ul class="bxslider">

            <?php
			if(!empty($data->testimonials)) {
			foreach($data->testimonials as $testimonial) {
			?>
            <li>
              <blockquote>
                <div style="width:100%; text-align:center;"><img src="<?php echo $testimonial->image;?>" alt="" style="border-radius:50%; width:150px; height:150px;"></div>
                <h1> <img src="<?php echo base_url();?>assets/images/quote_left.png" alt=""> <?php echo $testimonial->name;?> <img src="<?php echo base_url();?>assets/images/quote_right.png" alt=""> </h1>
                <p> <?php echo $testimonial->description;?>. </p>
              </blockquote>
            </li>
            <?php
			}
			}
			?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
