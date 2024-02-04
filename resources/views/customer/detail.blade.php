@include('layouts.header')
 <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@include('layouts.sidebar')

@include('layouts.sidebar')
 <div class="content-wrapper">
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('/public/public/images')}}/{{$customer[0]->image }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $customer[0]->name }} </h3>

                <p class="text-muted text-center">{{ $customer[0]->occupation }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Plote No:</b> <a class="float-right">{{ $customer[0]->plote_no }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Block</b> <a class="float-right">{{ $customer[0]->block }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
          
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
                <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            	<a href="{{ url('createp/'.$customer[0]->id )}}" class="btn btn-warning">Add Plote</a>
            </div>
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Plote No</th>
                    <th>Area</th>
                    <th>Advance</th>              
                    <th>Monthly </th>              
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($plotes as $row)
                  <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->plote_no }}</td>
                    <td>{{ $row->area }}</td>
                    <td>{{ $row->advance }}</td>
                    <td>{{ $row->per_month }}</td>
                    <td><a href="{{ route('plote.show',$row->id )}}" class="btn btn-info"> Detail</a>
                        <a href="{{ route('plote.edit',$row->id )}}" class="btn btn-warning"> Edit</a></td>
                    
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Id</th>
                    <th>Plote No</th>
                    <th>Area</th>
                    <th>Advance</th>              
                    <th>Monthly </th>              
                    <th>Action</th>
                  </tr>
                  </tfoot>
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

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
@include('layouts.footer')
<script src="{{ asset('public/assets')  }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/assets')  }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('public/assets')  }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('public/assets')  }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets')  }}/dist/js/adminlte.min.js"></script>
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
</script>