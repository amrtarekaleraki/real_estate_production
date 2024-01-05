@extends('admin.admin_dashboard')


@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<div class="page-content">

    <!-- start permisions -->

     <div class="container">

        <div class="all-files">

            <form id="myForm" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $setting->id }}">

                    <div class="row p-3">
                        <div class="form-group col-lg-6 add-buildings-inputs">
                             <label for="">اسم الشركه </label>
                             <input name="name" type="text" placeholder=" الاسم" value="{{ $setting->name }}">
                        </div>

                        <div class="col-lg-6 add-buildings-inputs">
                            <label for="">الموقع</label>
                            <input name="location" type="text" placeholder="الموقع" value="{{ $setting->location }}">
                       </div>

                       <div class="col-lg-6 add-buildings-inputs">
                           <label for="">الايميل</label>
                           <input name="email" type="text" placeholder="الايميل" value="{{ $setting->email }}">
                        </div>


                        <div class="col-lg-6 add-buildings-inputs">
                        <label for="">رقم الهاتف</label>
                        <input name="phone" type="text" placeholder="الهاتف" value="{{ $setting->phone }}">
                        </div>


                        <div class="col-lg-6" style="display: flex; align-items:center;gap:40px;">

                            <label style="font-family:Cairo;font-size:19px;font-style:normal;font-weight:500;line-height:120%;color:#1B1B1B;">الشعار</label>
                            {{-- <div class="custom-file-upload">
                                <input type="file" id="logo" class="input-file" name="logo" onchange="previewImage(event)">
                                <label for="logo" class="custom-file-upload-label">
                                    <span class="custom-file-upload-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                                            <path d="M8.9001 7.13318V8.64429C8.9001 8.84468 8.8205 9.03685 8.6788 9.17855C8.53711 9.32024 8.34493 9.39985 8.14454 9.39985H2.85565C2.65527 9.39985 2.46309 9.32024 2.32139 9.17855C2.1797 9.03685 2.1001 8.84468 2.1001 8.64429V7.13318" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.38911 4.48874L5.50022 2.59985L3.61133 4.48874" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.5 2.59985V7.13319" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="custom-file-upload-text" style="margin-right: 10px;"> حمل الصور </span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for="logo" class="form-label"></label>
                                <img id="preview" src="{{ asset($setting->logo) }}" style="width:100px; height:100px">
                                @if ($errors->has('logo'))
                                   <span class="text-danger">{{ $errors->first('logo') }}</span>
                                @endif
                            </div> --}}

                            <div class="mb-3" style="border:1px solid #D4D4D4;">
                                <label for="logo" class="form-label"></label>
                                <input type="file" id="logo" name="logo" style="display: none;" onchange="previewImage(event)">
                                <img id="preview" src="{{ asset($setting->logo) }}" style="width:100px; height:100px"
                                     onclick='document.getElementById("logo").click()'>
                                @if ($errors->has('logo'))
                                   <span class="text-danger">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>

                        </div>


                        <div class="col-lg-6" style="display: flex; align-items:center;gap:40px;">
                            <label style="font-family:Cairo;font-size:19px;font-style:normal;font-weight:500;line-height:120%;color:#1B1B1B;">الفيف ايقون</label>
                            {{-- <div class="custom-file-upload">
                                <input type="file" id="favicon" class="input-file" name="favicon" onchange="previewImage2(event)">
                                <label for="favicon" class="custom-file-upload-label">
                                    <span class="custom-file-upload-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                                            <path d="M8.9001 7.13318V8.64429C8.9001 8.84468 8.8205 9.03685 8.6788 9.17855C8.53711 9.32024 8.34493 9.39985 8.14454 9.39985H2.85565C2.65527 9.39985 2.46309 9.32024 2.32139 9.17855C2.1797 9.03685 2.1001 8.84468 2.1001 8.64429V7.13318" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.38911 4.48874L5.50022 2.59985L3.61133 4.48874" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5.5 2.59985V7.13319" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="custom-file-upload-text" style="margin-right: 10px;"> حمل الصور </span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label for="favicon" class="form-label"></label>
                                <img id="preview2" src="{{ asset($setting->favicon) }}" style="width:100px; height:100px">
                                @if ($errors->has('favicon'))
                                   <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                @endif
                            </div> --}}


                            <div class="mb-3" style="border:1px solid #D4D4D4;">
                                <label for="favicon" class="form-label"></label>
                                <input type="file" id="favicon" name="favicon" style="display: none;" onchange="previewImage2(event)">
                                <img id="preview2" src="{{ asset($setting->favicon) }}" style="width:100px; height:100px"
                                     onclick='document.getElementById("favicon").click()'>
                                @if ($errors->has('favicon'))
                                   <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                @endif
                            </div>

                        </div>


                   </div>


                    <div class="add-permision-item-button">
                        <input type="submit" value="حفظ">
                    </div>

            </form>

        </div>


     </div>

    <!--end buildings-->









  </div>




<script>
    // function previewImage(event) {
    //     var reader = new FileReader();
    //     reader.onload = function () {
    //         var output = document.getElementById('preview');
    //         output.src = reader.result;
    //     };
    //     reader.readAsDataURL(event.target.files[0]);
    // }


    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('preview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    }

</script>

<script>
    // function previewImage2(event) {
    //     var reader = new FileReader();
    //     reader.onload = function () {
    //         var output = document.getElementById('preview2');
    //         output.src = reader.result;
    //     };
    //     reader.readAsDataURL(event.target.files[0]);
    // }

    function previewImage2(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('preview2');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

</script>





  <script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'اسم الشركه مطلوب',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>


@endsection
