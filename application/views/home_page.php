<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 



<div class="container-fluid page">  

	<div class="container"> 
		
		<div class="row stats_row">
			 
			<div class="col-md-3">
				<div class="box btn-danger">
					<p>Reservations</p>
					<span class="value" id="total_reservations">-</span>
				</div> 
			</div>
			<div class="col-md-3">
				<div class="box btn-primary">
					<p>Registered Cars</p>
					<span class="value" id="total_cars">-</span>
				</div> 
			</div>
			<div class="col-md-3">
				<div class="box btn-success">
					<p>Users</p>
					<span class="value" id="total_users">-</span>
				</div> 
			</div>
			<div class="col-md-3">
				<div class="box btn-warning">
					<p>Drivers</p>
					<span class="value" id="total_drivers">-</span>
				</div> 
			</div>
		</div>
		
		<div class="row stats_row">
			<div class="col-md-6">
				<div class="box">
					<h4>Latest 5 Customers</h4>

					<table class="table editable_table1">
					    <thead>
					      	<tr>
						        <th>Id</th> 
						        <th>Customer Name</th>  
						        <th>Status</th>   
					      	</tr>
					    </thead>
					    <tbody> 

					    </tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6 ">
				<div class="box">
					<h4>Pricing</h4>
		
					<table class="table editable_table2">
					    <thead>
					      	<tr> 
						        <th>Car Type</th> 
						        <th>P/P Day</th>
						        <th>P/P Hour</th>
						        <th>P/P Km</th> 
					      	</tr>
					    </thead>
					    <tbody> 

					    </tbody>
					</table>
				</div>
			</div>			
		</div>

	</div>
</div>


 
<?php $this->load->view('footer'); ?>

<script>
	$(document).ready(function () { 
		
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/home_controller/get_stats',
    		type: 'POST',  
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 
 			console.log(output);

 			$('#total_reservations').html(output.total_reservations)
 			$('#total_cars').html(output.total_cars)
 			$('#total_users').html(output.total_users)
 			$('#total_drivers').html(output.total_drivers)

		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});


		$.ajax({
    		url: '<?php echo base_url(); ?>index.php/pricing_controller/get_all_pricing_data_dashboard',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('.editable_table2 tbody').append(`
	    				<tr> 
					        <td>`+output.data[i].car_type+`</td>
					        <td>`+output.data[i].price_per_hour+`</td>
					        <td>`+output.data[i].price_per_day+`</td>
					        <td>`+output.data[i].price_per_km+`</td> 
					        
				      	</tr>`);

    			}  

    			 
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});



    	$.ajax({
    		url: '<?php echo base_url(); ?>index.php/customer_controller/get_latest_customer_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				var label = ''

    				if (output.data[i].status == 1) {
						label = '<span class="badge badge-success">Active</span>'
    				}else{
						label = '<span class="badge badge-danger">Inctive</span>' 
    				}

    				$('.editable_table1 tbody').append(`
	    				<tr>
					        <td>`+output.data[i].customer_id+`</td>
					        <td>`+output.data[i].f_name+" "+output.data[i].l_name+`</td>  
					        <td>`+label+`</td>  
				      	</tr>`);

    			}  
 
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});

	});
</script>