<?php

$this->load->view('Templates/header');
$this->load->view('Templates/header-menu');
?>
<div class="ch-container">
    <div class="row">
<?php
$this->load->view('Templates/left-menu');
?>
    <div id="content" class="col-lg-10 col-sm-10">
                <!-- content starts -->
        <div>
          <ul class="breadcrumb">
              <li>
                  <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
              </li>
              <?php if($page_title != 'Dashboard') { ?>
              <li>
                  <a href="#"><?php echo $page_title; ?></a>
              </li>
              <?php } ?>
          </ul>
        </div>
<?php
$this->load->view($page);
?>
	</div>
	</div>
<?php
$this->load->view('Templates/footer');
?>
</div>