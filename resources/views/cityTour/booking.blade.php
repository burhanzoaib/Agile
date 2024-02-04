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
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Activity</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>Travellers</th>
                <th>Booking Status</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($booking as $bookings)
            <tr>
                <td>{{$bookings->id }}</td>
                <td>{{$bookings->customer_name }}</td>
                <td>{{$bookings->customer_email }}</td>
                <td>{{$bookings->activity_type }}</td>
                <td>{{$bookings->date }}</td>
                <td>{{$bookings->total_price }}</td>
                <td>{{$bookings->no_of_travellers }}</td>
                <td>
             {{ $bookings->booking_status == 1 ? 'Confirmed' : 'Pending' }}
                </td>
                <td>  {{ $bookings->payment_status == 1 ? 'Confirmed' : 'Pending' }}</td>
                @can('citytourbooking show')
                <td>
                    <a href="{{route('city.showbooking',$bookings->id)}}" class="btn btn-sm btn-secondary">Show</a>
                </td>
                @endcan
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
