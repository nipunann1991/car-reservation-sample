<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 



<div class="container-fluid">  

	<div class="container"> 
		
		<div class="row">
			<div class="col-md-12">
				<h2>System Stats</h2>
			</div>
			<div class="col-md-3">
				<p>Reservarions</p>
			</div>
			<div class="col-md-3">
				<p>Cars</p>
			</div>
			<div class="col-md-3">
				<p>Users</p>
			</div>
			<div class="col-md-3">
				<p>Settings</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h2>Categories</h2>
			</div>
			<div class="col-md-3">
				<p>Reservarions</p>
			</div>
			<div class="col-md-3">
				<p>Cars</p>
			</div>
			<div class="col-md-3">
				<p>Users</p>
			</div>
			<div class="col-md-3">
				<p>Settings</p>
			</div>
		</div>

	</div>
</div>


 
<?php $this->load->view('footer'); ?>

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