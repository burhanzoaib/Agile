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
        
        <form action="{{ route('customer.update',$customer->id )}}" method="POST" >
        @method('put')  
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
                    <input class="form-control" type="text" name="name"  value="{{$customer->name }}" placeholder="Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{$customer->email }}" placehoslder="Email" required>
                  </div>
                </div>
              </div>
			  
			  @if($customer->user_type != 'customer')
				<div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Roles</label>
                    <select name="user_type" class="form-control">
                    @foreach($rolesq as $role)  
                      <option value="{{ $role->name}}" {{ ($role->name == $customer->user_type )? 'selected':'' }} >{{ $role->name}}</option>
                    @endforeach
                    </select> 
                  </div>
                </div>   
				</div>
				@endif
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


</body>
</html>