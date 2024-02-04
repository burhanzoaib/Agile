@include('layouts.header')
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  @include('layouts.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> User{{ $section->heading }}</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
				@if(isset($user->image))
					<img class="profile-user-img img-fluid img-circle" src="{{ asset('public/public/profileimages/'.$user->image) }}" alt="User profile picture">
				@else
					<img class="profile-user-img img-fluid img-circle" src="{{ asset('public/assets')}}/dist/img/user2-160x160.jpg" alt="User profile picture">
				@endif
            </div>
            <h3 class="profile-username text-center">{{ $user->name }} {{ $user->lname }}</h3>
            <p class="text-muted text-center">{{ ($user->user_type == 'admin')? "Admin":"Customer"  }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Member Since</b>
                <a class="float-right">{{ $user->created_at}}</a>
              </li>
              
              <li class="list-group-item">
                <b>Pending Payments</b>
				@php 
					$er=App\Models\Main_invoice::select(DB::raw('SUM(amount) as total'))->where('user_id',Auth::user()->id)->where('is_payment',0)->get();	
				@endphp
                <a class="float-right">${{ $er[0]->total }}</a>
              </li>

              
            </ul>
            
          </div>
        </div>
		
		<div class="card card-primary card-outline">
          <div class="card-body box-profile">
            
            <h3 class="profile-username text-center">Change Password</h3>
            <ul class="list-group list-group-unbordered mb-3">
				
				<form action="{{route('profile.password',$user->id) }}" method="POST">
					@method('POST')
					@csrf
					<li class="list-group-item">
					<b>New Password</b>
					<input class="form-control" type="password" name="new_password"   placeholder="Name" required>
					</li>

					<li class="list-group-item">
					<b>Confirm Password</b>
					<input class="form-control" type="password" name="confirm"   placeholder="Name" required>
					</li>
					<li class="list-group-item">
						<button type="submit" class="btn btn-primary">Update</button>
					</li>
				</form>	
              
            </ul>
            
          </div>
        </div>
        
      </div>


      <div class="col-md-9">
        <div>
			 <form action="{{ route('profile.updatea',$user->id )}}" method="{{ $section->method }}"  enctype="multipart/form-data">
				  @csrf
				  <div class="card card-default">
					<div class="card-header">
					  <h3 class="card-title">Personal Info</h3>
					</div>
					<div class="card-body">

					  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label>Name</label>
							<input class="form-control" type="text" name="name"  value="{{ $user->name }}" placeholder="Name" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Company Name</label>
							<input class="form-control" type="text" name="lname"  value="{{ $user->lname }}" placeholder="Name" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Email</label>
							<input class="form-control" type="email" value="{{ $user->email }}" readonly name="email" placeholder="Email" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Image</label>
							<input class="form-control" type="file"   name="pic"  >
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Phone</label>
							<input class="form-control" type="text" name="phone"  value="{{ $user->phone }}" placeholder="Name" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Country</label>
							<select name="country" class="form-control country" required>
								<option value=""> Select Option</option>
								@foreach($countries as $country)
								<option value="{{ $country->country_id }}" data-id="{{ $country->country_id }}"  {{ ($user->country == $country->country_id)? "selected":""  }} >{{ $country->country_name }}</option>
								@endforeach
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>State</label>
							<select class="form-control state" name="state" >
								<option>{{ $user->state }}</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Postal</label>
							<input class="form-control" type="text" name="postal"  value="{{ $user->postal }}" placeholder="Name" required>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Address</label>
							<textarea class="form-control" type="text" name="address">{{ $user->address }}</textarea>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Gender</label>
							<select class="form-control" type="text" name="gender">
								<option {{ ($user->gender == "Male")? "selected":"" }}>Male</option>
								<option {{ ($user->gender == "Female")? "selected":"" }} >Female</option>
							</select>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label>Find</label>
							<select class="form-control" name="find">
								<option {{($user->find == 'search engine')? "selected": "" }} value="search engine" >Search Engine</option>
								<option {{($user->find == 'social media')? "selected": "" }} value="social media">Social Media </option>
								<option {{($user->find == 'customer refrence')? "selected": "" }} value="customer refrence">Customer Reference</option>
								<option {{($user->find == 'salesperson')? "selected": "" }}value="salesperson">Sales Person</option>
								<option {{($user->find == 'other')? "selected": "" }} value="other">Other</option>
							</select>
						  </div>
						</div>

					  </div>
					  {{--<div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label>Password</label>
							<input class="form-control"  autocomplete="off"  type="password" name="password"  value="" placeholder="Name" required>
						  </div>
					  </div>--}}
						
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
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
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

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $('.country').change(function () {
        var country_id = $(this).val();
        
		$.ajax({
			url: "{{ route('profile.state') }}",
			type: 'post',
			data: { country_id:country_id },
			success:function(data)
			{
				$('.state').html(data);
			}
		});   


    });


</script>
</body>
</html>
