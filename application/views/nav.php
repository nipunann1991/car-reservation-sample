<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<div class="container">
		<a class="navbar-brand" href="<?php echo base_url(); ?>index.php/home_controller/">Car Reservation</a> 

		<ul class="navbar-nav ml-auto">
		 
		    <li class="nav-item">
		      	<a class="nav-link" href="<?php echo base_url(); ?>index.php/reservations_controller/view_reservations">Reservations</a>
		    </li>  
		    <li class="nav-item dropdown">
		     	<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Users</a>
		      	<div class="dropdown-menu">
		      		<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/customer_controller/view_customers">Customers</a> 
		      		<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/driver_controller/view_drivers">Drivers</a>  
		      	</div>
		    </li>
		    
		    <li class="nav-item dropdown">
		     	<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
		        Cars
		      	</a>
		      	<div class="dropdown-menu">
		      		<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/car_controller/view_car_types">Car Types</a> 
		      		<a class="dropdown-item" href="<?php echo base_url(); ?>index.php/car_controller/view_cars">Registered Cars</a>  
		      	</div>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href="<?php echo base_url(); ?>index.php/pricing_controller/view_pricing">Pricing</a>
		    </li> 
		  	<li class="nav-item">
		      	<a class="nav-link" href="<?php echo base_url(); ?>index.php/pricing_controller/view_pricing">Reports</a>
		    </li> 
		    <li class="nav-item user_name">
		    	<a class="nav-link" href="javascript:void(0);">Hello, <?php echo $this->session->userdata('username'); ?>
		    	</a> 
		    </li>
		    <li class="nav-item">
		    	<form action="<?php echo base_url(); ?>index.php/login_controller/logout" >
		    		<button class="btn btn-danger" type="submit">Logout</button>
		    	</form>
		    </li>
		</ul> 
	</div>
</nav>