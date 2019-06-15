<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Registered Cars</h2> 

			<a href="<?php echo base_url(); ?>index.php/car_controller/add_car" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Car</a>
		</div> 

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Plate ID</th>
			        <th>Model</th>
			        <th>Car Type</th>
			        <th>Color</th>
			        <th>Year</th>
			        <th>Engine</th>
			        <th>Fuel Type</th>
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
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].plate_id+`</td>
					        <td>`+output.data[i].model+`</td>
					        <td>`+output.data[i].car_type+`</td>
					        <td>`+output.data[i].color+`</td>
					        <td>`+output.data[i].year+`</td>
					        <td>`+output.data[i].engine+`cc</td>
					        <td>`+output.data[i].fuel_name+`</td>
					        <td> 
					        	<a href="<?php echo base_url(); ?>index.php/car_controller/edit_car/?car_id=`+output.data[i].car_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].car_type_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
					        	</a> 
					        </td>
				      	</tr>`);

    			}  
    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});
    })
</script>