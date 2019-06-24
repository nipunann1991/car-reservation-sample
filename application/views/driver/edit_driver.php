<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Edit Driver Details</h2>
 
		</div>
		 
		<form  id="myform" class="col-md-9 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Driver details edited successfully.
			</div> 

			<div class="row">
				<div class="form-group col-md-6">
				    <label for="first_name">First Name</label>
				    <input type="text" name="first_name" class="form-control" id="first_name">
				</div> 
				<div class="form-group col-md-6">
				    <label for="last_name">Last Name</label>
				    <input type="text" name="last_name" class="form-control" id="last_name">
				</div>  
				
			</div>
			<div class="row">  
				<div class="form-group col-md-6">
				    <label for="licence_no">Licence No</label>
				    <input type="text" name="licence_no" class="form-control" id="licence_no">
				</div>  
				<div class="form-group col-md-6">
				    <label for="nic">NIC no</label>
				    <input type="text" name="nic" class="form-control" id="nic">
				</div> 
			</div>

			<div class="row">
				<div class="form-group col-md-12">
				    <label for="address">Address</label>
				    <textarea name="address" id="address" class="form-control" cols="30" rows="4"></textarea>
				</div>

				<div class="form-group col-md-6">
				    <label for="email">Email</label>
				    <input type="text" name="email" class="form-control" id="email">
				</div>

				<div class="form-group col-md-6">
				    <label for="contact_no">Contact No</label>
				    <input type="text" name="contact_no" class="form-control" id="contact_no">
				</div>  
				
			</div>
   
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Driver </button> 

		  	<a href="<?php echo base_url(); ?>index.php/driver_controller/view_drivers" class="btn btn-secondary">Close</a> 
			 
		</form>

	</div>
</div>

<?php $this->load->view('footer'); ?>


<script>
	$(document).ready(function () {  
		 
		/* Get Car Data */
		
		setTimeout(function(){
			
	    	$.ajax({
				url: '<?php echo base_url(); ?>index.php/driver_controller/get_single_driver_data',
        		type: 'POST', 
        		data: { driver_id: getQueryVariable("driver_id")},
			})
			.done(function(data) {
				
	 			var output = JSON.parse(data); 
	 			console.log(output);
 

	 			if (output.status == 200) {
					$('#first_name').val(output.data.first_name);
					$('#last_name').val(output.data.last_name);
					$('#licence_no').val(output.data.licence_no);
					$('#nic').val(output.data.nic);
					$('#address').val(output.data.address);
					$('#email').val(output.data.email);
					$('#contact_no').val(output.data.contact_no);  
 
	 			}

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		},200)

		/* Validate Form */

    	$('#myform').validate({ 

	        rules: {
	            first_name: {
	                required: true, 
	            }, 

	            last_name: {
	                required: true, 
	            },

	            licence_no: {
	                required: true, 
	            },

	            nic: {
	                required: true, 
	            },

	            address: {
	                required: true, 
	            },

	            email: {
	                required: true, 
	            },

	            contact_no: {
	                required: true, 
	            },
	        },

	        submitHandler: function(form) { 
	    
	        	var data = {
	        		driver_id: getQueryVariable("driver_id"),
					first_name: $('#first_name').val(),
					last_name: $('#last_name').val(),
					licence_no: $('#licence_no').val(),
					nic: $('#nic').val(),
					address: $('#address').val(),
					email: $('#email').val(),
					contact_no: $('#contact_no').val(),
	        	}
 
	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/driver_controller/edit_driver_data',
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

	    function getQueryVariable(variable){
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       for (var i=0;i<vars.length;i++) {
	               var pair = vars[i].split("=");
	               if(pair[0] == variable){return pair[1];}
	       }
	       return(false);
		} 

   	});

</script>