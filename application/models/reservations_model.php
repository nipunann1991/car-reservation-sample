<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reservations_model extends CI_Model {
	

	public function insert_reservations_data($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO  `reservations`(`res_date`, `res_end_date`, `customer_id`, `car_id`, `driver_id`, `pricing_id`, `pricing_type`, `pricing_qty`, `status`) VALUES (".$values.");";

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
	 

	public function get_all_reservations_details(){

	 	$select_query = "SELECT r.*, r.status AS rstatus, c.*, c1.*, d.driver_id, d.first_name, d.last_name, d.contact_no, p.* FROM `reservations` AS r, `customers` AS c, `car` AS c1, `driver` AS d, `pricing` AS p WHERE c.customer_id=r.customer_id AND r.car_id=c1.car_id AND r.driver_id=d.driver_id AND r.pricing_id=p.pricing_id"; 

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


	public function get_all_reservations_details_by_id($data){

	 	$select_query = "SELECT r.*, r.status AS rstatus, c.contact_no AS customer_contact, c.*, c1.*, d.driver_id, d.first_name, d.last_name, d.contact_no, p.* FROM `reservations` AS r, `customers` AS c, `car` AS c1, `driver` AS d, `pricing` AS p WHERE c.customer_id=r.customer_id AND r.car_id=c1.car_id AND r.driver_id=d.driver_id AND r.pricing_id=p.pricing_id AND  r.`res_id`='".$data['res_id']."'"; 

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


	
	public function insert_customer_data($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `customers`(`f_name`, `l_name`, `email_addr`, `address`, `nic`, `contact_no`, `status`) VALUES (".$values.");";

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


	public function get_customer_by_id($data){ 
		 

	 	$select_query = "SELECT * FROM `customers` WHERE  `customer_id`='".$data['customer_id']."'"; 

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



	public function update_customer_data($data){
    
		$update_query =  "UPDATE `customers` SET ".$data['values']." WHERE customer_id='".$data['customer_id']."'" ;

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

	public function delete_customer($data){
   
		$insert_query = "DELETE FROM `customers` WHERE `customer_id`=".$data['customer_id']."";

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

	
}



