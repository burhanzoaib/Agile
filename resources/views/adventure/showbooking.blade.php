@include('layouts.header')



<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/fontawesome-free/css/all.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet"
    href="{{ asset('public/assets') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="{{ asset('public/assets') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/plugins/dropzone/min/dropzone.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/assets') }}/dist/css/adminlte.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
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
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
                <div class="col">
                    <h3 class="page-title fw-bold">{{ $section->heading }}</h3>
                </div>
            </div>
            <div class="container">




            <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="title">Customer Name</label>
            <input type="text" class="form-control" id="title" value="{{ $booking->customer_name ?? 'N/A' }}" name="title" readonly required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="singleLineDetail">Customer Email</label>
            <input type="text" class="form-control" value="{{ $booking->customer_email ?? 'N/A' }}" name="title" readonly required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="totalDays">Activity Type</label>
            <input class="form-control" readonly value="{{ $booking->activity_type ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="capacity">Date</label>
            <input class="form-control" readonly value="{{ $booking->date ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Total Price</label>
            <input type="text" class="form-control" readonly value="{{ $booking->total_price ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="oldPrice">Travellers</label>
            <input class="form-control" readonly value="{{ $booking->no_of_travellers ?? 'N/A' }}" required>
        </div>
    </div>
</div>


<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">Images</label>

                        @if (isset($booking->adventure->images) && !empty(json_decode($booking->adventure->images)))

                <div id="current-images">

                    @foreach(json_decode($booking->adventure->images) as $image)

                        <img src="{{ $image }}" alt="Current Image" style="max-width: 200px;">

                    @endforeach

                </div>

                @else

                <p>No images available</p>

                @endif
                    </div>
                </div>
                <div class="col-md-6">
    <div class="form-group">
        <label for="longDetail">Title</label>
        <input class="form-control" readonly value="{{ $booking->adventure->title ?? 'N/A' }}" required>
    </div>
</div>


            </div>


            <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Long Details</label>
            {!! $booking->adventure->longDetail ?? 'N/A' !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="oldPrice">Single Line Detail</label>
            {!! $booking->adventure->singleLineDetail ?? 'N/A' !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Time</label>
            <input class="form-control" readonly value="{{ $booking->Time->time ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">Package Id</label>
            <input class="form-control" readonly value="{{ $booking->Time->package_id ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Title</label>
            <input class="form-control" readonly value="{{ $booking->adventure->title ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">How Many People</label>
            <input class="form-control" readonly value="{{ $booking->adventure->howManyPeople ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Total Days</label>
            <input class="form-control" readonly value="{{ $booking->adventure->totalDays ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">Capacity</label>
            <input class="form-control" readonly value="{{ $booking->adventure->capacity ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Age Restriction</label>
            <input class="form-control" readonly value="{{ $booking->adventure->ageRestriction ?? 'N/A' }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">From Date</label>
            <input class="form-control" readonly value="{{ $booking->adventure->fromDate ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Old Price</label>
            <input class="form-control" readonly value="{{ $booking->adventure->oldPrice ?? 'N/A' }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">New Price</label>
            <input class="form-control" readonly value="{{ $booking->adventure->newPrice ?? 'N/A' }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Highlights</label>
            {!! $booking->adventure->highlights ?? 'N/A' !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">Full Description</label>
            {!! $booking->adventure->full_decription ?? 'N/A' !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Includes</label>
            {!! $booking->adventure->includes ?? 'N/A' !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">Not Suitable</label>
            {!! $booking->adventure->not_suitable ?? 'N/A' !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="Time">Meeting Point</label>
            {!! $booking->adventure->meeting_point ?? 'N/A' !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="Package_id">Important Information</label>
            {!! $booking->adventure->important_information ?? 'N/A' !!}
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">Booking Status</label>

                <input  class="form-control"  readonly value="{{$booking->booking_status == 1 ? 'Confirmed' : 'Pending'}}" required>


            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">Payment Status</label>

                <input  class="form-control"  readonly value="{{$booking->payment_status == 1 ? 'Confirmed' : 'Pending'}}" required>

            </div>
        </div>
    </div>


</div>





        </div>
    </div>



</div>
    <!-- /.content -->
</div>
@include('layouts.footer')



<script language="JavaScript">

$(document).ready(function() {

    var myForm = document.getElementById('myform');
var submitButton = document.getElementById('subbtn');

// Add event listener to the form's submit event
myForm.addEventListener('submit', function(event) {
  // Disable the submit button
  submitButton.disabled = true;
});


 $(".select").select2();
});


$(document).ready(function(){
	$('#other').hide();
    $('.degree-selected').change(function () {
        var selectedItem = $(this).val();
        if (selectedItem === 'other') {
			$('#place').hide();
           $('#other').show();
        }
    });
	$('.degr').click(function () {
			$('#place').show();
           $('#other').hide();

    });
});
</script>

<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js">
    window.onload = function() {
        CKEDITOR.replace('singleLineDetail');
        CKEDITOR.replace('longDetail');

    };
</script>

</body>

</html>
