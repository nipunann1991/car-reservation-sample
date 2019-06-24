<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Add Car Details</h2>
 
		</div>
		 
		<form  id="myform" class="col-md-9 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Car details added successfully.
			</div> 

			<div class="row">
				<div class="form-group col-md-6">
				    <label for="plate_id">Plate ID</label>
				    <input type="text" name="plate_id" class="form-control" id="plate_id">
				</div>  
			</div>
			<div class="row"> 

				<div class="form-group col-md-6">
				    <label for="model">Model</label>
				    <input type="text" name="model" class="form-control" id="model">
				</div>
				<div class="form-group col-md-6">
				    <label for="color">Color</label>
				    <input type="text" name="color" class="form-control" id="color">
				</div>
				
			</div>

			<div class="row">
				<div class="form-group col-md-6">
				    <label for="car_type">Car Type</label>
				    <select class="form-control" id="car_type"> 
					
					</select>
				</div>

				<div class="form-group col-md-6">
				    <label for="engine">Engine</label>
				    <input type="text" name="engine" class="form-control" id="engine">
				</div>
				
			</div>

			<div class="row">
				<div class="form-group col-md-6">
				    <label for="year">Year</label>
				    <input type="text" name="year" class="form-control" id="year">
				</div>

				<div class="form-group col-md-6">
				    <label for="fuel_types">Fuel Type</label>
				    <select class="form-control" id="fuel_types"> 
					
					</select>
				</div>
				
			</div>

			<div class="row">
				<div class="form-group col-md-6">
				    <label for="passengers">Max no of Passengers</label>
				    <input type="number" value="1" name="passengers" class="form-control" id="passengers">
				</div>  
				
			</div>
			 
						 
			
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car </button> 

		  	<a href="<?php echo base_url(); ?>index.php/car_controller/view_cars" class="btn btn-secondary">Cancel</a> 
			 
		</form>

	</div>
</div>

<?php $this->load->view('footer'); ?>


<script>
	$(document).ready(function () {  
		

		/* Get car types */

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_types_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('#car_type').append('<option value='+output.data[i].car_type_id+'>'+output.data[i].car_type+'</option>') 
    			}  
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});
		


		/* Get fuel types */

    	$.ajax({
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_fuel_types_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('#fuel_types').append('<option value='+output.data[i].fuel_type_id+'>'+output.data[i].fuel_name+'</option>') 
    			} 
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});

		

		/* Validate Form */

    	$('#myform').validate({ 

	        rules: {
	            plate_id: {
	                required: true, 
	            }, 

	            model: {
	                required: true, 
	            },

	            color: {
	                required: true, 
	            },

	            engine: {
	                required: true, 
	            },

	            year: {
	                required: true, 
	            },
	        },

	        submitHandler: function(form) { 
	    
	        	var data = {
					plate_id: $('#plate_id').val(),
					model: $('#model').val(),
					color: $('#color').val(),
					car_type: $('#car_type').val(),
					engine: $('#engine').val(),
					year: $('#year').val(),
					fuel_types: $('#fuel_types').val(),
					passengers: $('#passengers').val(),
	        	}
 
	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/car_controller/add_car_data',
	        		type: 'POST', 
	        		data: data,
	        	})
	        	.done(function(data) {

	        		$('#add_car_type').val('');
 					
 					var output = JSON.parse(data);
	        		 
	        		if (output.status == 200) { 
	        			$('.alert-success').removeClass('d-none'); 
	        			$('#myform')[0].reset();
	        		}

	        	})
	        	.fail(function() {
	        		console.log("error");
	        	}); 
			
			}
	    });

   	});

</script>