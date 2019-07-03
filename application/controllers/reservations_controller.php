<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservations_controller extends CI_Controller {

	public function __construct(){ 
	    parent::__construct();  
	    $this->load->model('reservations_model');

	    if (!isset($this->session->userdata['logged_in'])) {
        	header('Location: '.base_url().'index.php');
        }
	}

	public function view_reservations(){
		$this->load->view('reservations/view-reservations');
	}

	public function add_reservations(){
		$this->load->view('reservations/add_reservations');
	}


	

	// public function edit_pricing(){
	// 	$this->load->view('pricing/edit_pricing');
	// }

	// public function add_pricing_data(){  

	// 	$data = array( 
	// 		'car_type_id' => $this->input->post('car_type'),
	// 		'price_per_day' => $this->input->post('price_per_day'),
	// 		'price_per_hour' => $this->input->post('price_per_hour'),
	// 		'price_per_km' => $this->input->post('price_per_km'),  
	// 		'update_date' => date("Y-m-d"),  
	// 	);

	// 	$result = $this->pricing_model->insert_pricing_data($data); 

	// 	$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
	// 	$output =  $this->output->set_output($set_json_output);

	//  	return $output;
  
	// }

	// public function get_all_pricing_data(){   

	// 	$result = $this->pricing_model->get_all_pricing_details(); 

	// 	$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
	// 	$output =  $this->output->set_output($set_json_output);

	//  	return $output;
  
	// } 


	// public function get_single_pricing_data(){  

	// 	$data = array('pricing_id' => $this->input->post('pricing_id'));

	// 	$result = $this->pricing_model->get_pricing_by_id($data); 

	// 	$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
	// 	$output =  $this->output->set_output($set_json_output);

	//  	return $output;
  
	// }


	// 	public function edit_pricing_data(){  

	// 	$data_vals = array(
	// 		'car_type_id' => $this->input->post('car_type'),
	// 		'price_per_day' => $this->input->post('price_per_day'),
	// 		'price_per_hour' => $this->input->post('price_per_hour'),
	// 		'price_per_km' => $this->input->post('price_per_km'),  
	// 	);

	// 	$update_val = array(
	// 		'pricing_id' => $this->input->post('pricing_id'),
	// 		'values' => $this->set_update_values($data_vals), 
	// 	);

	// 	$result = $this->pricing_model->update_pricing_data($update_val); 

	// 	$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
	// 	$output =  $this->output->set_output($set_json_output);

	//  	return $output;
  
	// }


	// public function set_update_values($dataset){
	// 	$values = '';
	// 	$insert_vals =  array();

	// 	$get_columns = array_keys($dataset);
	// 	$get_values = array_values($dataset);

	// 	for ($i=0; $i <  sizeof($get_columns) ; $i++) { 
			 
	// 		if ($i == 0) {
	// 			$values = "`".$get_columns[$i]."`='".$get_values[$i]."'";
	// 		}else{
	// 			$values = $values.",`".$get_columns[$i]."`='".$get_values[$i]."'";
	// 		}
	// 	}


	// 	return $values;

	// }
  

	 
}
