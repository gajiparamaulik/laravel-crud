<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Products</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{asset('css/product.css')}}">
	<script src="{{asset('js/product.js')}}"></script>
</head>
<body class="vh-100 gradient-custom">
	<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="#"><img src="/images/mg-logo.jpg" height="30" alt=""></a>
			<div class="col-xs-2 search-box">
				<input class="form-control" type="search" placeholder="Search" aria-label="Search">
			</div>
		</div>
	</nav>

	<div class="container mt-3">
		<button class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#formModal">Add Product</button>
	</div>

	<div class="container bg-light mt-3">
		<table class="table ">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">User Id</th>
					<th scope="col">Name</th>
					<th scope="col">Type</th>
					<th scope="col">Thumbnail</th>
					<th scope="col">Details</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($getData as $data)
				<tr>
					<th scope="row">1</th>
					<td>{{ $data->user->name }}</td>
					<td>{{ $data['name'] }}</td>
					<td>{{ $data['type'] }}</td>
					<td><img src="images/{{ $data['thumbnail'] }}" height="30" alt=""></td>
					<td>{{ $data['details'] }}</td>
					<td>
						<a href="#editEmployeeModal" class="edit" data-toggle="modal">
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
	</div>

	<!-- Modal -->
	<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button	button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>		
</body>
</html>