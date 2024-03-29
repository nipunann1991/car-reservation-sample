<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Add Car Type</h2> 
		</div>

		<form  id="myform" class="col-md-6 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Car type added successfully.
			</div> 
						 
			<div class="form-group">
			    <label for="add_car_type">Add Car Type</label>
			    <input type="text" name="add_car_type" class="form-control" id="add_car_type">
			</div>
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car Type</button> 

		  	<a href="<?php echo base_url(); ?>index.php/car_controller/view_car_types" class="btn btn-secondary">Cancel</a> 
			 
		</form>
		
 

	</div>
</div>

<?php $this->load->view('footer'); ?>

<script>
	$(document).ready(function () {  

	    $('#myform').validate({ // initialize the plugin
	        rules: {
	            add_car_type: {
	                required: true, 
	            }, 
	        },

	        submitHandler: function(form) { 
	    
	        	var data = {
					add_car_type: $('#add_car_type').val()
	        	}

	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/car_controller/add_car_types_data',
	        		type: 'POST', 
	        		data: data,
	        	})
	        	.done(function(data) {

	        		$('#add_car_type').val('');
 					
 					var output = JSON.parse(data);
	        		 
	        		if (output.status == 200) { 
	        			$('.alert-success').removeClass('d-none'); 
	        		}

	        	})
	        	.fail(function() {
	        		console.log("error");
	        	});
	        	
 
			
			}
	    });

	});
</script>