@include('layouts.header')
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@include('layouts.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
      <div class="col-md-12">
        <div>
			 <form action="{{ route('setting.update',1)}}" method="{{ $section->method }}"  enctype="multipart/form-data">
				  @csrf
				  <div class="card card-default">
					<div class="card-header">
					  <h3 class="card-title">System Settings</h3>
					</div>
					<div class="card-body">
						<h4>Stripe </h4>
					  <div class="row">
						
						<div class="col-md-6">
						  <div class="form-group">
							<label>Stripe Key</label>
							<input class="form-control" type="text" name="stripe_key"  value="{{ $setting->stripe_key }}"  required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Stripe Secrate</label>
							<input class="form-control" type="text" name="stripe_secrate"  value="{{ $setting->stripe_secrate }}" required>
						  </div>
						</div>
						
						</div>
						<hr>
						 <h4>Admin Detail</h4>
						 <div class="row">
						
						<div class="col-md-4">
						  <div class="form-group">
							<label>Admin Email</label>
							<input class="form-control" type="email" value="{{ $setting->admin_email }}" name="admin_email" required>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label>Admin Phone</label>
							<input class="form-control" type="text"   name="admin_phone" value="{{ $setting->admin_phone }}"    >
						  </div>
						</div>

						<div class="col-md-4">
						  <div class="form-group">
							<label>VAT tax</label>
							<input class="form-control" type="text" name="vat_tax"  value="{{ $setting->vat_tax }}" required>
						  </div>
						</div>
						</div>
						<hr>
						 <h4>Paypal </h4>
						 <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label>Paypal Client Id</label>
							<input class="form-control" type="text" name="paypal_client_id"  value="{{ $setting->paypal_client_id }}" required>
						  </div>
						</div>

						<div class="col-md-6">
						  <div class="form-group">
							<label>Paypal Secret</label>
							<input class="form-control" type="text" name="paypal_secret"  value="{{ $setting->paypal_secret }}" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Address</label>
							<textarea class="form-control"  id="summernote" type="text" name="address"  required >{!! $setting->address !!}</textarea>
							
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Content</label>
							<textarea class="form-control" type="text" name="content"  required >{!! $setting->content !!}</textarea>
						  </div>
						</div>
						{{--<div class="col-md-6">
						  <div class="form-group">
							<label>Mode</label>
							<input class="form-control" type="text" name="pay_sendbox"  value="{{ $setting->pay_sendbox }}"  required>
						</div>--}}
						</div>
						</div>
						

					  </div>
					  
						
					  </div>
					  <div class="card-footer">
					<button type="submit" class="btn btn-primary">Update</button>
				  </div>
					</div>
					
				  </div>
				  <div class="card card-default">
				  
				  <!-- /.card-header -->
				  
				 
					</div>
				  </div>
				</form>
          
		</div>
      </div>
    </div>
  </div>
</section>
</div>
  @include('layouts.footer')

 
<script src="{{ asset('public/assets')  }}/dist/js/adminlte.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
