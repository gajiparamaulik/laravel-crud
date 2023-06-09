<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Datatables Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="{{asset('css/product.css')}}">
	<script src="{{asset('js/product.js')}}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
		<button class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
	</div>
	<div class="container bg-light mt-3">
		<table class="table ">
			<thead>
				<tr>
					<th scope="col">No.</th>
					<th scope="col">Users</th>
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
						<td>{{ $data->name }}</td>
						<td>{{ $data->type }}</td>
						<td><img src="images/{{ $data->thumbnail }}" height="30" alt=""></td>
						<td>{{ $data->details }}</td>
						<td>
							<button value="{{ $data->id }}" class="btn btn-primary" id="editBtn">Edit</button>
							<button value="{{ $data->id }}" class="btn btn-danger">Delete</button>
							{{-- <a href="#editProductModal" class="edit" data-bs-toggle="modal"
								data-bs-target="#editProductModal">
								<i class="material-icons orange600" data-toggle="tooltip" title="Edit">&#xE254;</i>
							</a> --}}

							{{-- <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
								<i class="material-icons red600" data-toggle="tooltip" title="Delete">&#xE872;</i>
							</a> --}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Add New Product Modal -->
	<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<input type="file" accept=".png, .jpg, .jpeg, .gif" name="thumbnail"  />
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

	<!-- Edit Product Modal -->
	<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Products</h5>
					<button	button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
					<form action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="prod_id" id="prod_id">
						<div class="mb-3">
							<label for="name" class="form-label fw-bolder">Full Name</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
						</div>
						<div class="mb-3">
							<label for="name" class="form-label fw-bolder">Type</label>
							<select class="form-select" name="type" id="type">
								<option selected>Choose...</option>
								<option value="one">One</option>
								<option value="two">Two</option>
								<option value="three">Three</option>
							</select>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label fw-bolder">Thumbnail</label><br>
							<input type="file" accept=".png, .jpg, .jpeg, .gif" id="thumbnail" name="thumbnail"  />
						</div>
						<div class="form-group purple-border">
							<label for="details" class="fw-bolder">Details</label>
							<textarea class="form-control" rows="3" name="details" id="details" placeholder="Leave a comment here"></textarea>
						</div>
						<button type="submit" class="btn btn-primary float-right mt-2">Update</button>
					{{-- </form> --}}
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>		
</body>
   
</html>

<script>
	$(document).ready(function () {
		$(document).on('click', '#editBtn', function () {

			var prod_id = $(this).val();
			$('#editProductModal').modal('show');

			$.ajax({
				type: "GET",
				url: "/products-edit/" + prod_id,
				success: function (response) {
					$('#name').val(response.product.name);
					$('#type').val(response.product.type);
					$('#details').val(response.product.details);
				}
			});
		});
	});
</script>
