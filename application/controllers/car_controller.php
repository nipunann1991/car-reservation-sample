<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class car_controller extends CI_Controller {

	public function __construct() {

        parent::__construct(); 

        if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	} 

	public function add_car(){
		$this->load->view('cars/add_car');
	}

	public function car_types(){
		$this->load->view('cars/car_types');
	}

	public function add_car_types(){
		$this->load->view('cars/add_car_types');
	}

	public function view_cars(){
		$this->load->view('cars/view_cars');
	}

	

	public function check_user_details(){

		$data = array('email' => $this->input->get('email') , 'password' => $this->input->get('password'));

		$result = $this->login_model->get_login_data($data); 
 

		if ($result['status'] == '200') {

			$newdata = array(
		        'username'  => $result['data']->u_fname." ".$result['data']->u_lname,
		        'email'     => $result['data']->u_email,
		        'logged_in' => TRUE,
		        'role' => $result['data']->u_role
			);

			$this->session->set_userdata($newdata);
			header('Location: '.base_url().'index.php/home_controller');
			 
		}else{
			header('Location: '.base_url().'index.php');
		}
		 
	}

	public function logout(){ 
		session_destroy();
		header('Location: '.base_url().'index.php');

	}

	public function create_account(){
		$this->load->view('create_account');
	}
}
