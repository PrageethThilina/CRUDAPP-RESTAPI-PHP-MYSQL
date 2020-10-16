<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>REST API CRUD Application</title>

<?php include 'navbar.php' ?>
<?php include 'header.php' ?>
<link rel="stylesheet" href="css/jquery-dataTables.min.css">

<style>
.container-fluid {
	margin-top: 30px;
	margin-bottom: 30px;
}

h2 {
	margin-top: 20px;
	margin-bottom: 20px;
}

th {
	width: 400px;	
}
.header{
	background-color: rgb(11, 141, 43) !important;
}

.table {
	display: block;
	overflow-x: auto;
	overflow-y: auto;
	white-space: nowrap;
}
</style>

</head>
<body>

	<!-- View employee list -->
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<button class="btn btn-primary" style="float: right;" id="add_button">Add Employee</button>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<h2 class="text-center">Employee List</h2>

				<table
					class="table table-hover table-bordered table-responsive table-success"
					id="emp_table">
					<thead>
						<tr>
							<th class="text-center header">ID</th>
							<th class="text-center header">First Name</th>
							<th class="text-center header">Last Name</th>
							<th class="text-center header">Date of Birth</th>
							<th class="text-center header">Section</th>
                            <th class="text-center header">Phone</th>
							<th class="text-center header">Email</th>
							<th class="text-center header">Address</th>
							<th class="text-center header">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

    <!-- modal -->
    <div id="apicrudModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="api_crud_form">
                    <div class="modal-header">
                    <h4 class="modal-title text-left">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="emp_fname"  name="emp_fname" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="emp_lname" name="emp_lname" placeholder="Last name"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Date of Birth</label>
                            <input type="date" class="form-control" id="emp_dob" name="emp_dob" placeholder="dd/mm/yyyy"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Section</label>
                            <select class="form-control" id="emp_section" name="emp_section" placeholder="eg: packing"  required>
                                <option value="" selected>Choose an option</option>
                                <option value="Packing">Packing</option>
                                <option value="Cutting">Cutting</option>
                                <option value="Mixing">Mixing</option>
                                <option value="Stores">Stores</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="user@gmail.com"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="tel" class="form-control" id="emp_phone" name="emp_phone" placeholder="071 6925322"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea rows="3" class="form-control" id="emp_address" name="emp_address" placeholder="Address"  required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="hidden" name="action" id="action" value="insert" />
                        <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

	<script type="text/javascript">

		$(document).ready(function() {

            fetch_data();

            function fetch_data()
            {
                $.ajax({
                    url:"fetch_action.php",
                    success:function(data)
                    {
                        $('tbody').html(data);
                    }
                })
            }

            $('#add_button').click(function(){
                $('#action').val('insert');
                $('#button_action').val('Insert');
                $('.modal-title').text('Add Data');
                $('#apicrudModal').modal('show');
            });

            $('#api_crud_form').on('submit', function(event){
                event.preventDefault();
                if($('#emp_fname').val() == '')
                {
                    alert("Enter First Name");
                }
                else if($('#emp_lname').val() == '')
                {
                    alert("Enter Last Name");
                }
                else if($('#emp_dob').val() == '')
                {
                    alert("Enter DOB");
                }
                else if($('#emp_section').val() == '')
                {
                    alert("Enter Section");
                }
                else if($('#emp_email').val() == '')
                {
                    alert("Enter Email");
                }
                else if($('#emp_phone').val() == '')
                {
                    alert("Enter Phone");
                }
                else if($('#emp_address').val() == '')
                {
                    alert("Enter Address");
                }
                else
                {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:"add_edit_action.php",
                        method:"POST",
                        data:form_data,
                        success:function(data)
                        {
                            console.log(data)
                            fetch_data();
                            $('#api_crud_form')[0].reset();
                            $('#apicrudModal').modal('hide');
                            if(data == 'insert')
                            {
                            alert("Data Inserted Successfully");
                            }
                            if(data == 'update')
                            {
                            alert("Data Updated Successfully");
                            }
                        }
                    });
                }
            });

            $(document).on('click', '.edit', function(){
                var emp_id = $(this).attr('id');
                var action = 'fetch_single';
                $.ajax({
                    url:"add_edit_action.php",
                    method:"POST",
                    data:{emp_id:emp_id, action:action},
                    dataType:"json",
                    success:function(data)
                    {
                        console.log(data)
                        $('#hidden_id').val(emp_id);
                        $('#emp_fname').val(data.emp_fname);
                        $('#emp_lname').val(data.emp_lname);
                        $('#emp_dob').val(data.emp_dob);
                        $('#emp_section').val(data.emp_section);
                        $('#emp_phone').val(data.emp_phone);
                        $('#emp_email').val(data.emp_email);
                        $('#emp_address').val(data.emp_address);
                        $('#action').val('update');
                        $('#button_action').val('Update');
                        $('.modal-title').text('Edit Data');
                        $('#apicrudModal').modal('show');
                    }
                })
            });

            $(document).on('click', '.delete', function(){
                var emp_id = $(this).attr("id");
                var action = 'delete';
                if(confirm("Are you sure you want to Delete Employee?"))
                {
                    $.ajax({
                        url:"delete_action.php",
                        method:"POST",
                        data:{emp_id:emp_id, action:action},
                        success:function(data)
                        {
                            fetch_data();
                            alert("Data Deleted Successfully...!!!");
                        }
                    });
                }
            });
        })

	</script>
</body>
</html>