<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

	public function registration($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `customer` (`customer_f_name`,`customer_l_name`,`contact_no`,`address`,`nic`,`email`,`password`) VALUES (".$values.");";

		$query = $this->db->query($insert_query);

		if ($query) {
			
			return "Data Inserted Successfully";

		}else{
			return "Data Inserted Faild";

		}
 
	}

	public function select_registerd_users(){

	 	$select_query = "SELECT * FROM `test`"; 
		$query = $this->db->query($select_query);

		return $query->result();
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


	public function insert_customer_data($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `customers`(`f_name`, `l_name`, `email_addr`, `address`, `nic`, `contact_no`, `status`) VALUES (".$values.");";

		$query = $this->db->query($insert_query);

		$insert_id = $this->db->insert_id(); 


		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => $insert_id, 
			);

			return $output;
			 

		}else{
			 

			if ($this->db->error()['code'] == '1062') {

				$output = array(
					'status' => 500,  
					'message' => "Duplicate entry", 
				);
				 
			}else{

				$output = array(
					'status' => 404,  
					'message' => "Data Inserted Faild", 
				);

			}

			

			return $output;  
		}
 
	}


	public function insert_user_login($data){
 
		$values = "'" . implode("','", $data) . "'";

		$insert_query = "INSERT INTO `user`(`customer_id`, `u_fname`, `u_lname`, `u_email`, `u_password`, `u_role`) VALUES (".$values.");";

		$query = $this->db->query($insert_query);

 
		if ($query) {

			$output = array(
				'status' => 200,  
				'message' => "Data Inserted Successfully", 
			);

			return $output;
			 

		}else{
			 

			if ($this->db->error()['code'] == '1062') {

				$output = array(
					'status' => 500,  
					'message' => "Duplicate entry", 
				);
				 
			}else{

				$output = array(
					'status' => 404,  
					'message' => "Data Inserted Faild", 
				);

			}

			

			return $output;  
		}
 
	}
	
}



