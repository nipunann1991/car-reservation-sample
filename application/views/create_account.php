<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php include 'header.php'; ?> 

<div class="container-fluid">
	<div class="container">
		 
		<form action="#" class="login create_account" id="myform">
			<h1>Create Account</h1>

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
				    <label for="nic">NIC Number</label>
				    <input type="text" name="nic"  class="form-control" id="nic">
				</div>

				<div class="form-group">
				    <label for="user_password">Password</label>
				    <input type="text" name="user_password"  class="form-control" id="user_password">
				</div>

				<div class="form-group">
				    <label for="confirm_password">Confirm Password</label>
				    <input type="text" name="confirm_password"  class="form-control" id="confirm_password">
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

	    $('#myform').validate({ // initialize the plugin
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
	            nic: {
	                required: true, 
	            },
	            user_password: {
	                required: true, 
	            },
	        },
	        submitHandler: function(form) { 
	        	// call ajax
			
			}
	    });

	});
</script>