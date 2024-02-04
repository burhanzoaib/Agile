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
                    <label for="title">Vip Transportation Title</label>
                    <input type="text" class="form-control" id="title" value="{{$viptransportation->title}}"
                        name="title" readonly required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="totalDays">Total Days</label>
                    <input type="text" class="form-control" id="totalDays" readonly
                        value="{{$viptransportation->totalDays}}" name="totalDays" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="capacity">Tour Type Section</label>
                    <select class="form-control" name="tour_type_section">
                        <option>Select Tour</option>
                        <option {{ ($viptransportation->tour_type_section == "Private Tour" )? "Selected":"" }}  >Private Tour</option>
                        <option {{ ($viptransportation->tour_type_section == "Group Tour" )? "Selected":"" }} >Group Tour</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="ageRestriction">Age Restriction</label>
                    <input type="text" class="form-control" id="ageRestriction" readonly
                        value="{{$viptransportation->ageRestriction}}" name="ageRestriction" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="oldPrice">Old Price</label>
                    <input type="number" class="form-control" id="oldPrice" readonly
                        value="{{$viptransportation->oldPrice}}" name="oldPrice" step="0.01">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="newPrice">New Price</label>
                    <input type="number" class="form-control" id="newPrice" readonly
                        value="{{$viptransportation->newPrice}}" name="newPrice" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fromDate">From Date</label>
                    <input type="date" class="form-control" id="fromDate" readonly
                        value="{{$viptransportation->fromDate}}" name="fromDate" required>
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="promoCode">Promo Code</label>
                    <input type="text" class="form-control" id="promoCode" readonly
                        value="" name="promoCode" step="0.01" required>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    @if(isset($viptransportation))
                    @foreach($viptransportation->time as $item)
                    <label>Time</label>
                    <input type="time" name="" class="form-control" value="{{$item->time}}" readonly>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="totalDays">Position</label>
                    <input type="text" class="form-control" id="position" readonly
                        value="{{$viptransportation->position}}" name="position" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="howManyPeople">Minimum People</label>
                    <input type="number" class="form-control" id="howManyPeople" readonly
                        value="{{$viptransportation->howManyPeople}}" name="howManyPeople" step="0.01" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="longDetail">Long Details</label>
                    {!! $viptransportation->longDetail !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="highlights">Highlights</label>
                    {!! $viptransportation->highlights !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_decription">Full Description</label>
                    {!! $viptransportation->full_decription !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="includes">Includes</label>
                    {!! $viptransportation->includes !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="not_suitable">Not Suitable</label>
                    {!! $viptransportation->not_suitable!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="meeting_point">Meeting Point</label>
                    {!! $viptransportation->meeting_point!!}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="important_information">Important Information</label>
                    {!! $viptransportation->important_information!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="singleLineDetail">Single Line Details</label>
                    {!! $viptransportation->singleLineDetail !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Images</label>
                    @if ($viptransportation->images)
                    <div class="row">
                        @foreach(json_decode($viptransportation->images) as $image)
                        <div id="current-images" class="col-md-6">
                            <img src="{{ $image }}" alt="Current Image" height="100px" width="100px">
                        </div>
                        @endforeach
                        @else
                        <p>No images available</p>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="images">Front Images</label>
                    @if (isset($viptransportation->front_images) &&
                    !empty(json_decode($viptransportation->front_images)))
                    <div id="current-images" >
                        @foreach(json_decode($viptransportation->front_images) as $image)
                        <img src="{{ $image }}" alt="Current Image" height="100px" width="100px">
                        @endforeach
                    </div>
                    @else
                    <p>No images available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
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


$(document).ready(function() {
    $('#other').hide();
    $('.degree-selected').change(function() {
        var selectedItem = $(this).val();
        if (selectedItem === 'other') {
            $('#place').hide();
            $('#other').show();
        }
    });
    $('.degr').click(function() {
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
