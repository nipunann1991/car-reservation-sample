<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Add Pricing Details</h2>
 
		</div>
		 
		<form  id="myform" class="col-md-5 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Pricing details added successfully.
			</div> 

			<div class="row">
				<div class="form-group col-md-12">
				    <label for="car_type">Car Type</label>
				    <select class="form-control" id="car_type"> 
					
					</select>
				</div>
			</div>
			<div class="row"> 

				<div class="form-group col-md-8">
				    <label for="price_per_day">Price Per Day</label>
				     

				    <div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<span class="input-group-text">Rs.</span>
					  	</div>
					  	<input type="text" class="form-control"  name="price_per_day" id="price_per_day" >
					  	<div class="input-group-append">
					    	<span class="input-group-text">.00</span>
					  	</div>
					</div>
				</div> 
				
			</div> 

			<div class="row">

				<div class="form-group col-md-8">
				    <label for="price_per_hour">Price Per hour</label> 
				    <div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<span class="input-group-text">Rs.</span>
					  	</div>
					  	<input type="text" class="form-control" name="price_per_hour" id="price_per_hour" >
					  	<div class="input-group-append">
					    	<span class="input-group-text">.00</span>
					  	</div>
					</div>
				</div>

			</div>

			<div class="row">

				<div class="form-group col-md-8">
				    <label for="price_per_km">Price Per Km</label> 
				    <div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<span class="input-group-text">Rs.</span>
					  	</div>
					  	<input type="text" class="form-control" name="price_per_km" id="price_per_km" >
					  	<div class="input-group-append">
					    	<span class="input-group-text">.00</span>
					  	</div>
					</div>
				</div>

			</div>
		 
 
						 
			
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Pricing </button> 

		  	<a href="<?php echo base_url(); ?>index.php/pricing_controller/view_pricing" class="btn btn-secondary">Cancel</a> 
			 
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
		 
		 
		

		/* Validate Form */

    	$('#myform').validate({ 

	        rules: {
	            price_per_day: {
	                number: true, 
	                required: true, 
	            }, 

	            price_per_hour: {
	                number: true,  
	                required: true, 
	            },

	            price_per_km: {
	                number: true,  
	                required: true, 
	            },
 
	        },

	        submitHandler: function(form) { 
	    
	        	var data = {
	        		car_type: $('#car_type').val(), 
					price_per_day: $('#price_per_day').val(),
					price_per_hour: $('#price_per_hour').val(),
					price_per_km: $('#price_per_km').val(), 
	        	}
 
	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/pricing_controller/add_pricing_data',
	        		type: 'POST', 
	        		data: data,
	        	})
	        	.done(function(data) {
 
 					
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