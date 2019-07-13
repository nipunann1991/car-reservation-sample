<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h4>Hello  <?php echo $this->session->userdata('username'); ?>, Welcome again</h4>
			<h2>My Reservations</h2> 

			<a href="<?php echo base_url(); ?>index.php/user_controller/add_reservations" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Reservation</a>
		</div> 

		<nav>
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Upcoming Trips</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pending Approval</a>
		    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Previous Trips</a>
		  </div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  	
		  	<table class="table editable_table upcoming">
			    <thead>
			      	<tr>
				        <th>Id</th> 
				        <th>Date</th>  
				        <th>Car</th>
				        <th>Driver</th> 
				        <th>Trip Cost</th> 
				        <th>Status</th> 
				        <th> </th>
			      	</tr>
			    </thead>
			    <tbody> 

			    </tbody>
			</table>

		  </div>
		  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		  	<table class="table editable_table pendiing_approval">
			  	    <thead>
				      	<tr>
					        <th>Id</th> 
					        <th>Date</th>  
					        <th>Car</th>
					        <th>Driver</th> 
					        <th>Trip Cost</th> 
					        <th>Status</th> 
					        <th> </th>
				      	</tr>
				    </thead>
				    <tbody> 

				    </tbody>
				</table>
		  </div>
		  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

		  		<table class="table editable_table previous_trips">
			  	    <thead>
				      	<tr>
					        <th>Id</th> 
					        <th>Date</th>  
					        <th>Car</th>
					        <th>Driver</th> 
					        <th>Trip Cost</th> 
					        <th>Status</th> 
					        <th> </th>
				      	</tr>
				    </thead>
				    <tbody> 

				    </tbody>
				</table>

		  </div>
		</div>

		

	</div>
</div>


<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content"> 
        <div class="modal-header">
          <h4 class="modal-title">Reservation Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
          <ul>
          	<li><label for="first_name">Reservation ID</label> <span id="res_id"></span></li>  
          	<li><label for="res_date">Reservation Dates</label> <span id="res_date"></span> - <span id="res_end_date"></span></li>
          	<li><label for="f_name">Customer</label> <span id="f_name"></span> <span id="l_name"></span></li>
          	<li><label for="customer_contact">Contact No</label> <span id="customer_contact"></span> </li>
          	<hr />
          	<li><label for="plate_id">Car Plate</label> <span id="plate_id"></span></li>
          	<li><label for="car_model">Car Model</label> <span id="car_model"></span></li>
          	<li><label for="car_type">Car Type</label> <span id="car_type"></span></li>
          	<li><label for="driver">Driver</label> <span id="first_name"></span> <span id="last_name"></span></li>
          	<li><label for="selected_type">Selected Type</label> <span id="selected_type"></span></li> 
          	<li><label for="price">Price</label> <span id="price"></span></li> 
          	<li><label for="status">Status</label> <span id="status"></span></li> 
          </ul>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>
 

 

<?php $this->load->view('footer'); ?>

