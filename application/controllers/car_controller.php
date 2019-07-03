<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class car_controller extends CI_Controller {

	public function __construct() {

        parent::__construct(); 
        $this->load->model('car_model');

        if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
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


	public function add_car_types_data(){  

		$data = array('car_type' => $this->input->post('add_car_type'));

		$result = $this->car_model->insert_car_type($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function delete_car_type_data(){  

		$data = array('car_type_id' => $this->input->post('car_type_id'));

		$result = $this->car_model->delete_car_type($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}
 

	public function get_all_car_types_data(){   

		$result = $this->car_model->get_all_car_types(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function get_all_car_type_by_car_id_data(){   
		
		$data = array('car_type_id' => $this->input->post('car_type_id'));

		$result = $this->car_model->get_all_car_type_by_car_id($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function get_single_car_type_data(){  

		$data = array('car_type_id' => $this->input->post('car_type_id'));

		$result = $this->car_model->get_car_type_by_id($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}

	public function edit_car_type_data(){  

		$data = array(
			'car_type' => $this->input->post('car_type'),
			'car_type_id' => $this->input->post('car_type_id')
		);

		$result = $this->car_model->edit_car_type($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function get_all_fuel_types_data(){   

		$result = $this->car_model->get_all_fuel_types(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function add_car_data(){  

		$data = array(
			'plate_id' => $this->input->post('plate_id'),
			'model' => $this->input->post('model'),
			'car_type_id' => $this->input->post('car_type'),
			'color' => $this->input->post('color'),
			'year' => $this->input->post('year'),
			'engine' => $this->input->post('engine'), 
			'fuel_type_id' => $this->input->post('fuel_types'),
			'no_of_passegers' => $this->input->post('passengers'), 
		);

		$result = $this->car_model->insert_car_data($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function edit_car_data(){  

		$data_vals = array(
			'car_id' => $this->input->post('car_id'),
			'plate_id' => $this->input->post('plate_id'),
			'model' => $this->input->post('model'),
			'car_type_id' => $this->input->post('car_type'),
			'color' => $this->input->post('color'),
			'year' => $this->input->post('year'),
			'engine' => $this->input->post('engine'), 
			'fuel_type_id' => $this->input->post('fuel_types'),
			'no_of_passegers' => $this->input->post('passengers'), 
			
		);

		$update_val = array(
			'car_id' => $this->input->post('car_id'),
			'values' => $this->set_update_values($data_vals), 
		);

		$result = $this->car_model->update_car_data($update_val); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}



	public function get_all_car_data(){   

		$result = $this->car_model->get_all_car_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	} 


	public function get_single_car_data(){  

		$data = array('car_id' => $this->input->post('car_id'));

		$result = $this->car_model->get_car_by_id($data); 

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


	public function set_update_values($dataset){
		$values = '';
		$insert_vals =  array();

		$get_columns = array_keys($dataset);
		$get_values = array_values($dataset);

		for ($i=0; $i <  sizeof($get_columns) ; $i++) { 
			 
			if ($i == 0) {
				$values = "`".$get_columns[$i]."`='".$get_values[$i]."'";
			}else{
				$values = $values.",`".$get_columns[$i]."`='".$get_values[$i]."'";
			}
		} 
		
		return $values;

	}
}
