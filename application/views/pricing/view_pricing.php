<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>View Pricing</h2> 

			<a href="<?php echo base_url(); ?>index.php/pricing_controller/add_pricing" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Pricing</a>
		</div> 

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Id</th> 
			        <th>Car Type</th> 
			        <th>P/P Day</th>
			        <th>P/P Hour</th>
			        <th>P/P Km</th> 
			        <th>Effect From</th> 
			        <th> </th>
		      	</tr>
		    </thead>
		    <tbody> 

		    </tbody>
		</table>

	</div>
</div>
 

<?php $this->load->view('footer'); ?>

<script> 

	$(document).ready(function () {  

	    $.ajax({
    		url: '<?php echo base_url(); ?>index.php/pricing_controller/get_all_pricing_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].pricing_id+`</td>
					        <td>`+output.data[i].car_type+`</td>
					        <td>`+output.data[i].price_per_hour+`</td>
					        <td>`+output.data[i].price_per_day+`</td>
					        <td>`+output.data[i].price_per_km+`</td>
					        <td>`+output.data[i].update_date+`</td> 
					        <td>  
					        	<a href="<?php echo base_url(); ?>index.php/pricing_controller/edit_pricing/?pricing_id=`+output.data[i].pricing_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].car_type_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
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


    function view_car(id){
		 
		$("#myModal").modal();

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/car_controller/get_single_car_data',
    		type: 'POST', 
    		data: { car_id: id},
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 
 			console.log(output);


 			if (output.status == 200) {

				$('#plate_id').html(output.data.plate_id);
				$('#model').html(output.data.model);
				$('#color').html(output.data.color);
				$('#engine').html(output.data.engine);
				$('#year').html(output.data.year);
				$('#car_type').html(output.data.car_type);
				$('#fuel_types').html(output.data.fuel_name);  
				$('#no_of_passegers').html(output.data.no_of_passegers);  


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