<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class driver_controller extends CI_Controller {

	public function __construct(){ 
	    parent::__construct();  
	    $this->load->model('driver_model');

	    if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	}

	public function index(){
		$this->load->view('driver/view_drivers');
	}

	public function view_drivers(){
		$this->load->view('driver/view_drivers');
	}

	public function add_driver(){
		$this->load->view('driver/add_driver');
	}

	public function edit_driver(){
		$this->load->view('driver/edit_driver');
	}

	

	public function get_all_driver_data(){   

		$result = $this->driver_model->get_all_driver_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}  

	public function get_single_driver_data(){  

		$data = array('driver_id' => $this->input->post('driver_id'));

		$result = $this->driver_model->get_driver_by_id($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}

	public function add_driver_data(){  

		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'licence_no' => $this->input->post('licence_no'),
			'nic' => $this->input->post('nic'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'), 
			'contact_no' => $this->input->post('contact_no'),
		);

		$result = $this->driver_model->insert_driver_data($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function edit_driver_data(){  

		$data_vals = array(
			'driver_id' => $this->input->post('driver_id'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'licence_no' => $this->input->post('licence_no'),
			'nic' => $this->input->post('nic'),
			'address' => $this->input->post('address'),
			'email' => $this->input->post('email'), 
			'contact_no' => $this->input->post('contact_no'),
		);

		$update_val = array(
			'driver_id' => $this->input->post('driver_id'),
			'values' => $this->set_update_values($data_vals), 
		);

		$result = $this->driver_model->update_driver_data($update_val); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
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
