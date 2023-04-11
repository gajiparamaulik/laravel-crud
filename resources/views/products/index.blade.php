<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Products</title>
	<link rel="icon" type="image/x-icon" href="/images/mg-logo.jpg">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{asset('css/product.css')}}">
	<script src="{{asset('js/product.js')}}"></script>
</head>
<body class="bg-info">
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
				@foreach($getData as $index => $data)
				<tr>
					<th scope="row">{{ $index + 1 }}</th>
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
					<h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
					<button	button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
						  <label for="name" class="form-label fw-bolder">Full Name</label>
						  <input type="text" class="form-control" name="name" placeholder="Enter Full Name">
						</div>
						<div class="mb-3">
							<label for="name" class="form-label fw-bolder">Type</label>
							<select class="form-select" name="type">
							  <option selected>Choose...</option>
							  <option value="one">One</option>
							  <option value="two">Two</option>
							  <option value="three">Three</option>
							</select>
						</div>
						<div class="mb-3">
						  <label for="name" class="form-label fw-bolder">Thumbnail</label><br>
						  <input type="file" accept=".png, .jpg, .jpeg, .gif" name="thumbnail" />
						</div>
						<div class="form-group purple-border">
							<label for="details" class="fw-bolder">Details</label>
							<textarea class="form-control" rows="3" name="details" placeholder="Leave a comment here"></textarea>
						</div>
						<button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
					  </form>
				</div>
			</div>
		</div>
	</div>
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>		
</body>
</html>