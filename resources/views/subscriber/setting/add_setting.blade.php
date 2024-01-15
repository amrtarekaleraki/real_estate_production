@extends('subscriber.subscriber_dashboard')

@section('subscriber')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<div class="page-content">

    <!-- start permisions -->

     <div class="container">

        <div class="all-files">

            <form id="myForm" method="POST" action="{{ route('subscriber.store.settings') }}" enctype="multipart/form-data">
                @csrf

                    <div class="row p-3">
                        <div class="form-group col-lg-6 add-buildings-inputs">
                             <label for="">اسم الشركه </label>
                             <input name="name" type="text" placeholder=" الاسم">
                        </div>

                        <div class="col-lg-6 add-buildings-inputs">
                            <label for="">الموقع</label>
                            <input name="location" type="text" placeholder="الموقع">
                       </div>

                       <div class="col-lg-6 add-buildings-inputs">
                           <label for="">الايميل</label>
                           <input name="email" type="text" placeholder="الايميل">
                        </div>


                        <div class="col-lg-6 add-buildings-inputs">
                        <label for="">رقم الهاتف</label>
                        <input name="phone" type="text" placeholder="الهاتف">
                        </div>


                        {{-- <div class="col-lg-6" style="display: flex; align-items:center;gap:40px;">

                            <label style="font-family:Cairo;font-size:19px;font-style:normal;font-weight:500;line-height:120%;color:#1B1B1B;">الشعار</label>
                            <div class="mb-3" style="border:1px solid #D4D4D4;">
                                <label for="logo" class="form-label"></label>
                                <input type="file" id="logo" name="logo" style="display: none;" onchange="previewImage(event)">
                                <img id="preview" src="{{ asset($setting->logo) }}" style="width:100px; height:100px"
                                     onclick='document.getElementById("logo").click()'>
                                @if ($errors->has('logo'))
                                   <span class="text-danger">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>

                        </div> --}}

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

    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('preview');
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
