<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php include 'header.php'; ?> 

<div class="container-fluid">
	<div class="container">
		 
		<form action="<?php echo base_url(); ?>index.php/login_controller/check_user_details" class="login" id="myform">
			<h1>Login to Car Reservation</h1>

			<div class="login_inner">
				<div class="form-group">
				    <label for="email_addr">Email address</label>
				    <input type="email" name="email"  class="form-control" id="email_addr" >
				</div>
			  	<div class="form-group">
				    <label for="password">Password</label>
				    <input type="password" name="password" class="form-control" id="password" >
			  	</div> 
			  	 
			  	<button type="submit" class="btn btn-primary" id="login_btn">Login</button>
			</div>
			<div class="create_account_link">
				<p>Don't have an account? <a href="<?php echo base_url(); ?>index.php/login_controller/create_account" class="">Create Account</a></p>
			</div>
			 
		</form>

	</div>
</div>


 
<?php include 'footer.php'; ?>

<script>
	$(document).ready(function () { 

		//$("#login_btn").attr('type', 'button');

		// $('#login_btn').click(function(event) {
		// 	/* Act on the event */ 
		// 	event.preventDefault();
			
		// 	window.location = "http://localhost:81/car-reservation-system/index.php/home_controller";
		// });

	    $('#myform').validate({ // initialize the plugin
	        rules: {
	            email: {
	                required: true,
	                email: true
	            },
	            password: {
	                required: true,
	                minlength: 5
	            }
	        },
	        submitHandler: function(form) { 
	        	// call ajax 
	        	form.submit();
			
			}
	    });

	});
</script>