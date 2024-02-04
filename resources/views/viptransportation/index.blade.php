@include('layouts.header')
<link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ asset('public/assets')  }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('public/assets')  }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@include('layouts.sidebar')

<style>
.small-box>.inner {
    padding: 15px 0px 10px 20px !important;
}

.table:not(.table-dark) {
    color: inherit;
    width: 100% !important;
    overflow: scroll !important;
}

@media only screen and (max-width: 600px) {
    .content-wrapper {
        padding: 5px !important;
    }
}

@media only screen and (min-width: 600px) {
    .content-wrapper {
        padding: 30px !important;

    }
}
.bbtn{
	border-radius: 15px;
    color: black;
    border: none;
    padding: 5px 25px;
    background-color: rgb(219, 176, 101);
    margin-left: 50px;
    font-weight: 400;
}
</style>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>All {{ $section->heading }}s</h1>
{{--					<h6>Pending     --     <span class="btn btn-warning"></span></h6>--}}
{{--					<h6>Payment Due -- <span class="btn btn-danger"></span></h6>--}}
{{--					<h6>Complete --    <span class="btn btn-success"></span></h6>--}}
{{--					<h6>Edit Order --  <span class="btn btn-info"></span></h6>--}}
                </div>

                <div class="col-sm-8">
                    @can('viptransportation create')
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="bbtn" href="{{ route('vip.create') }}">New {{ $section->title }}</a></li>
                        </ol>
                    @endcan
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

    <div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Total Days</th>
                <th>New Price</th>
                <th>from Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($viptransportation as $viptransport)
            <tr>
                <td>{{$viptransport->id }}</td>
                <td>{{$viptransport->title }}</td>
                <td>{{$viptransport->totalDays }}</td>
                <td>{{$viptransport->newPrice }}</td>
                <td>{{$viptransport->fromDate }}</td>
                <td>
                    @if($viptransport->featured == 1)
                        <a href="{{route('unfeatured',['vip',$viptransport->id])}}" class="btn btn-sm btn-secondary">Featured</a>

                    @else
                        <a href="{{route('featured',['vip',$viptransport->id])}}" class="btn btn-sm btn-secondary">UnFeatured</a>
                    @endif
                    <a href="{{route('vip.show',$viptransport->id)}}" class="btn btn-sm btn-secondary">Show</a>
                    <a href="{{route('vip.edit',$viptransport->id)}}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('vip.destroy', $viptransport->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>




    </section>
    <!-- /.content -->
</div>


@include('layouts.footer')


<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
$(function() {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $("#example1").DataTable({

        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
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


$(document).ready(function() {

    $('body').on('click', '#delete-user', function() {

        var userURL = $(this).data('url');
        var trObj = $(this);

        if (confirm("Are you sure you want to remove this order?") == true) {
            $.ajax({
                url: userURL,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                   //alert(data);
                    trObj.parents("tr").remove();
                }
            });
        }

    });

});
</script>

</body>

</html>
