<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pricing_model extends CI_Model {
	

	public function insert_pricing_data($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `pricing`(`car_type_id`, `price_per_hour`, `price_per_day`, `price_per_km`, `update_date`) VALUES (".$values.");";

		$query = $this->db->query($insert_query);

		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => "Data Inserted Successfully", 
			);

			return $output;
			 

		}else{

			$output = array(
				'status' => 404,  
				'message' => "Data Inserted Faild", 
			);

			return $output;  
		}
 
	}
	 

	public function get_all_pricing_details(){

	 	$select_query = "SELECT p.*, ct.car_type FROM `pricing` AS p, `car_type` AS ct  WHERE p.car_type_id = ct.car_type_id "; 

		$query = $this->db->query($select_query);
 
		if ($query) {

			$output = array(
				'status' => 200,  
				'data' => $query->result(), 
			);

			return $output; 

		}else{

			$output = array(
				'status' => 404,  
				'data' => "Invalid sql query", 
			);

			return $output;  
		}
	}

	public function get_pricing_by_id($data){ 
		 

	 	$select_query = "SELECT * FROM `pricing` WHERE  `pricing_id`='".$data['pricing_id']."'"; 

		$query = $this->db->query($select_query);

		$results = $query->result();

		if (sizeof($results) == 1) {

			$output = array(
				'status' => 200,   
				'data' => $results[0]
			);

			return $output;
		}else{

			$output = array(
				'status' => 404,  
				'message' => 'Invalid Data'
			);
			return $output;
		}
	}



	public function update_pricing_data($data){
    
		$update_query =  "UPDATE `pricing` SET ".$data['values']." WHERE pricing_id='".$data['pricing_id']."'" ;

        $query = $this->db->query($update_query); 


		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => "Data Updated Successfully", 
			);

			return $output;
			 

		}else{

			$output = array(
				'status' => 404,  
				'message' => "Data Update Faild", 
			);

			return $output;  
		}
 
	}

	
}



