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

.dataTables_info {
    margin: 0 0 0 25px;
}
</style>




<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center p-2">
        <a href="{{ route('dashboard')}}">
            <img class="brand-image" height="40px" width="60px" src="{{ getLogoUrl() }}" alt="Agile Tourism">
        </a>
        <hr>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" style="overflow-y: scroll; padding-bottom: 50px;">
        <div class="form-inline" style="margin: 10px 0 0 0;">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item ">
                        <a href="{{route('dashboard') }}"
                            class="nav-link  <?php  if(Request::segment(1)== '/'){ echo 'active' ;} ?>">
                            <i class="nav-icon fa fa-dashboard text-info"></i>
                            <p>Dashboard </p>
                        </a>

                    </li>
                    <li class="nav-item ">
                        <a href="{{route('allbookings.index') }}"
                           class="nav-link  <?php  if(Request::segment(1)== '/allBookings'){ echo 'active' ;} ?>">
                            <i class="nav-icon fa fa-dashboard text-info"></i>
                            <p>All Bookings </p>
                        </a>

                    </li>

                    @if(\Auth::user()->can('citytour list') || \Auth::user()->can('citytourbooking list'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-city text-info"></i>
                            <p>
                                City Tour Details
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('citytour list'))
                            <li class="nav-item">
                                <a href="{{ route('city.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'city_tour') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-city text-info"></i>
                                    <p>CityTour</p>
                                </a>
                            </li>
                            @endif
{{--                            @if(\Auth::user()->can('citytourbooking list'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('city.booking')}}"--}}
{{--                                    class="nav-link {{ (Request::segment(1) == 'city tour_booking') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fa fa-ticket text-info"></i>--}}
{{--                                    <p>City Tour Bookings</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
                        </ul>
                    </li>
                    @endif

                    @if(\Auth::user()->can('attraction list') || \Auth::user()->can('attractionbooking show'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-bookmark text-info"></i>
                            <p>
                                Attractions Detail
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('attraction list'))
                            <li class="nav-item">
                                <a href="{{ route('attraction.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'attraction') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-bookmark text-info"></i>
                                    <p>Attractions</p>
                                </a>
                            </li>
                            @endif
{{--                            @if(\Auth::user()->can('attractionbooking show'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('attraction.booking')}}"--}}
{{--                                    class="nav-link {{ (Request::segment(1) == 'attractionbooking') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fa fa-braille text-info"></i>--}}
{{--                                    <p>Attraction Bookings</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
                        </ul>
                    </li>
                    @endif

                    @if(\Auth::user()->can('adventure list') || \Auth::user()->can('adventurebooking list'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-chart-area text-info"></i>
                            <p>
                                Adventures Detail
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('adventure list'))
                            <li class="nav-item">
                                <a href="{{ route('adventure.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'adventure') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-chart-area text-info"></i>
                                    <p>Adventures</p>
                                </a>
                            </li>
                            @endif
{{--                            @if(\Auth::user()->can('adventurebooking list'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('adventure.booking')}}"--}}
{{--                                    class="nav-link {{ (Request::segment(1) == 'adventurebooking') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fa fa-angellist text-info"></i>--}}
{{--                                    <p>Adventure Bookings</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
                        </ul>
                    </li>
                    @endif


                    @if(\Auth::user()->can('viptransportation list') || \Auth::user()->can('viptransportationbooking
                    list'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-automobile text-info"></i>
                            <p>
                                Luxury Detail
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('viptransportation list'))
                            <li class="nav-item">
                                <a href="{{ route('vip.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'vip_transportation') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-car text-info"></i>
                                    <p>Luxury Experiences</p>
                                </a>
                            </li>
                            @endif
{{--                            @if(\Auth::user()->can('viptransportationbooking list'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('vip.booking')}}"--}}
{{--                                    class="nav-link {{ (Request::segment(1) == 'viptransportationbooking') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fa fa-tags text-info"></i>--}}
{{--                                    <p>Luxury Experiences Bookings</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
                        </ul>
                    </li>
                    @endif


                    
                    @if(\Auth::user()->can('transportation list') || \Auth::user()->can('transportationbooking
                    list'))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-automobile text-info"></i>
                            <p>
                            Transportation Detail
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('transportation list'))
                            <li class="nav-item">
                                <a href="{{ route('transportation.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'transportation') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-car text-info"></i>
                                    <p>Transportation</p>
                                </a>
                            </li>
                            @endif
{{--                            @if(\Auth::user()->can('transportationbooking list'))--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{ route('transportation.booking')}}"--}}
{{--                                    class="nav-link {{ (Request::segment(1) == 'transportationbooking') ? 'active' : '' }}">--}}
{{--                                    <i class="nav-icon fa fa-tags text-info"></i>--}}
{{--                                    <p>Luxury Experiences Bookings</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            @endif--}}
                        </ul>
                    </li>
                    @endif




                    @if(\Auth::user()->can('page list') || \Auth::user()->can('setting create') ||
                    \Auth::user()->can('socialmedia list') || \Auth::user()->can('navbar list'))
                    <li class="nav-item has-treeview" id="siteConfigDropdown">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cogs text-info"></i>
                            <p>
                                Site Configuration
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(\Auth::user()->can('page list'))
                            <li class="nav-item">
                                <a href="{{ route('page.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'page') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-border-style text-info"></i>
                                    <p>Pages</p>
                                </a>
                            </li>
                            @endif
                            @if(\Auth::user()->can('setting create'))
                            <li class="nav-item">
                                <a href="{{ route('setting.edit')}}"
                                    class="nav-link {{ (Request::segment(1) == 'setting') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-gear text-info"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('SocialMedia.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'socialmedia') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-bell text-info"></i>
                                    <p>Social Media</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('navbar.index')}}"
                                    class="nav-link {{ (Request::segment(1) == 'navbar') ? 'active' : '' }}">
                                    <i class="nav-icon fa fa-bars text-info"></i>
                                    <p>Navbar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(\Auth::user()->can('flightdata list'))
                    <li class="nav-item ">
                        <a href="{{ route('flight.flightdata')}}"
                            class="nav-link {{ (Request::segment(1)== 'flightdata') ? 'active':''  }}">
                            <i class="nav-icon fa fa-plane text-info"></i>
                            <p>Flight Data</p>
                        </a>
                    </li>
                    @endif
                    @if(\Auth::user()->can('adminData list'))
                        <li class="nav-item ">
                            <a href="{{ route('hotel.hotelbooking')}}"
                               class="nav-link {{ (Request::segment(1)== 'hotelbooking') ? 'active':''  }}">
                                <i class="nav-icon fa fa-building text-info"></i>
                                <p>Hotel Booking Data</p>
                            </a>
                        </li>
                    @endif

                    @if(\Auth::user()->can('reviews list'))
                    <li class="nav-item ">
                        <a href="{{ route('review.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'reviews') ? 'active':''  }}">
                            <i class="nav-icon fa fa-star text-info"></i>
                            <p>Reviews</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('user.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'user') ? 'active':''  }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>

                    <!-- @if(\Auth::user()->can('role list'))
                    <li class="nav-item">
                        <a href="{{ route('role.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'role') ? 'active':''  }}">
                            <i class="nav-icon fa fa-tasks   text-info"></i>
                            <p>
                                Role
                            </p>
                        </a>
                    </li>
                    @endif -->



                     @if(\Auth::user()->can('promocode list'))
                    <li class="nav-item">
                        <a href="{{ route('promo.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'promocode') ? 'active':''  }}">
                            <i class="nav-icon fa fa-tasks   text-info"></i>
                            <p>
                                Promo Code
                            </p>
                        </a>
                    </li>
                    @endif

                    @if(\Auth::user()->can('bannersliders list'))
                    <li class="nav-item">
                        <a href="{{ route('banner.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'bannerslider') ? 'active':''  }}">
                            <i class="nav-icon fa fa-tasks   text-info"></i>
                            <p>Banner Sliders</p>
                        </a>
                    </li>
                    @endif


                    <!-- <li class="nav-item">
                        <a href="{{ route('customer.index')}}"
                            class="nav-link {{ (Request::segment(1)== 'customer') ? 'active':''  }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li> -->




                    @if(\Auth::user()->can('setting openSetting'))
                    <li class="nav-item">
                        <a href="{{ route('profile.settings')}}"
                            class="nav-link {{ (Request::segment(1)== 'settings') ? 'active':''  }}">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
</aside>

<script>
$(document).ready(function() {
    $('#cityTourDropdown').on('click', function() {
        $(this).toggleClass('active-2');
    });
});
</script>
