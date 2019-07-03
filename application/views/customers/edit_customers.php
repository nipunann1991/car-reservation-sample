<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Add New Customer</h2> 
		</div>
		 
		<form  id="myform" class="col-md-7 box_form" novalidate="novalidate"> 

			<div class="alert alert-success alert-dismissible d-none">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>Success!</strong> Customer details added successfully.
			</div> 

		 
				<div class="row">
					<div class="form-group col-md-6">
					    <label for="first_name">First Name</label>
					    <input type="text" name="first_name"  class="form-control" id="first_name">
					</div>

					<div class="form-group col-md-6">
					    <label for="last_name">Last Name</label>
					    <input type="text" name="last_name"  class="form-control" id="last_name">
					</div>
				</div>

				<div class="form-group">
				    <label for="email_addr">Email Address</label>
				    <input type="text" name="email_addr"  class="form-control" id="email_addr">
				</div>

				<div class="form-group">
				    <label for="addr">Address</label>
				    <textarea name="addr" id="addr" class="form-control"  cols="30" rows="5">				    	
				    </textarea>
				</div>

				<div class="form-group">
				    <label for="contact_no">Contact No</label>
				    <input type="text" name="contact_no"  class="form-control" id="contact_no">
				</div>

				<div class="form-group">
				    <label for="nic">NIC Number</label>
				    <input type="text" name="nic"  class="form-control" id="nic">
				</div>
				<div class="form-group"> 
				    <input type="checkbox" id="active" name="active" value=""> Active 
				</div>

				 
 
			   
			  	<button type="submit" class="btn btn-primary" id="login_btn">Edit Account</button>

			  	<a href="<?php echo base_url(); ?>index.php/customer_controller/view_customers" class="btn btn-secondary">Cancel</a> 
			 
			 
		</form>

	</div>
</div>

<?php $this->load->view('footer'); ?>


<script>
	$(document).ready(function () {  


		$.ajax({
			url: '<?php echo base_url(); ?>index.php/customer_controller/get_single_customer_data',
    		type: 'POST', 
    		data: { customer_id: getQueryVariable("customer_id")},
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 
 			console.log(output);


 			if (output.status == 200) {
				 

				$('#first_name').val(output.data.f_name); 
				$('#last_name').val(output.data.l_name);
				$('#email_addr').val(output.data.email_addr);
				$('#addr').val(output.data.address); 
				$('#contact_no').val(output.data.contact_no); 
				$('#nic').val(output.data.nic); 

				if (output.data.status == '1') {
					$('#active').prop("checked", true);
				} 
				 
 			}

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		  
		/* Validate Form */

    	$('#myform').validate({ 

	        rules: {
	            first_name: {
	                required: true, 
	            },
	            last_name: {
	                required: true, 
	            },
	            email_addr: {
	                required: true,
	                email: true
	            },
	            addr: {
	                required: true, 
	            },
	            contact_no: {
	                required: true, 
	            }, 
	            nic: {
	                required: true, 
	            }, 
	        },

	        submitHandler: function(form) { 
	        	var status = 0

	        	if ($('#active').is(':checked')) {
	        		status = 1
	        	}else{
	        		status = 0
	        	}
	    
	        	var data = {
	        		customer_id: getQueryVariable("customer_id"),
	        		first_name: $('#first_name').val(), 
					last_name: $('#last_name').val(),
					email_addr: $('#email_addr').val(),
					addr: $('#addr').val(), 
					contact_no: $('#contact_no').val(), 
					nic: $('#nic').val(), 
					status: status, 
	        	}
 
	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/customer_controller/edit_customer_data',
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