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


        <form method="POST" action="{{ route('attraction.store') }}" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Attraction Title</label>
                        <input type="text" class="form-control" id="title" name="title"  value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="totalDays">Total Days</label>
                        <input type="text" class="form-control" id="totalDays" name="totalDays" value="{{ old('totalDays') }}" step="0.01"  required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="capacity">Tour Type Section</label>
                        <select class="form-control" name="tour_type_section">
                            <option>Select Tour</option>
                            <option>Private Tour</option>
                            <option>Group Tour</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ageRestriction">Age Restriction</label>
                        <input type="text" class="form-control" id="ageRestriction" name="ageRestriction" value="{{ old('ageRestriction') }}" step="0.01"
                            >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oldPrice">Old Price</label>
                        <input type="number" class="form-control" id="oldPrice" value="{{ old('oldPrice') }}" name="oldPrice" step="0.01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="newPrice">New Price</label>
                        <input type="number" class="form-control" id="newPrice" name="newPrice" value="{{ old('newPrice') }}" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fromDate">From Date</label>
                        <input type="date" class="form-control" id="fromDate" value="{{ old('fromDate') }}" name="fromDate" required>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="promoCode">Promo Code</label>
                        <input type="text" class="form-control" id="promoCode" name="promoCode" step="0.01" value="{{ old('promoCode') }}" required>
                    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="howManyPeople">Minimum People</label>
                        <input type="number" class="form-control" id="howManyPeople" name="howManyPeople" step="0.01"
                        value="{{ old('howManyPeople') }}"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control images" id="" name="images[]" multiple>
                        <div id="image-preview" class="mt-2"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">Front Images</label>
                        <input type="file" class="form-control imagess" id="" name="front_images[]">
                        <div id="image-previews" class="mt-2"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longDetail">Long Details</label>
                        <textarea type="text" class="form-control ckeditor" id="longDetail" name="longDetail"
                            required>{{ old('longDetail') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="singleLineDetail">Single Line Details</label>
                        <textarea class="form-control ckeditor" id="singleLineDetail" name="singleLineDetail" rows="3"
                            required>{{ old('singleLineDetail') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="highlights">Highlights</label>
                        <textarea class="form-control ckeditor" id="highlights" name="highlights" rows="3"
                            required>{{ old('highlights') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="full_decription">Full Description</label>
                        <textarea class="form-control ckeditor" id="full_decription" name="full_decription" rows="3"
                            required>{{ old('full_decription') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="includes">Includes</label>
                        <textarea class="form-control ckeditor" id="includes" name="includes" rows="3"
                            required>{{ old('includes') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="not_suitable">Not Suitable</label>
                        <textarea class="form-control ckeditor" id="not_suitable" name="not_suitable" rows="3"
                            required>{{ old('not_suitable') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meeting_point">Meeting Point</label>
                        <textarea class="form-control ckeditor" id="meeting_point" name="meeting_point" rows="3"
                            required>{{ old('meeting_point') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="important_information">Important Information</label>
                        <textarea class="form-control ckeditor" id="important_information" name="important_information"
                            rows="3" required>{{ old('important_information') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="ava_time[]" class="form-control" value="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Name">Select Position</label>
                        <select name="position" class="form-control">
                            <option value=""{{ old('position') == '' ? 'selected' : '' }}>Select Option</option>
                            <option value="1" {{ old('position') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('position') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('position') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('position') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('position') == '5' ? 'selected' : '' }}>5</option>
                            <option value="6" {{ old('position') == '6' ? 'selected' : '' }}>6</option>
                            <option value="7" {{ old('position') == '7' ? 'selected' : '' }}>7</option>
                            <option value="8" {{ old('position') == '8' ? 'selected' : '' }}>8</option>
                            <option value="9" {{ old('position') == '9' ? 'selected' : '' }}>9</option>
                            <option value="10" {{ old('position') == '10' ? 'selected' : '' }}>10</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="fieldContainer">
                <!-- Existing fields will be added here -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary" id="addFieldButton">Add Field</button>
                </div>

                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </div>
</div>
</form>

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

    for (var i = 0; i < files.length; i++) {
        var file = files[i].files[0]; // Access the files property of the element

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var previewImageContainer = document.createElement("div");
                previewImageContainer.className = "preview-image-container";

                var image = document.createElement("img");
                image.className = "preview-image";
                image.src = e.target.result;

                previewImageContainer.appendChild(image);
                preview.appendChild(previewImageContainer);
            };

            reader.readAsDataURL(file);
        }
    }
}

// Use addEventListener on each element with class "images"
var imageInputs = document.querySelectorAll(".images");
imageInputs.forEach(function(input) {
    input.addEventListener("change", previewImages);
});
</script>

<!-- front image -->


<script>
function previewFrontImages() {
    var preview = document.getElementById("image-previews");
    preview.innerHTML = ''; // Clear the existing preview images

    var files = document.querySelectorAll(".imagess"); // Use querySelectorAll to select elements by class

    for (var i = 0; i < files.length; i++) {
        var file = files[i].files[0]; // Access the files property of the element

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var previewImageContainer = document.createElement("div");
                previewImageContainer.className = "preview-image-container";

                var image = document.createElement("img");
                image.className = "preview-image";
                image.src = e.target.result;

                previewImageContainer.appendChild(image);
                preview.appendChild(previewImageContainer);
            };

            reader.readAsDataURL(file);
        }
    }
}

// Use addEventListener on each element with class "images"
var imageInputs = document.querySelectorAll(".imagess");
imageInputs.forEach(function(input) {
    input.addEventListener("change", previewFrontImages);
});
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




</body>

</html>
