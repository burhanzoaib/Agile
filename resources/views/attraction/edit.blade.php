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
    <div class="row">
        <div class="col">
            <h3 class="page-title fw-bold">{{ $section->heading }}</h3>
        </div>
    </div>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <form method="POST" action="{{ route('attraction.update', $Attraction->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                        <label for="title">City Title</label>
                        <input type="text" class="form-control" id="title" value="{{$Attraction->title}}" name="title"
                            required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="totalDays">Total Days</label>
                        <input type="text" class="form-control" id="totalDays" value="{{$Attraction->totalDays}}"
                            name="totalDays" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="capacity">Tour Type Section</label>
                        <select class="form-control" name="tour_type_section">
                            <option>Select Tour</option>
                            <option {{ ($Attraction->tour_type_section == "Private Tour" )? "Selected":"" }}  >Private Tour</option>
                            <option {{ ($Attraction->tour_type_section == "Group Tour" )? "Selected":"" }} >Group Tour</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ageRestriction">Age Restriction</label>
                        <input type="text" class="form-control" id="ageRestriction"
                            value="{{$Attraction->ageRestriction}}" name="ageRestriction" step="0.01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="oldPrice">Old Price</label>
                        <input type="number" class="form-control" id="oldPrice" value="{{$Attraction->oldPrice}}"
                            name="oldPrice" step="0.01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="newPrice">New Price</label>
                        <input type="number" class="form-control" id="newPrice" value="{{$Attraction->newPrice}}"
                            name="newPrice" step="0.01" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fromDate">From Date</label>
                        <input type="date" class="form-control" id="fromDate" value="{{$Attraction->fromDate}}"
                            name="fromDate" required>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="promoCode">Promo Code</label>
                        <input type="text" class="form-control" id="promoCode" value=""
                            name="promoCode" step="0.01" required>
                    </div>
                </div> -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="howManyPeople">Minimum People</label>
                        <input type="number" class="form-control" id="howManyPeople "
                            value="{{$Attraction->howManyPeople}}" name="howManyPeople" step="0.01" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longDetail">Long Details</label>
                        <textarea class="form-control ckeditor" id="longDetail" name="longDetail"
                            required>{{$Attraction->longDetail}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="highlights">Highlights</label>
                        <textarea class="form-control ckeditor" id="highlights" name="highlights" rows="3"
                            required>{{$Attraction->highlights}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="full_decription">Full Description</label>
                        <textarea class="form-control ckeditor" id="full_decription" name="full_decription" rows="3"
                            required>{{$Attraction->full_decription}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="includes">Includes</label>
                        <textarea class="form-control ckeditor" id="includes" name="includes" rows="3"
                            required>{{$Attraction->includes}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="not_suitable">Not Suitable</label>
                        <textarea class="form-control ckeditor" id="not_suitable" name="not_suitable" rows="3"
                            required>{{$Attraction->not_suitable}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meeting_point">Meeting Point</label>
                        <textarea class="form-control ckeditor" id="meeting_point" name="meeting_point" rows="3"
                            required>{{$Attraction->meeting_point}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="important_information">Important Information</label>
                        <textarea class="form-control ckeditor" id="important_information" name="important_information"
                            rows="3" required>{{$Attraction->important_information}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="singleLineDetail">Single Line Details</label>
                        <textarea class="form-control ckeditor" id="singleLineDetail" name="singleLineDetail" rows="3"
                            required>{{$Attraction->singleLineDetail}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Time</label>
                        @if(isset($Attraction))
                        @foreach($Attraction->time as $item)
                        <input type="time" name="ava_time[]" class="form-control" value="{{$item->time}}">
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Name">Select Position</label>
                        <select name="position" class="form-control">
                            <option value="">select</option>
                            <option value="1" {{ ($Attraction->position == 1)? "selected":""  }}>1</option>
                            <option value="2"{{ ($Attraction->position == 2)? "selected":""  }}>2</option>
                            <option value="3" {{ ($Attraction->position == 3)? "selected":""  }}>3</option>
                            <option value="4" {{ ($Attraction->position == 4)? "selected":""  }}>4</option>
                            <option value="5" {{ ($Attraction->position == 5)? "selected":""  }}>5</option>
                        </select>
                    </div>
                </div>
                <div id="fieldContainer" class="col-md-12">
                    <!-- Existing fields will be added here -->
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" id="addFieldButton">Add Field</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control images" id="" name="images[]" multiple accept="image/*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="images">Front Images</label>
                        <input type="file" class="form-control imagess" id="" name="front_images[]" accept="image/*">
                        <div id="current-images" class="p-2">
                            @if (isset($Attraction->front_images) && !empty(json_decode($Attraction->front_images)))
                            @foreach (json_decode($Attraction->front_images) as $image)
                            <img src="{{ $image }}" alt="Current Image" style="max-width: 200px;">
                            @endforeach
                            @else
                            <p>No images available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
    </div>
    </form>
    @if (isset($Attraction->images) && !empty(json_decode($Attraction->images)))
    <h3>Images</h3>
    <div class="row p-4">
        @foreach(json_decode($Attraction->images) as $index => $image)
        <div id="current-images" class="col-md-3">
            <img src="{{ $image }}" alt="Current Image" height="100px" width="150px">
            <form method="POST"
                action="{{ route('attraction.delete-image', ['id' => $Attraction->id, 'index' => $index]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger m-2"
                    onclick="return confirm('Are you sure you want to delete this image?')">Delete <i
                        class="fa fa-trash"></i></button>
            </form>
        </div>
        @endforeach
        @else
        <p>No images available</p>
    </div>
    @endif
</div>
</div>

@include('layouts.footer')
<script language="JavaScript">
$(document).ready(function() {
    var myForm = document.getElementById('myform');
    var submitButton = document.getElementById('subbtn');
    myForm.addEventListener('submit', function(event) {
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
<script>
function previewImages() {
    var preview = document.getElementById("image-preview");
    preview.innerHTML = '';
    var files = document.querySelectorAll(".images");
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
var imageInputs = document.querySelectorAll(".images");
imageInputs.forEach(function(input) {
    input.addEventListener("change", previewImages);
});
previewImages();
</script>
<script>
function frontpreviewImages() {
    var preview = document.getElementById("image-previews");
    preview.innerHTML = '';
    var files = document.querySelectorAll(".imagess");
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
var imageInputs = document.querySelectorAll(".imagess");
imageInputs.forEach(function(input) {
    input.addEventListener("change", frontpreviewImages);
});
frontpreviewImages();
</script>
<script>
$(document).ready(function() {
    let fieldCount = 0;

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
    $("#addFieldButton").on("click", function() {
        const newInputField = createInputField();
        $("#fieldContainer").append(newInputField);
    });
    $(document).on("click", ".deleteBtn", function() {
        $(this).closest(".row").remove();
    });
});
</script>
</body>

</html>
