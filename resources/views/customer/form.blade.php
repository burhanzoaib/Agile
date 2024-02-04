@include('layouts.header')


@include('layouts.sidebar')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Form</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
		@if(Session::has('flash_message'))
			<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  {{ Session::get('flash_message') }}
			</div>
			
        @endif
        <form action="{{ route($section->route)}}" method="{{ $section->method}}"  enctype="multipart/form-data">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Please Fill </h3>
            </div>
            <!-- /.card-header -->
            
             

            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name"  value=""placeholder="Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" plavcehoslder="Email" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password"  value="" placeholder="Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label>Role</label>
                      <!-- controller kain condition lagani hy -->
                        <select name="user_type" required class="form-control"> 
                        @foreach($rolesq as $role)  
                        <option value="{{ $role->name}}">{{ $role->name}}</option>
                        @endforeach
                          
                        </select>       
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <div class="card card-default">
          
          <!-- /.card-header -->
          
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
            </div>
          </div>
        </form>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
     @include('layouts.footer')


<script language="JavaScript">
    // Webcam.set({
    //     width: 490,
    //     height: 390,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90
    // });
  
    // Webcam.attach( '#my_camera' );
  
    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    //     } );
    // }
</script>

</body>
</html>