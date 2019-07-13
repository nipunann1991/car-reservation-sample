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
		        'customer_id' => $result['data']->customer_id,
		        'role' => $result['data']->u_role
			);

			$this->session->set_userdata($newdata);
			if ($this->session->userdata['role'] == 1){
				header('Location: '.base_url().'index.php/home_controller');
			}else{
				header('Location: '.base_url().'index.php/user_controller');
			}
			
			 
		}else{
			header('Location: '.base_url().'index.php');
		}
		 
	}

	public function cerate_account(){
		$data = array( 
			'f_name' => $this->input->post('first_name'),
			'l_name' => $this->input->post('last_name'),
			'email_addr' => $this->input->post('email_addr'),
			'address' => $this->input->post('addr'),  
			'nic' => $this->input->post('nic'),  
			'contact_no' => $this->input->post('contact_no'),  
			'status' => $this->input->post('status'),  
		); 

		$result = $this->login_model->insert_customer_data($data);  

		 

		if ($result['status'] == 200) {
			

			$data_user_login = array( 
				'customer_id' => $result['message'],
				'u_fname' => $this->input->post('first_name'),
				'u_lname' => $this->input->post('last_name'), 
				'u_email' => $this->input->post('email_addr'),
				'u_password' => $this->input->post('user_password'),  
				'u_role' => 2,  
			);

			$this->login_model->insert_user_login($data_user_login);  

		}

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);
		

		

	 	return $output;
	}

	public function logout(){ 
		session_destroy();
		header('Location: '.base_url().'index.php');

	}

	public function create_account(){
		$this->load->view('create_account');
	}
}
