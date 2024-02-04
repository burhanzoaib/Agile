 @include('layouts.header')
 @include('layouts.sidebar')

 <!-- Content Wrapper. Contains page content -->

 @php

        $total_user = App\Models\User::where('user_type',1)->count();
        $city = App\Models\Booking::where('activity_type','CityTour')->count();
        $attraction = App\Models\Booking::where('activity_type','Attraction')->count();
        $adventure = App\Models\Booking::where('activity_type','Adventure')->count();
        $vip = App\Models\Booking::where('activity_type','Viptransportation')->count();

 @endphp
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header" style="padding: 0;">
         <div class="container-fluid">
            <div class="row py-5">
                <div class="col-md-12">
                    <div class="heading text-center">
                        <h2>Welcome To Dashboard</h2>
                    </div>
                </div>
            </div>
             <div class="row mb-2">
                 <div class="col-sm-12">
                     <div class="row">
                         <div class="col-md-1"></div>
                         <div class="col-sm-2">
                             <div class="card widget-flat">
                                 <div class="card-body">
                                     <div class="float-end">
                                         <i class="mdi mdi-account-multiple widget-icon"></i>
                                     </div>
                                     <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Users

                                     <h3 class="mt-3 mb-3">{{ $total_user }}</h3>

                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="card widget-flat">
                                 <div class="card-body">
                                     <div class="float-end">
                                         <i class="mdi mdi-account-multiple widget-icon"></i>
                                     </div>
                                     <h5 class="text-muted fw-normal mt-0" title="Number of Customers">CityTour </h5>
                                     <h3 class="mt-3 mb-3">{{ $city }}</h3>

                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="card widget-flat">
                                 <div class="card-body">
                                     <div class="float-end">
                                         <i class="mdi mdi-account-multiple widget-icon"></i>
                                     </div>
                                     <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Attractions </h5>
                                     <h3 class="mt-3 mb-3">{{ $attraction }}</h3>

                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="card widget-flat">
                                 <div class="card-body">
                                     <div class="float-end">
                                         <i class="mdi mdi-account-multiple widget-icon"></i>
                                     </div>
                                     <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Adventure </h5>
                                     <h3 class="mt-3 mb-3">{{ $adventure }}</h3>

                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-2">
                             <div class="card widget-flat">
                                 <div class="card-body">
                                     <div class="float-end">
                                         <i class="mdi mdi-cart-plus widget-icon"></i>
                                     </div>
                                     <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Luxury </h5>
                                     <h3 class="mt-3 mb-3">{{ $vip }}</h3>

                                 </div>
                             </div>
                         </div>
                         <div class="col-md-1"></div>
                     </div>
                 </div><!-- /.col -->
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
 </div>
 <!-- /.content-wrapper -->

 @include('layouts.footer')
 <script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        " ": true,
        "searching": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
 </script>
 <script>
$(function() {
    $("#example13").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
        "searching": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
 </script>
