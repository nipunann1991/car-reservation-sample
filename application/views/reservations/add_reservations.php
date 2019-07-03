<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Add Reservation</h2>
 
		</div>


		 
		<form  id="myform" class="col-md-8 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Car details added successfully.
			</div> 

			<div class="row"> 

				<div class="form-group col-md-9"> 
				    <label for="customer_name">Customer Name</label>
				    <select class="form-control" name="customer_name" id="customer_name"> 
					
					</select> 
				</div>   
				 
			</div>

			<div class="row">
				<div class="form-group col-md-4"> 
					<label for="res_date">Reservation Start Date</label>
			   		<input type="date" name="date" class="form-control" id="res_date" /> 
				</div>   
				<div class="form-group col-md-4">
				   
					<label for="res_date">Reservation End Date</label>
			   		<input type="date" name="date" class="form-control" id="res_date" />
				  
				</div>  
			</div> 
			  
			<div class="row car_details">
				 
				<div class="form-group col-md-6">
				    <label for="car_type">Car Type</label>
				    <select class="form-control" name="car_type" id="car_type"> 
					
					</select>
				</div> 

				<div class="form-group col-md-6">
				    <label for="plate_no">Plate No</label>
				    <select class="form-control" name="plate_no" id="plate_no"> 
					
					</select>
				</div> 

				<div class="form-group col-md-12">
				    <label for="driver_name">Driver Name</label>
				    <select class="form-control" name="driver_name" id="driver_name"> 
					
					</select>
				</div>
 

				<div class="form-group col-md-6">
				    <label for="picing_type">Pricing Type</label>
				    <select class="form-control" name="picing_type" id="picing_type"> 
				    	<option value="default">Please select pricing type</option>
						<option value="1">Price per day</option>
						<option value="2">Price per hour</option>
						<option value="3">Price per Km</option>
					</select>
				</div>

				<div class="form-group col-md-3">
				    <label for="res_qty" id="res_qty_label">Reservation</label>
				   	<input type="number" name="res_qty" value="1" class="form-control" id="res_qty" />
				 
				</div>

				<div class="form-group col-md-6">
				     <h4>Total Price: Rs <span id="price">0</span></h4>
				</div>
				
			</div>

			 
			 
			 
						 
			
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Reservation </button> 

		  	<a href="<?php echo base_url(); ?>index.php/car_controller/view_cars" class="btn btn-secondary">Cancel</a> 
			 
		</form>

	</div>
</div>

<?php $this->load->view('footer'); ?>


<script>
	$(document).ready(function () {  
		
		var pricing_type = {}
		var total = 0;
		var pricing_value = 0;
		/* Get car types */

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_types_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			$('#car_type').append('<option value="default">Select car type</option>') 

    			for (var i = 0; i < output.data.length; i++) {

    				$('#car_type').append('<option value='+output.data[i].car_type_id+'>'+output.data[i].car_type+'</option>') 
    			}  
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});


		/* Get customers */

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/customer_controller/get_all_active_customer_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			$('#customer_name').append('<option value="default">Select Customer</option>') 

    			for (var i = 0; i < output.data.length; i++) {

    				$('#customer_name').append('<option value='+output.data[i].customer_id+'>'+output.data[i].f_name+' '+output.data[i].l_name+' - '+output.data[i].contact_no+'</option>') 
    			}  
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});



    	/* Get driver */

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/driver_controller/get_all_active_driver_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			$('#driver_name').append('<option value="default">Select driver</option>') 

    			for (var i = 0; i < output.data.length; i++) {

    				$('#driver_name').append('<option value='+output.data[i].driver_id+'>'+output.data[i].first_name+' '+output.data[i].last_name+'</option>') 
    			}  
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});


		
		/* Get plate no by car type */

    	$('#car_type').on('change', function() {

		 	$.ajax({
	    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_type_by_car_id_data',
	    		type: 'POST',  
	    		data: {car_type_id: this.value}
	    	})
	    	.done(function(data) {

	    		var output = JSON.parse(data); 
	    		 
	    		if (output.status == 200) {  
 
					$('#plate_no').html('');

	    			for (var i = 0; i < output.data.length; i++) {
 
	    				$('#plate_no').append('<option value='+output.data[i].car_id+'>'+output.data[i].plate_id+' - '+output.data[i].model+'</option>') 
	    			}  
	    		}

	    	})
	    	.fail(function() {
	    		console.log("error");
	    	}); 


	    	/* Get Pricing By Car Id */

	    	$.ajax({
	    		url: '<?php echo base_url(); ?>index.php/pricing_controller/get_latest_pricing_by_car_type_data',
	    		type: 'POST',  
		    	data: {car_type_id: this.value}

	    	})
	    	.done(function(data) {

	    		var output = JSON.parse(data);
	    	 
	    		 
	    		if (output.status == 200) {   

	    			pricing_type = {
						price_per_day: output.data.price_per_day,
						price_per_hour: output.data.price_per_hour,
						price_per_km: output.data.price_per_km,
					}  
	    		}
 


	    	})
	    	.fail(function() {
	    		console.log("error");
	    	});

		});
		

		$('#picing_type').on('change', function() { 
			 
			 if(this.value == '1') {
				$('#res_qty_label').html('No of Days');  
				pricing_value = pricing_type.price_per_day;  

			 }else if(this.value == '2'){
				$('#res_qty_label').html('No of Hours');
				pricing_value = pricing_type.price_per_hour;
				
			 }else{
				$('#res_qty_label').html('No of Kms'); 
				pricing_value = pricing_type.price_per_km; 
			 }

			total = pricing_value * parseInt($('#res_qty').val());
			$('#price').html(total); 

		});



		$('#res_qty').on('change', function() { 

			total = pricing_value * parseInt($('#res_qty').val());
			$('#price').html(total);

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


		$.validator.addMethod("valueNotEquals", function(value, element, arg){
		  return arg !== value;
		}, "Please select an option.");


    	$('#myform').validate({ 
   
   	        rules: {
	            customer_name: {
	                valueNotEquals: "default" 
	            }, 

	            car_type: {
	               valueNotEquals: "default" 
	            },

	            plate_no: {
	             	required: true, 
	               valueNotEquals: "default"
	            },

	            driver_name: {
	            	valueNotEquals: "default",
	                required: true, 
	            },

	            picing_type: {
	            	valueNotEquals: "default",
	                required: true, 
	            },
	        }, 

	        submitHandler: function(form) { 
	    
	    //     	var data = {
					// plate_id: $('#plate_id').val(),
					// model: $('#model').val(),
					// color: $('#color').val(),
					// car_type: $('#car_type').val(),
					// engine: $('#engine').val(),
					// year: $('#year').val(),
					// fuel_types: $('#fuel_types').val(),
					// passengers: $('#passengers').val(),
	    //     	}
 
	     //    	$.ajax({
	     //    		url: '<?php echo base_url(); ?>index.php/car_controller/add_car_data',
	     //    		type: 'POST', 
	     //    		data: data,
	     //    	})
	     //    	.done(function(data) {

	     //    		$('#add_car_type').val('');
 					
 					// var output = JSON.parse(data);
	        		 
	     //    		if (output.status == 200) { 
	     //    			$('.alert-success').removeClass('d-none'); 
	     //    			$('#myform')[0].reset();
	     //    		}

	     //    	})
	     //    	.fail(function() {
	     //    		console.log("error");
	     //    	}); 
			
			}
	    });

   	});

</script>