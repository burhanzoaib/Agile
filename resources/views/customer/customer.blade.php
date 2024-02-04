@include('layouts.header')
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@include('layouts.sidebar')

 <style>
 .small-box > .inner {
  padding: 15px 0px 10px 20px!important;
}

.table:not(.table-dark) {
  color: inherit;
  width: 100% !important;
  overflow: scroll !important;
}

@media only screen and (max-width: 600px) {
  .content-wrapper {
    padding: 5px!important;   
  }
}

@media only screen and (min-width: 600px) {
  .content-wrapper {
    padding: 30px!important;  
   
  }
}
</style>


<div class="content-wrapper">  
<section class="content">
<div class="container-fluid"> 
      
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a class="btn btn-warning" href="{{ route('customer.create') }}">New Customer</a></li> 
             </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      
        <div class="row"> 
        <div class="col-12"> 
          <div class="card"> <div class="card-body">
                <table id="example1" class="table table-hover">
                 
                  <thead>    
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>User Type</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($customer as $row)
                    @if($row->user_type != 'admin')
                  <tr>
                    <td>{{ $row->id }}</td>                      
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->lname }}</td>
                    <td>{{ ($row->user_type == "customer") ? "Customer": "Sales" }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                      <!-- <a href="{{ route('customer.show',$row->id )}}" class="btn btn-info"> Detail</a> -->
                      <a href="{{ route('customer.edit',$row->id )}}" class="btn btn-warning"> Edit</a></td>
                  </tr>
                  @endif
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   

  @include('layouts.footer')

<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
