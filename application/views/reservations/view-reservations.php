<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>View Reservations</h2> 

			<a href="<?php echo base_url(); ?>index.php/reservations_controller/add_reservations" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Reservations</a>
		</div> 

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Id</th> 
			        <th>Date</th> 
			        <th>Customer Name</th>
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
          	<li><label for="car_type">Car Type</label> <span id="car_type"></span></li>
          	<li><label for="driver">Driver</label> <span id="first_name"></span> <span id="last_name"></span></li>
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
    		url: '<?php echo base_url(); ?>index.php/reservations_controller/get_all_reservations_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				var total = 0;

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
    				}else{
						label = '<span class="badge badge-danger">Canceled</span>' 
    				}


    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].res_id+`</td>
					        <td>`+output.data[i].res_date+`</td>
					        <td>`+output.data[i].f_name+` `+output.data[i].l_name+`</td>
					        <td>`+output.data[i].plate_id+`</td>
					        <td>`+output.data[i].first_name+` `+output.data[i].last_name+`</td>
					        <td>`+total+`</td>  
					        <td>`+label+`</td> 
					        <td>  
					        	<a href="#" data-toggle="modal" onclick="view_reservation(`+output.data[i].res_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a>
					        	<a href="<?php echo base_url(); ?>index.php/pricing_controller/edit_pricing/?pricing_id=`+output.data[i].res_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].res_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
					        	</a> 
					        </td>
				      	</tr>`);

    			}  

    			$('table').DataTable();
    			
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
				$('#first_name').html(output.data.first_name);  
				$('#last_name').html(output.data.last_name);  


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