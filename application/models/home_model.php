<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_model extends CI_Model {
 
	public function get_total_reservations(){

	 	$select_query = "SELECT COUNT(res_id) AS value FROM `reservations`"; 
		$query = $this->db->query($select_query);

		return $query->result()[0]->value;
	}


	public function get_total_cars(){

	 	$select_query = "SELECT COUNT(car_id) AS value FROM `car`"; 
		$query = $this->db->query($select_query);

		return $query->result()[0]->value;
	}


	public function get_total_users(){

	 	$select_query = "SELECT COUNT(customer_id) AS value FROM `customers`"; 
		$query = $this->db->query($select_query);

		return $query->result()[0]->value;
	}

	public function get_total_drivers(){

	 	$select_query = "SELECT COUNT(driver_id) AS value FROM `driver`"; 
		$query = $this->db->query($select_query);

		return $query->result()[0]->value;
	}


	public function get_login_data($data){
 
	 	$select_query = "SELECT * FROM `user` WHERE `u_email`='".$data['email']."' and `u_password`='".$data['password']."'"; 
		$query = $this->db->query($select_query);

		$results = $query->result();

		if (sizeof($results) == 1) {

			$output = array(
				'status' => 200,  
				'message' => 'Valid User',
				'data' => $results[0]
			);

			return $output;
		}else{

			$output = array(
				'status' => 404,  
				'message' => 'Invalid User'
			);
			return $output;
		}
	} 
	
}



