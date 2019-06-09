<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Car Types</h2>

			<a href="<?php echo base_url(); ?>index.php/car_controller/add_car_types" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car Type</a>
		</div>
		

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Type ID</th>
			        <th>Car Type</th>
			        <th>Actions</th>
		      	</tr>
		    </thead>
		    <tbody>
		      	<tr>
			        <td>1</td>
			        <td>Doe</td>
			        <td> <a href="" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> <a href="" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> </td>
		      	</tr>
		      	<tr>
			        <td>2</td>
			        <td>Moe</td>
			        <td> <a href="" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> <a href="" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> </td>
		      	</tr>
		      	<tr>
			        <td>3</td>
			        <td>Dooley</td>
			        <td> <a href="" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a> <a href="" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> </td>
		      	</tr>
		    </tbody>
		</table>

	</div>
</div>

<?php $this->load->view('footer'); ?>