<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_controller extends CI_Controller {

	public function __construct(){ 
	    parent::__construct();  
	    $this->load->model('login_model');
	}

	public function index(){
		$this->load->view('login');
	}


	public function login(){
		$this->load->view('login');
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
