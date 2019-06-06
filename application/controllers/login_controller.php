<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 

	public function index(){
		$this->load->view('login');
	}


	public function login(){
		$this->load->view('login');
	}

	public function check_user_details(){
		
		$newdata = array(
		        'username'  => 'johndoe',
		        'email'     => 'johndoe@some-site.com',
		        'logged_in' => TRUE
		);

		$this->session->set_userdata($newdata);
		header('Location: '.base_url().'index.php/home_controller');
	}

	public function create_account(){
		$this->load->view('create_account');
	}
}
