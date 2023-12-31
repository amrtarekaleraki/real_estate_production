@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    .toggle-password {
position: absolute;
left: 10px;
top: 50%;
transform: translateY(-50%);
cursor: pointer;
}

.password-container {
position: relative;
}
.password-container input
{
    width: 100% !important;
}

</style>





<div class="page-content">

     <div class="container">

        <div class="all-files">

            <div class="row p-3">

                <div class="col-lg-12">
                    <div class="all-files-title">
                        <h2>تعديل مشرف</h2>
                    </div>
                </div>

                <form id="myForm" method="POST" action="{{ route('admin.user.update',$user->id) }}">
                    @csrf

                {{-- <div class="row p-3">
                    <div class="col-lg-2 profile-settings-img">
                        <label for="file-input" class="profile-settings-img-parent">
                            <img id="preview-image" src="{{ asset('upload/no_image.jpg') }}" alt="Profile Image">
                            <div class="profile-settings-upload-img">
                                <span style="color: black;">ارفع الصوره</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                  <path d="M7.21875 7.00598L10.5 3.72559L13.7812 7.00598" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path d="M10.5 12.4752V3.72754" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                  <path d="M17.375 12.4756V16.8506C17.375 17.0163 17.3092 17.1753 17.1919 17.2925C17.0747 17.4097 16.9158 17.4756 16.75 17.4756H4.25C4.08424 17.4756 3.92527 17.4097 3.80806 17.2925C3.69085 17.1753 3.625 17.0163 3.625 16.8506V12.4756" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                          </div>
                        </label>
                        <input type="file" name="photo" id="file-input" style="display: none">
                    </div>
                </div> --}}

                    <div class="row p-3">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                        <div class="form-group col-lg-6 add-buildings-inputs">
                             <label for=""> الاسم بالكامل </label>
                             <input name="name" type="text" class="form-control"  placeholder=" الاسم" value="{{ $user->name }}">
                        </div>

                        <div class="form-group col-lg-6 add-buildings-inputs">
                            <label for="">البريد الالكتروني</label>
                            <input name="email" type="text" class="form-control" placeholder="البريد" value="{{ $user->email }}">
                       </div>

                        <div class="col-lg-6 add-buildings-inputs">
                        <label for="">رقم الهاتف</label>
                        <input name="phone" type="text" placeholder="الهاتف" value="{{ $user->phone }}">
                        </div>


                        {{-- <div class="form-group col-lg-6 add-buildings-inputs">
                            <label for="password">كلمة المرور</label>
                            <div class="password-container">
                                <input id="password" class="form-control" name="password" type="password" placeholder="كلمة المرور" value="">
                                <i class="toggle-password bx bx-show" onclick="togglePassword()"></i>
                            </div>
                        </div> --}}



                        <div class="form-group col-lg-6 add-buildings-inputs">
                                <label for="password">الدور</label>
                                <select name="roles" class="form-select mb-3" aria-label="Default select example">
                                    <option value=""  hidden>اختر الدور</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }} >{{ $role->name }}</option>
                                     @endforeach
                            </select>
                        </div>







                   </div>


                    <div class="add-permision-item-button">
                        <input type="submit" value="حفظ">
                    </div>

                </form>

            </div>
        </div>

     </div>

  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');

        // Event listener to handle changes in the file input
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();

                // Read the selected image file
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };

                // Display the selected image file
                reader.readAsDataURL(file);
            }
        });

        // Event listener to toggle file input visibility when the image is clicked
        previewImage.addEventListener('click', function() {
            // fileInput.click(); // Trigger click on file input
            fileInput.addEventListener('focusout', function hideFileInput() {
                fileInput.style.display = 'none'; // Hide file input after interaction
                fileInput.removeEventListener('focusout', hideFileInput);
            });
        });
    });



             </script>



<script>
    function togglePassword() {
    const passwordField = document.getElementById("password");
    const toggleBtn = document.querySelector(".toggle-password");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleBtn.classList.remove("bx-show");
        toggleBtn.classList.add("bx-hide");
    } else {
        passwordField.type = "password";
        toggleBtn.classList.remove("bx-hide");
        toggleBtn.classList.add("bx-show");
    }
}
</script>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                email: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'اسم المشرف مطلوب',
                },
                email: {
                    required : ' ايميل المشرف مطلوب',
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
