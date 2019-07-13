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
          <h4 class="modal-title">Car Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
          <ul>
          	<li><label for="plate_id">Plate ID</label> <span id="plate_id"></span></li> 
          	<li><label for="model">Model</label> <span id="model"></span></li> 
          	<li><label for="color">Color</label> <span id="color"></span></li> 
          	<li><label for="car_type">Car Type</label> <span id="car_type"></span></li>
          	<li><label for="engine">Engine</label> <span id="engine"></span></li>
          	<li><label for="year">Year</label> <span id="year"></span></li>
          	<li><label for="fuel_types">Fuel Type</label> <span id="fuel_types"></span></li>
          	<li><label for="no_of_passegers">Max Passengers</label> <span id="no_of_passegers"></span></li>
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
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_data',
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

    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].plate_id+`</td>
					        <td>`+output.data[i].model+`</td>
					        <td>`+output.data[i].car_type+`</td>
					        <td>`+output.data[i].color+`</td>
					        <td>`+output.data[i].year+`</td>
					        <td>`+output.data[i].engine+`cc</td>
					        <td>`+output.data[i].fuel_name+`</td>
					        <td>`+label+`</td>
					        <td> 
					        	<a href="#" data-toggle="modal" onclick="view_car(`+output.data[i].car_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a>
					        	<a href="<?php echo base_url(); ?>index.php/car_controller/edit_car/?car_id=`+output.data[i].car_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].car_type_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
					        	</a> 
					        </td>
				      	</tr>`);

    			}  

    			$('table').DataTable({

			        dom: 'Bflrtip',
			        buttons: [
			            {
				            extend: 'copy',
				            text: '<h5>Export Report to :</h5>'
				        }, 
				        'csv', 'excel', 'pdf', 'print'
					]
			    });
    			
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

				var label = '';

				if (output.data.status == 1) {
					label = '<span class="badge badge-success">Active</span>'
				}else{
					label = '<span class="badge badge-danger">Inctive</span>' 
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