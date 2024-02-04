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
                <label for="title">Flight ID</label>
                <input type="text" class="form-control" id="title" value="{{$showflightdata->flightId}}" name="title" readonly required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="singleLineDetail">Traveller ID</label>
                <input type="text" class="form-control"  value="{{$showflightdata->travelorId}}" name="title" readonly required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="totalDays">Origin Location</label>
                <input  class="form-control"  readonly value="{{$showflightdata->originLocation}}"  required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="capacity">Origin Destination</label>
                <input  class="form-control" readonly value="{{$showflightdata->originDestination}}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Total Price</label>
                <input type="text" class="form-control" readonly value="{{$showflightdata->totalPrice}}" required>
            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="oldPrice">Date</label>
                <input  class="form-control"  readonly value="{{$showflightdata->date}}" required>
            </div>
        </div>
    </div>
</div>


<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">No Of Travelers</label>
                        <input  class="form-control"  readonly value="{{$showflightdata->noOfTravelers}}" required>
                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longDetail">departureDate</label>
                        <input  class="form-control"  readonly value="{{$showflightdata->departureDate}}" required>

                    </div>

                </div>

            </div>

    
            <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">departureTerminal</label>
                <input  class="form-control"  readonly value="{{$showflightdata->departureTerminal}}" required>

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="oldPrice">arrivalDate</label>
                <input  class="form-control"  readonly value="{{$showflightdata->arrivalDate}}" required>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">arrivalTerminal</label>
                <input  class="form-control"  readonly value="{{$showflightdata->arrivalTerminal}}" required>


            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id"> carrierCode</label>
                <input  class="form-control"  readonly value="{{$showflightdata->carrierCode}}" required>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">flightNumber</label>
                <input  class="form-control"  readonly value="{{$showflightdata->flightNumber}}" required>


            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">adultId</label>
                <input  class="form-control"  readonly value="{{$showflightdata->adultId}}" required>
               
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">childrenId</label>
                <input  class="form-control"  readonly value="{{$showflightdata->childrenId}}" required>

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">infantsId</label>
                <input  class="form-control"  readonly value="{{$showflightdata->infantsId}}" required>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">associatedAdultId</label>
                <input  class="form-control"  readonly value="{{$showflightdata->associatedAdultId}}" required>

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">Payment_status</label>
                <input  class="form-control"  readonly value="{{ $showflightdata->Payment_status == 1 ? 'Confirmed' : 'Pending' }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">Booking_status</label>
                <input  class="form-control"  readonly value="{{$showflightdata->Booking_status == 1 ? 'Confirmed' : 'Pending'}}" required>

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">txn_id</label>
                <input  class="form-control"  readonly value="{{$showflightdata->txn_id}}" required>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">cabinClass</label>
                <input  class="form-control"  readonly value="{{$showflightdata->cabinClass}}" required>

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">Traveller ids</label>
                
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('id')->all()) }}" required>
              
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">firstName</label>
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('firstName')->all()) }}" required>
             

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">Last Name</label>
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('lastName')->all()) }}" required>
              
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">passportNumber</label>
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('passportNumber')->all()) }}" required>
          

            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">email</label>
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('email')->all()) }}" required>
              
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Time">dateOfBirth</label>
                
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('dateOfBirth')->all()) }}" required>
            </div>
        </div>
    <div class="col-md-6">
            <div class="form-group">
                <label for="Package_id">phone</label>
              
                <input  class="form-control"  readonly value="{{ implode(', ', $showflightdata->travellers->pluck('phone')->all()) }}" required>
             

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
