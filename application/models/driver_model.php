<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class driver_model extends CI_Model {
 

	public function get_all_driver_details(){

	 	$select_query = "SELECT * FROM `driver`"; 
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



	public function get_all_active_driver_details(){

	 	$select_query = "SELECT * FROM `driver` WHERE status = 1"; 
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


	public function get_driver_by_id($data){ 
		 

	 	$select_query = "SELECT * FROM `driver` WHERE `driver_id`='".$data['driver_id']."'"; 

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

	
	public function insert_driver_data($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `driver`(`first_name`, `last_name`, `licence_no`, `nic`, `address`, `email`, `contact_no`) VALUES (".$values.");";

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


	public function update_driver_data($data){
    
		$update_query =  "UPDATE `driver` SET ".$data['values']." WHERE driver_id='".$data['driver_id']."'" ;

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



