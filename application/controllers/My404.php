<?php 
class My404 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('404');
		$template['page_title'] = "Page not found";
		$template['page_name'] = "error404";
		$this->load->view('template', $template);
    } 
} 
?> 