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

@include('layouts.header')
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
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    <div class="row">
        <div class="col">
            <h3 class="page-title fw-bold">{{ $section->heading }}</h3>
        </div>
    </div>
    <div class="container">


        <form method="{{ $section->method }}" action="{{ route('setting.update',1) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" value="1" name="id">
                        <label for="image">Website Icon</label>
                        <input type="file" class="form-control images" id="" name="image" accept="image/*">

                        @if (isset($setting->image))
                        <div id="current-images">

                            <img src="{{$setting->images}}" alt="Current Image" style="max-width: 200px;">

                        </div>
                        @else
                        <p>No images available</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Stripe Client Key</label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->stripe_client_key) ? $setting->stripe_client_key : '' }}" id=""
                            name="stripe_client_key" required>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Stripe Secret Key</label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->stripe_secret_key) ? $setting->stripe_secret_key : '' }}" id=""
                            name="stripe_secret_key" required>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">PayPal Client Key</label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->paypal_client_key) ? $setting->paypal_client_key : '' }}" id=""
                            name="paypal_client_key" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">PayPal Secret Key</label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->paypal_secret_key) ? $setting->paypal_secret_key : '' }}" id=""
                            name="paypal_secret_key" required>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Amadeus Client Key</label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->amadeus_client_key) ? $setting->amadeus_client_key : '' }}" id=""
                            name="amadeus_client_key" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Amadeus Secret API Key </label>
                        <input type="text" class="form-control"
                            value="{{ isset($setting->amadeus_secret_key) ? $setting->amadeus_secret_key : '' }}" id=""
                            name="amadeus_secret_key" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary" value="dd">submit</button>
                </div>

            </div>
    </div>

    </form>

    <!-- <form action="#">
            <div class="row">
                    <div class="col-md-6">
            <input type="text" name="password" >
            <input type="text" name="confirm_password" >
            <input type="submit"  class="btn btn-primary"  >
</div>
            </form> -->

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

<style>
/* Style for the image preview blocks */
.preview-image-container {
    display: inline-block;
    margin: 5px;
    border: 1px solid #ddd;
    padding: 5px;
}

/* Style for the preview images */
.preview-image {
    max-width: 100px;
    /* Set the maximum width of the images */
    max-height: 100px;
    /* Set the maximum height of the images */
    display: block;
}
</style>

<script>
function previewImages() {
    var preview = document.getElementById("image-preview");
    preview.innerHTML = ''; // Clear the existing preview images

    var files = document.querySelectorAll(".images"); // Use querySelectorAll to select elements by class

    files.forEach(function(input) {
        Array.from(input.files).forEach(function(file) {
            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var image = document.createElement("img");
                    image.className = "preview-image";
                    image.src = e.target.result;
                    preview.appendChild(image);
                };

                reader.readAsDataURL(file);
            }
        });
    });
}

// Use addEventListener on each element with class "images"
var imageInputs = document.querySelectorAll(".images");
imageInputs.forEach(function(input) {
    input.addEventListener("change", previewImages);
});

// Call previewImages initially to display current images
previewImages();
</script>

<script>
$(document).ready(function() {

    // Counter to track the number of added fields
    let fieldCount = 0;

    // Function to create a new input field with a delete button
    function createInputField() {
        fieldCount++;
        const inputField = `<div class="row">
                <div class="col-md-6">


                                        <div class="form-group">
                                            <label>Time${fieldCount}</label>
                                            <input type="time" name="ava_time[]" class="form-control" value="">

                                            </div>

                <button type="button" style="width: 100px;" class=" btn m-2 btn-danger deleteBtn" id="deleteBtn">Remove</button>

                                   </div>
            `;
        return inputField;
    }

    // Add Field button click event handler
    $("#addFieldButton").on("click", function() {
        const newInputField = createInputField();
        $("#fieldContainer").append(newInputField);
    });

    // Delete button click event handler for dynamically added fields
    $(document).on("click", ".deleteBtn", function() {
        $(this).closest(".row").remove();
    });
});
</script>