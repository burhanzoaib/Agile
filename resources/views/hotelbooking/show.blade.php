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
                    <h3 class="page-title fw-bold">Booking Detail</h3>
                </div>
            </div>
            <div class="container">




    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">Customer Name</label>
                <input type="text" class="form-control" id="title" value="{{$adminData->name}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Customer Email</label>
                <input type="text" class="form-control"  value="{{$adminData->email}}" name="title" readonly required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Customer Phone</label>
                <input type="text" class="form-control"  value="{{$adminData->phone}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Hotel  Name</label>
                <input type="text" class="form-control"  value="{{$adminData->hotelName}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Check In</label>
                <input type="text" class="form-control"  value="{{$adminData->checkin}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">No of Guests</label>
                <input type="text" class="form-control"  value="{{$adminData->noOfAdult}}" name="title" readonly required>
            </div>
        </div><div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">No of Rooms</label>
                <input type="text" class="form-control"  value="{{$adminData->noOfRoom}}" name="title" readonly required>
            </div>
        </div><div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Price</label>
                <input type="text" class="form-control"  value="{{$adminData->price}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Reference Id </label>
                <input type="text" class="form-control"  value="{{$adminData->reference}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Booking Id</label>
                <input type="text" class="form-control"  value="{{$adminData->bookingId}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Provider Confirmation Id</label>
                <input type="text" class="form-control"  value="{{$adminData->providerConfirmationId}}" name="title" readonly required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Created at</label>
                <input type="text" class="form-control"  value="{{$adminData->created_at}}" name="title" readonly required>
            </div>
        </div>



    </div>

                <hr>




<hr>
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
