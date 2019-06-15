<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Car Types</h2>

			<a href="<?php echo base_url(); ?>index.php/car_controller/add_car_types" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Car Type</a>
		</div> 
		
		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Type ID</th>
			        <th>Car Type</th>
			        <th>Actions</th>
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
    		url: '<?php echo base_url(); ?>index.php/car_controller/get_all_car_types_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].car_type_id+`</td>
					        <td>`+output.data[i].car_type+`</td>
					        <td> 
					        	<a href="<?php echo base_url(); ?>index.php/car_controller/edit_car_types/?car_type_id=`+output.data[i].car_type_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].car_type_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
					        	</a> 
					        </td>
				      	</tr>`);
    			}

    			if (output.data.length == 0) {
    				$('.editable_table tbody').append(`<tr>
					        <td></td>
					        <td>No data to be displayed</td>
					        <td></td>
				      	</tr>`);
    			}

    			
    		}

    	})
    	.fail(function() {
    		console.log("error");
    	});

 


		$('html .editable_table tbody').on('click', '.delete_item', function(event) {
			event.preventDefault();

			var id = $(this).attr('data-id');
		 
			bootbox.confirm({
				title: "Delete Item",
			    message: "Do you want to delete this? This cannot be undone.",
			    buttons: {
			        cancel: {
			            label: 'Cancel'
			        },
			        confirm: {
			            label: 'Delete'
			        }
			    },
			    callback: function (result) {
			        
			        if (result) {

			        	$.ajax({
			        		url: '<?php echo base_url(); ?>index.php/car_controller/delete_car_type_data',
			        		type: 'POST', 
			        		data: {car_type_id: id},
			        	})
			        	.done(function(data) {

			        		var output = JSON.parse(data);
    		 
    						if (output.status == 200) { 
								location.reload();
    						} 

			        		
			        	})
			        	.fail(function() {
			        		console.log("error");
			        	}) 

			        }
			    }
			});
			
		});

    	 

	});
</script>