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

	public function add_reservations_data(){  

		$data = array( 
			'res_date' => $this->input->post('res_date'),
			'res_end_date' => $this->input->post('res_end_date'),
			'customer_id' => $this->input->post('customer_id'),
			'car_id' => $this->input->post('car_id'),  
			'driver_id' => $this->input->post('driver_id'),  
			'pricing_id' => $this->input->post('pricing_id'),  
			'pricing_type' => $this->input->post('pricing_type'),  
			'pricing_qty' => $this->input->post('pricing_qty'),  
			'status' => $this->input->post('status'),  
			 
		);

		$result = $this->reservations_model->insert_reservations_data($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}

	public function get_all_reservations_data(){   

		$result = $this->reservations_model->get_all_reservations_details(); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	} 


	public function get_single_reservation_data(){  

		$data = array('res_id' => $this->input->post('res_id'));

		$result = $this->reservations_model->get_all_reservations_details_by_id($data); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


	public function edit_pricing_data(){  

		$data_vals = array(
			'car_type_id' => $this->input->post('car_type'),
			'price_per_day' => $this->input->post('price_per_day'),
			'price_per_hour' => $this->input->post('price_per_hour'),
			'price_per_km' => $this->input->post('price_per_km'),  
		);

		$update_val = array(
			'pricing_id' => $this->input->post('pricing_id'),
			'values' => $this->set_update_values($data_vals), 
		);

		$result = $this->pricing_model->update_pricing_data($update_val); 

		$set_json_output = json_encode($result,JSON_PRETTY_PRINT); 
		$output =  $this->output->set_output($set_json_output);

	 	return $output;
  
	}


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
