@extends('admin.admin_dashboard')

@section('admin')


<div class="page-content">

     <div class="container">

        <div class="all-files">

            <div class="row p-3">

                <div class="col-lg-12">
                    <div class="all-files-title">
                        <h2>المعلومات الشخصيه</h2>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                    @csrf

                <div class="row p-3">
                    <div class="col-lg-2 profile-settings-img">
                        <label for="file-input" class="profile-settings-img-parent">
                            <img id="preview-image" src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo)  : url('upload/no_image.jpg') }}" alt="Profile Image">
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
                </div>

                    <div class="row p-3">

                        <div class="col-lg-6 add-buildings-inputs">
                             <label for=""> الاسم بالكامل </label>
                             <input name="name" type="text" placeholder=" الاسم" value="{{ $adminData->name }}">
                        </div>

                        <div class="col-lg-6 add-buildings-inputs">
                            <label for="">البريد الالكتروني</label>
                            <input name="email" type="text" placeholder="البريد" value="{{ $adminData->email }}">
                       </div>

                        <div class="col-lg-6 add-buildings-inputs">
                        <label for="">رقم الهاتف</label>
                        <input name="phone" type="text" placeholder="الهاتف" value="{{ $adminData->phone }}">
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



@endsection
