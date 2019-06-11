<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Edit Car Type</h2> 
		</div>

		<form  id="myform" class="col-md-6 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Car type added successfully.
			</div> 
						 
			<div class="form-group">
			    <label for="add_car_type">Edit Car Type</label>
			    <input type="text" name="add_car_type" class="form-control" id="add_car_type">
			</div>
		   
		  	<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Car Type</button> 

		  	<a href="<?php echo base_url(); ?>index.php/car_controller/view_car_types" class="btn btn-secondary">Cancel</a> 
			 
		</form>
		
 

	</div>
</div>

<?php $this->load->view('footer'); ?>

<script>
	$(document).ready(function () { 

		



		$.ajax({
			url: '<?php echo base_url(); ?>index.php/car_controller/get_single_car_type_data',
	        		type: 'POST', 
	        		data: { car_type_id: getQueryVariable("car_type_id")},
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 

 			if (output.status == 200) {
				$('#add_car_type').val(output.data.car_type);
 			}

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});


		

	    $('#myform').validate({ // initialize the plugin
	        rules: {
	            add_car_type: {
	                required: true, 
	            }, 
	        },

	        submitHandler: function(form) { 
	    
	        	var data = {
					car_type: $('#add_car_type').val(),
					car_type_id: getQueryVariable("car_type_id")
	        	}

	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/car_controller/edit_car_type_data',
	        		type: 'POST', 
	        		data: data,
	        	})
	        	.done(function(data) {

	        	 
 					
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