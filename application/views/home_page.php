<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php include 'header.php'; ?> 

<div class="container-fluid">
	<div class="container">
		 
		 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius reprehenderit delectus in incidunt at, quis molestiae! Omnis nostrum odio veritatis libero adipisci neque dolor, consequatur tenetur rerum, recusandae, in fugit.</p>

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