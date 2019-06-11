<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class car_model extends CI_Model {

	public function insert_car_type($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `car_type` (`car_type`) VALUES (".$values.");";

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


	public function delete_car_type($data){
   
		$insert_query = "DELETE FROM `car_type` WHERE `car_type_id`=".$data['car_type_id']."";

		$query = $this->db->query($insert_query);

		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => "Data Deleted Successfully", 
			);

			return $output;
			 

		}else{

			$output = array(
				'status' => 404,  
				'message' => "Data Deletion Faild", 
			);

			return $output;  
		}
 
	}

	public function edit_car_type($data){
   
		$insert_query = "UPDATE `car_type` SET `car_type`='".$data['car_type']."' WHERE `car_type_id`=".$data['car_type_id']."";

		$query = $this->db->query($insert_query);

		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => "Data Edited Successfully", 
			);

			return $output;
			 

		}else{

			$output = array(
				'status' => 404,  
				'message' => "Data Edit Faild", 
			);

			return $output;  
		}
 
	}

	public function get_all_car_types(){

	 	$select_query = "SELECT * FROM `car_type`"; 
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


	public function get_car_type_by_id($data){ 
		 

	 	$select_query = "SELECT * FROM `car_type` WHERE `car_type_id`='".$data['car_type_id']."'"; 

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
	
}



