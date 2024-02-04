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
.bbtn {
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
                        <th>Banner Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($bannerslider as $bannersliders)
                    <tr>
                        <td>{{$bannersliders->id }}</td>
                        <td>{{$bannersliders->bannername }}</td>
                        <td>
                            @foreach(json_decode($bannersliders->images) as $image)
                            <img src="{{ $image }}" width="50" height="50" alt="Image">
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('banner.show',$bannersliders->id)}}"
                                class="btn btn-sm btn-secondary">Show</a>
                            <a href="{{route('banner.edit',$bannersliders->id)}}"
                                class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

@include('layouts.footer')

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