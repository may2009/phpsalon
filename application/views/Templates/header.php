<?php
$settings = get_settings();
?>
<!DOCTYPE html>
<html lang="en"><head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $settings->favicon; ?>">
    <title> <?php echo $settings->title." - ". $page_title; ?> </title>



    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.css">
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css">
<!--    <link rel="stylesheet" href="<?php /*echo base_url();*/?>assets/css/hover.min.css">
-->    <link href="<?php echo base_url();?>assets/css/saloon.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/salon-style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatable/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatable/datatable.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/customcss.css">

    <!-- GENERAL JAVASCRIPTS -->
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js"></script>
    <script> var base_url = '<?php echo base_url();?>';</script>
    <!-- Custom Scripts -->

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/salon-script.js"></script>
    
    <!-- FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
    </head>
    
    

    <body>
  
