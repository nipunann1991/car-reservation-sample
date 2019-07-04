<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class home_controller extends CI_Controller {

    public function __construct() {

        parent::__construct(); 

        $this->load->model('home_model'); 

        if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	}

	public function index(){
		$this->load->view('home_page');
	}
 
 
	public function get_stats(){ 

		$result = $this->home_model->get_total_reservations(); 

		$arrayName = array(
			'total_reservations' => $this->home_model->get_total_reservations(), 
			'total_cars' => $this->home_model->get_total_cars(), 
			'total_users' => $this->home_model->get_total_users(), 
			'total_drivers' => $this->home_model->get_total_drivers(), 
		);

		$set_json_output = json_encode($arrayName,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
	}
 
 
}
