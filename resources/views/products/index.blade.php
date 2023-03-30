<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Products</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
						<a class="btn btn-info" href="">Show</a>
    
                    <a class="btn btn-primary" href="">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
	  	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
		
</body>
</html>