<?php
	defined('BASEPATH') OR exit('No direct script access allowed');  
?>

<?php $this->load->view('header');  ?> 

<?php $this->load->view('nav');  ?> 

<div class="container-fluid page">  
	<div class="container">

		<div class="top-header">
			<h2>View Customers</h2> 

			<a href="<?php echo base_url(); ?>index.php/customer_controller/add_customers" class="btn btn-primary add_button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Customers</a>
		</div> 

		<table class="table editable_table">
		    <thead>
		      	<tr>
			        <th>Id</th> 
			        <th>Customer Name</th>  
			        <th>Address</th>  
			        <th>Contact</th>  
			        <th>Status</th> 
			        <th></th> 
			         
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
          <h4 class="modal-title">Customer Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> 
        <div class="modal-body">
          <ul>
          	<li><label for="first_name">Name</label> <span id="first_name"></span> <span id="last_name"></span></li>  
          	<li><label for="nic">NIC no</label> <span id="nic"></span></li>
          	<li><label for="address">Address</label> <span id="address"></span></li>
          	<li><label for="email">Email</label> <span id="email"></span></li>
          	<li><label for="contact_no">Contact No</label> <span id="contact_no"></span></li>
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
    		url: '<?php echo base_url(); ?>index.php/customer_controller/get_all_customer_data',
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
					        <td>`+output.data[i].customer_id+`</td>
					        <td>`+output.data[i].f_name+" "+output.data[i].l_name+`</td> 
					        <td>`+output.data[i].address+`</td> 

					        <td>`+output.data[i].contact_no+`</td> 
					        <td>`+label+`</td> 
					        <td>  
					        	<a href="#" data-toggle="modal" onclick="view_customer(`+output.data[i].customer_id+`)" class="edit_item"><i class="fa fa-eye" aria-hidden="true"></i> View
					        	</a> 
					        	<a href="<?php echo base_url(); ?>index.php/customer_controller/edit_customers/?customer_id=`+output.data[i].customer_id+`" class="edit_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					        	</a> 
					        	<a href="javascript:void(0)" data-id="`+output.data[i].customer_id+`" class="delete_item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
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
			        		url: '<?php echo base_url(); ?>index.php/customer_controller/delete_customer_data',
			        		type: 'POST', 
			        		data: {customer_id: id},
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


 	function view_customer(id){
		 
		$("#myModal").modal();

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/customer_controller/get_single_customer_data',
    		type: 'POST', 
    		data: { customer_id: id},
		})
		.done(function(data) {
			
 			var output = JSON.parse(data); 
 			console.log(output);


 			if (output.status == 200) {

				$('#first_name').html(output.data.f_name);
				$('#last_name').html(output.data.l_name); 
				$('#nic').html(output.data.nic);
				$('#address').html(output.data.address);
				$('#email').html(output.data.email_addr);
				$('#contact_no').html(output.data.contact_no);  
				
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