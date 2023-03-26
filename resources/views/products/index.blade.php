<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
    <script src="{{asset('js/product.js')}}"></script>
	<body>
		<div class="container">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Manage <b>Products</b></h2> </div>
						<div class="col-sm-6"> <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">&#xE147;</i> 
                            <span>Add New Product</span></a> 
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                                <i class="material-icons">&#xE15C;</i> 
                                <span>Delete</span>
                            </a> 
                        </div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>User Id</th>
							<th>Name</th>
							<th>Type</th>
							<th>Thumbnail</th>
							<th>Details</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($getData as $data)
							<tr>
								<td>{{ $data->id }}</td>
								<td>{{ $data->user_id }}</td>
								<td>{{ $data->name }}</td>
								<td>{{ $data->type }}</td>
								<td><img src="{{ $data->thumbnail }}" width="100px"></td>
								<td>{{ $data->details }}</td>
								<td><a href="#editEmployeeModal" class="edit" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</a> 
									<a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Showing <b>10</b> out of <b>25</b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item active"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Add Modal HTML -->
		<div id="addEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Employee</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" required> 
                            </div>
							<div class="form-group">
								<label>Type</label>
								<input type="text" name="type" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Thumbnail</label>
								<input type="file" name="thumbnail" class="form-control" placeholder="Thumbnail">
                            </div>
							<div class="form-group">
								<label>Details</label>
								<textarea type="text" name="details" class="form-control" required></textarea> 
                            </div>
						</div>
						<div class="modal-footer text-center">
							<button type="submit" class="btn btn-success">Submit</button>
					</form>
				</div>
			</div>
		</div>
		<!-- Edit Modal HTML -->
		<div id="editEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form>
						<div class="modal-header">
							<h4 class="modal-title">Edit Employee</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" required> </div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" required> </div>
							<div class="form-group">
								<label>Address</label>
								<textarea class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Phone</label>
								<input type="text" class="form-control" required> </div>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-info" value="Save"> </div>
					</form>
				</div>
			</div>
		</div>
		<!-- Delete Modal HTML -->
		<div id="deleteEmployeeModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form>
						<div class="modal-header">
							<h4 class="modal-title">Delete Employee</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<p>Are you sure you want to delete these Records?</p>
							<p class="text-warning"><small>This action cannot be undone.</small></p>
						</div>
						<div class="modal-footer">
							<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
							<input type="submit" class="btn btn-danger" value="Delete"> </div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>