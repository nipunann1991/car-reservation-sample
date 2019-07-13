<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reports_controller extends CI_Controller {

	public function __construct() {

        parent::__construct(); 
        $this->load->model('car_model');

        if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	} 

	public function index(){
		$this->load->view('reports/view_report');
	}

	public function add_car(){
		$this->load->view('cars/add_car');
	}

	public function view_car_types(){
		$this->load->view('cars/view_car_types');
	}

	public function add_car_types(){
		$this->load->view('cars/add_car_types');
	}

	public function edit_car_types(){
		$this->load->view('cars/edit_car_types');
	}

	public function view_cars(){
		$this->load->view('cars/view_cars');
	}


	public function edit_car(){
		$this->load->view('cars/edit_car');
	}

	
 
}
