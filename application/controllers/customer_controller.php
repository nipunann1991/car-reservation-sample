<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer_controller extends CI_Controller {

	public function __construct(){ 
	    parent::__construct();  
	    $this->load->model('customer_model');

	    if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	}

 

	public function view_customers(){
		$this->load->view('customers/view_customers');
	}
 

	public function add_customers(){
		$this->load->view('customers/add_customers');
	}

	public function edit_customers(){
		$this->load->view('customers/edit_customers');
	}

	public function add_customer_data(){  

		$data = array( 
			'f_name' => $this->input->post('first_name'),
			'l_name' => $this->input->post('last_name'),
			'email_addr' => $this->input->post('email_addr'),
			'address' => $this->input->post('addr'),  
			'nic' => $this->input->post('nic'),  
			'contact_no' => $this->input->post('contact_no'),  
			'status' => $this->input->post('status'),  
		);

		$result = $this->customer_model->insert_customer_data($data);  
		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}

	public function get_all_customer_data(){   

		$result = $this->customer_model->get_all_customer_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	} 


	public function get_latest_customer_data(){   

		$result = $this->customer_model->get_latest_customer_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	} 


	public function get_all_active_customer_data(){   

		$result = $this->customer_model->get_all_active_customer_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	} 


	public function get_single_customer_data(){  

		$data = array('customer_id' => $this->input->post('customer_id'));

		$result = $this->customer_model->get_customer_by_id($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function edit_customer_data(){  

		$data_vals = array(
			'f_name' => $this->input->post('first_name'),
			'l_name' => $this->input->post('last_name'),
			'email_addr' => $this->input->post('email_addr'),
			'address' => $this->input->post('addr'),  
			'nic' => $this->input->post('nic'),  
			'contact_no' => $this->input->post('contact_no'),  
			'status' => $this->input->post('status'),  
		);

		$update_val = array(
			'customer_id' => $this->input->post('customer_id'),
			'values' => $this->set_update_values($data_vals), 
		);

		$result = $this->customer_model->update_customer_data($update_val); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function delete_customer_data(){  

		$data = array('customer_id' => $this->input->post('customer_id'));

		$result = $this->customer_model->delete_customer($data); 

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
