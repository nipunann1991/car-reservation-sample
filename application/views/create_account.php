<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php include 'header.php'; ?> 

<div class="container-fluid">
	<div class="container">
		 
		<form action="#" class="login create_account" id="myform">
			<h1>Create Account</h1>
			<div class="alert alert-success alert-dismissible d-none">
			  <strong>Success!</strong> Account created successfully. Please login to your account
			</div> 	

			<div class="alert alert-danger alert-dismissible d-none">
			  <strong>Error!</strong> Your email exist in the system. Please contact system administration if you have trouble to login.
			</div> 

			<div class="login_inner">
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
				    <label for="user_password">Password</label>
				    <input type="password" name="user_password"  class="form-control" id="user_password">
				</div>

				<div class="form-group">
				    <label for="confirm_password">Confirm Password</label>
				    <input type="password" name="confirm_password"  class="form-control" id="confirm_password">
				</div>
			   
			  	<button type="submit" class="btn btn-primary" id="login_btn">Create Account</button>
			</div>
			<div class="create_account_link">
				<p>Back to <a href="<?php echo base_url(); ?>index.php/login_controller/login" class="">Login</a></p>
			</div>
			 
		</form>

	</div>
</div>


 
<?php include 'footer.php'; ?>

<script>
	$(document).ready(function () { 

		 
		

	  //  /* Validate Form */

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
 

                user_password: {
	                required: true, 
	                minlength: 6,
	            }, 

                confirm_password: {
                    equalTo: "#user_password"
                }


	        },

         	messages: {
                user_password: " Enter password with minimum 6 characters",
                confirm_password: " Enter Confirm Password Same as Password"
            },

	        submitHandler: function(form) { 
	    
	        	var data = {
	        		first_name: $('#first_name').val(), 
					last_name: $('#last_name').val(),
					email_addr: $('#email_addr').val(),
					addr: $('#addr').val(), 
					contact_no: $('#contact_no').val(), 
					nic: $('#nic').val(), 
					user_password: $('#user_password').val(), 
					status: 1, 
	        	}
 
	        	$.ajax({
	        		url: '<?php echo base_url(); ?>index.php/login_controller/cerate_account',
	        		type: 'POST', 
	        		data: data,
	        	})
	        	.done(function(data) {
  
 					var output = JSON.parse(data);
	        		
	        		if (output.status == 200) { 
	        			$('.alert-danger').addClass('d-none');  
	        			$('.alert-success').removeClass('d-none'); 
	        			$('#myform')[0].reset();
	        			$( window ).scrollTop( 0 );

	        		}else if (output.status == 500){
	        			$('.alert-danger').removeClass('d-none');  
	        			$( window ).scrollTop( 0 );
	        		}

	        	})
	        	.fail(function() {
	        		console.log("error");
	        	}); 
			
			}
	    });

	});
</script>