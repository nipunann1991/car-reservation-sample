<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>Drivers List</h2> 

			<a href="<?php echo base_url(); ?>index.php/driver_controller/add_driver" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Driver</a>
		</div> 

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Driver ID</th>
			        <th>Driver Name</th>
			        <th>License ID</th>
			        <th>Contact No</th>  
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
          <h4 class="modal-title">Driver Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
          <ul>
          	<li><label for="first_name">First Name</label> <span id="first_name"></span> <span id="last_name"></span></li> 
          	<li><label for="licence_no">Licence No</label> <span id="licence_no"></span></li> 
          	<li><label for="nic">NIC no</label> <span id="nic"></span></li>
          	<li><label for="address">Address</label> <span id="address"></span></li>
          	<li><label for="email">Email</label> <span id="email"></span></li>
          	<li><label for="contact_no">Contact No</label> <span id="contact_no"></span></li>
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
    		url: '<?php echo base_url(); ?>index.php/driver_controller/get_all_driver_data',
    		type: 'POST',  
    	})
    	.done(function(data) {

    		var output = JSON.parse(data);
    		console.log(output);
    		 
    		if (output.status == 200) {  

    			for (var i = 0; i < output.data.length; i++) {

    				 
    				$('.editable_table tbody').append(`
	    				<tr>
					        <td>`+output.data[i].driver_id+`</td>
					        <td>`+output.data[i].first_name+" "+ output.data[i].last_name+`</td>
					        <td>`+output.data[i].licence_no+`</td>
					        <td>`+output.data[i].contact_no+`</td> 
					        <td> 
					        	<a href="#" data-toggle="modal" onclick="view_driver(`+output.data[i].driver_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a> 
					        	<a href="<?php echo base_url(); ?>index.php/driver_controller/edit_driver/?driver_id=`+output.data[i].driver_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].driver_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
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

    function view_driver(id){
		 
		$("#myModal").modal();

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/driver_controller/get_single_driver_data',
    		type: 'POST', 
    		data: { driver_id: id},
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 
 			console.log(output);


 			if (output.status == 200) {

				$('#first_name').html(output.data.first_name);
				$('#last_name').html(output.data.last_name);
				$('#licence_no').html(output.data.licence_no);
				$('#nic').html(output.data.nic);
				$('#address').html(output.data.address);
				$('#email').html(output.data.email);
				$('#contact_no').html(output.data.contact_no);  

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