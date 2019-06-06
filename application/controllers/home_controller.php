<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class home_controller extends CI_Controller {

 

	public function __construct() {
        parent::__construct();
        


        if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }else{
        	print_r('yes');
			
        }
        // Your own constructor code
	}

	public function index(){
		$this->load->view('home_page');
	}
 
 
}