<script> 

	$(document).ready(function () {  

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/reservations_controller/get_reservation_data_by_customer',
    		type: 'POST',  
    		data: { customer_id: "<?php echo $this->session->userdata['customer_id'] ?>" }
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				var total = 0;


    				var res_id = output.data[i].res_id;
    				var res_date = output.data[i].res_date;
    				var name = output.data[i].f_name+` `+output.data[i].l_name;
    				var driver_name = output.data[i].first_name+` `+output.data[i].last_name;
    				var plate_id = output.data[i].plate_id; 

    				if (output.data[i].pricing_type == 1 ) {

    					total = output.data[i].price_per_day * output.data[i].pricing_qty;

    				}else if(output.data[i].pricing_type == 2 ){
						total = output.data[i].price_per_hour * output.data[i].pricing_qty;

    				}else{ 
						total = output.data[i].price_per_km * output.data[i].pricing_qty;
						
    				}
 
    				if (output.data[i].rstatus == 1) {
						label = '<span class="badge badge-success">Active</span>'
    				}else if (output.data[i].rstatus == 2) {
						label = '<span class="badge badge-primary">Completed</span>'
    				}else if (output.data[i].rstatus == -1) {
						label = '<span class="badge badge-warning">Pending</span>'
						plate_id = '-'
						driver_name = '-'
    				}else{
						label = '<span class="badge badge-danger">Canceled</span>' 
    				}


    				$('.editable_table.upcoming tbody').append(`
	    				<tr>
					        <td>`+res_id+`</td>
					        <td>`+res_date+`</td> 
					        <td>`+plate_id+`</td>
					        <td>`+driver_name+`</td>
					        <td>`+total+`</td>  
					        <td>`+label+`</td> 
					        <td>  
					        	<a href="#" data-toggle="modal" onclick="view_reservation(`+output.data[i].res_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a>
					        	 
					        </td>
				      	</tr>`);

    			}  

    			$('table.upcoming').DataTable();
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});



		$.ajax({
    		url: '<?php echo base_url(); ?>index.php/reservations_controller/get_pendiing_approval_by_customer',
    		type: 'POST',  
    		data: { customer_id: "<?php echo $this->session->userdata['customer_id'] ?>" }
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				var total = 0;


    				var res_id = output.data[i].res_id;
    				var res_date = output.data[i].res_date;
    				var name = output.data[i].f_name+` `+output.data[i].l_name;
    				var driver_name = output.data[i].first_name+` `+output.data[i].last_name;
    				var plate_id = output.data[i].plate_id; 

    				if (output.data[i].pricing_type == 1 ) {

    					total = output.data[i].price_per_day * output.data[i].pricing_qty;

    				}else if(output.data[i].pricing_type == 2 ){
						total = output.data[i].price_per_hour * output.data[i].pricing_qty;

    				}else{ 
						total = output.data[i].price_per_km * output.data[i].pricing_qty;
						
    				}
 
    				if (output.data[i].rstatus == 1) {
						label = '<span class="badge badge-success">Active</span>'
    				}else if (output.data[i].rstatus == 2) {
						label = '<span class="badge badge-primary">Completed</span>'
    				}else if (output.data[i].rstatus == -1) {
						label = '<span class="badge badge-warning">Pending</span>'
						plate_id = '-'
						driver_name = '-'
    				}else{
						label = '<span class="badge badge-danger">Canceled</span>' 
    				}


    				$('.editable_table.pendiing_approval tbody').append(`
	    				<tr>
					        <td>`+res_id+`</td>
					        <td>`+res_date+`</td> 
					        <td>`+plate_id+`</td>
					        <td>`+driver_name+`</td>
					        <td>`+total+`</td>  
					        <td>`+label+`</td> 
					        <td>  
					        	<a href="#" data-toggle="modal" onclick="view_reservation(`+output.data[i].res_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a>
					        	 
					        </td>
				      	</tr>`);

    			}  

    			$('table.pendiing_approval').DataTable();
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});

    	$.ajax({
    		url: '<?php echo base_url(); ?>index.php/reservations_controller/get_previous_trips_by_customer',
    		type: 'POST',  
    		data: { customer_id: "<?php echo $this->session->userdata['customer_id'] ?>" }
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				var total = 0;


    				var res_id = output.data[i].res_id;
    				var res_date = output.data[i].res_date;
    				var name = output.data[i].f_name+` `+output.data[i].l_name;
    				var driver_name = output.data[i].first_name+` `+output.data[i].last_name;
    				var plate_id = output.data[i].plate_id; 

    				if (output.data[i].pricing_type == 1 ) {

    					total = output.data[i].price_per_day * output.data[i].pricing_qty;

    				}else if(output.data[i].pricing_type == 2 ){
						total = output.data[i].price_per_hour * output.data[i].pricing_qty;

    				}else{ 
						total = output.data[i].price_per_km * output.data[i].pricing_qty;
						
    				}
 
    				if (output.data[i].rstatus == 1) {
						label = '<span class="badge badge-success">Active</span>'
    				}else if (output.data[i].rstatus == 2) {
						label = '<span class="badge badge-primary">Completed</span>'
    				}else if (output.data[i].rstatus == -1) {
						label = '<span class="badge badge-warning">Pending</span>'
						plate_id = '-'
						driver_name = '-'
    				}else{
						label = '<span class="badge badge-danger">Canceled</span>' 
    				}


    				$('.editable_table.previous_trips tbody').append(`
	    				<tr>
					        <td>`+res_id+`</td>
					        <td>`+res_date+`</td> 
					        <td>`+plate_id+`</td>
					        <td>`+driver_name+`</td>
					        <td>`+total+`</td>  
					        <td>`+label+`</td> 
					        <td>  
					        	<a href="#" data-toggle="modal" onclick="view_reservation(`+output.data[i].res_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a>
					        	 
					        </td>
				      	</tr>`);

    			}  

    			$('table.previous_trips').DataTable();
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});
    })


    function view_reservation(id){
		 
		$("#myModal").modal();

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/reservations_controller/get_single_reservation_data',
    		type: 'POST', 
    		data: { res_id: id},
		})
		.done(function(data) {
			var total = 0;
			var pricing_value = 0;
			var pricing_id = 0;

 			var output = JSON.parse(data); 
 			console.log(output.data);


 			if (output.status == 200) {

				$('#res_id').html(output.data.res_id);
				$('#res_date').html(output.data.res_date);
				$('#res_end_date').html(output.data.res_end_date);
				$('#l_name').html(output.data.l_name);
				$('#f_name').html(output.data.f_name);
				$('#customer_contact').html(output.data.customer_contact);
				$('#plate_id').html(output.data.plate_id);
				$('#car_type').html(output.data.car_type); 
				$('#first_name').html(output.data.first_name);  
				$('#last_name').html(output.data.last_name);  
				$('#car_model').html(output.data.model);  

				if(output.data.pricing_type == '1') {
					$('#selected_type').html('No of Days');  
					pricing_value = output.data.price_per_day;   

				}else if(output.data.pricing_type == '2'){
					$('#selected_type').html('No of Hours');
					pricing_value = output.data.price_per_hour;
					
				}else{
					$('#selected_type').html('No of Kms'); 
					pricing_value = output.data.price_per_km; 
				}

				total = parseInt(pricing_value) * parseInt(output.data.pricing_qty);
				$('#price').html( parseInt(pricing_value) +" x "+ parseInt(output.data.pricing_qty)+ " = <b>Rs. "+total+"</b>"); 
				console.log(pricing_value) 


				if (output.data.rstatus == 1) {
					label = '<span class="badge badge-success">Active</span>'
				}else if (output.data.rstatus == 2) {
					label = '<span class="badge badge-primary">Completed</span>'
				}else if (output.data.rstatus == -1) {
					label = '<span class="badge badge-warning">Pending</span>'
				}else{
					label = '<span class="badge badge-danger">Canceled</span>' 
				}

				$('#status').html(label);


 			}

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>