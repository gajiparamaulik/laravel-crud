<!DOCTYPE html>
<html>

<head>
	<title>Laravel 9 Ajax CRUD Tutorial Using Datatable - Nicesnippets.com</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
</head>

<body>
	<div class="container mt-3">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4>Laravel 9 Ajax CRUD</h4> </div>
					<div class="col-md-12 text-right mb-5"> <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Product</a> </div>
					<div class="col-md-12">
						<table class="table table-bordered data-table">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Type</th>
									{{-- <th>Thumbnail</th> --}}
									<th>Details</th>
									<th width="120px">Action</th>
								</tr>
							</thead>
							<tbody> </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="ajaxModel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeading"></h4> </div>
				<div class="modal-body">
					<form id="productForm" name="productForm" class="form-horizontal">
						<input type="hidden" name="product_id" id="product_id">
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="name" name="name" 
									placeholder="Enter Name" value="" maxlength="50" required=""> 
							</div>
						</div>
						<div class="input-group mb-3 form-group">
							<label for="type" class="col-sm-2 control-label">Type</label>
							<div class="col-sm-12 input-group mb-3">
								<select class="form-select" id="type" name="type">
									<option selected>Choose...</option>
									<option value="one">One</option>
									<option value="two">Two</option>
									<option value="three">Three</option>
								</select>
							  </div>
						</div>  
						{{-- <div class="form-group">
							<label class="col-sm-2 control-label">Thumbnail</label>
							<div class="col-sm-12">
								<input type="file" accept=".png, .jpg, .jpeg, .gif" name="thumbnail" id="thumbnail" />
							</div>
						</div> --}}
						<div class="form-group">
							<label class="col-sm-2 control-label">Details</label>
							<div class="col-sm-12">
								<textarea id="details" name="details" required="" placeholder="Enter Details" class="form-control"></textarea>
							</div>
						</div>
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</body>
<script type="text/javascript">
$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var table = $('.data-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: "{{ route('ajaxproducts.index') }}",
		columns: [{
			data: 'DT_RowIndex',
			name: 'DT_RowIndex'
		},{
			data: 'user_id',
			name: '1'
		}, {
			data: 'name',
			name: 'name'
		}, {
			data: 'type',
			name: 'type'
		}, {
			data: 'details',
			name: 'details'
		}, {
			data: 'action',
			name: 'action',
			orderable: false,
			searchable: false
		}, ]
	});
	$('#createNewProduct').click(function() {
		$('#saveBtn').val("create-product");
		$('#product_id').val('');
		$('#productForm').trigger("reset");
		$('#modelHeading').html("Create New Product");
		$('#ajaxModel').modal('show');
	});
	$('body').on('click', '.editProduct', function() {
		var product_id = $(this).data('id');
		$.get("{{ route('ajaxproducts.index') }}" + '/' + product_id + '/edit', function(data) {
			$('#modelHeading').html("Edit Product");
			$('#saveBtn').val("edit-user");
			$('#ajaxModel').modal('show');
			$('#product_id').val(data.id);
			$('#name').val(data.name);
			$('#type').val(data.type);
			$('#details').val(data.details);
		})
	});
	$('#saveBtn').click(function(e) {
		e.preventDefault();
		$(this).html('Sending..');
		$.ajax({
			data: $('#productForm').serialize(),
			url: "{{ route('ajaxproducts.store') }}",
			type: "POST",
			dataType: 'json',
			success: function(data) {
				$('#productForm').trigger("reset");
				$('#ajaxModel').modal('hide');
				table.draw();
			},
			error: function(data) {
				console.log('Error:', data);
				$('#saveBtn').html('Save Changes');
			}
		});
	});
	$('body').on('click', '.deleteProduct', function() {
		var product_id = $(this).data("id");
		var result = confirm("Are You sure want to delete !");
		if(result) {
			$.ajax({
				type: "DELETE",
				url: "{{ route('ajaxproducts.store') }}" + '/' + product_id,
				success: function(data) {
					table.draw();
				},
				error: function(data) {
					console.log('Error:', data);
				}
			});
		} else {
			return false;
		}
	});
});
</script>

</html>