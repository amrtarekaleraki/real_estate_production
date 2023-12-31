@extends('subscriber.subscriber_dashboard')

@section('subscriber')


<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: '#mytextarea',
      directionality: 'rtl',
      setup: function (editor) {
            editor.on('init', function () {
                editor.setContent('');
            });
        }
    });
</script>


<!-- Include flatpickr css -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Include flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<div class="page-content">


    <!-- start add building -->


    <form id="myForm" method="POST" action="{{ route('subscriber.store.building') }}" enctype="multipart/form-data">
        @csrf

      <div class="add-buildings">

           <div class="row mt-2">
               <div class="form-group col-lg-6 add-buildings-inputs">
                    <label for="">اسم العقار</label>
                    <input name="building_title" type="text" class="form-control" placeholder="الاسم">
               </div>

               <div class="form-group col-lg-6 add-buildings-inputs">
                  <label for="">العنوان</label>
                  <input name="building_location" type="text" class="form-control" placeholder="العنوان">
               </div>
           </div>

           <div class="row mt-3">
                <div class="col-lg-6 add-buildings-inputs">
                    <label for="">المنطقه</label>
                    <input name="area" type="text" placeholder="اسم المنطقه">
                </div>

                <div class="col-lg-6 add-buildings-inputs">
                    <label for="">القطعه</label>
                    <input name="place" type="text" placeholder="القطعه">
                </div>
           </div>

           <div class="row mt-3">
                <div class="col-lg-12 add-buildings-inputs">
                    <label for="">وصف العقار</label>
                    <textarea name="building_desc" id="mytextarea">Hello, World!</textarea>
                </div>
           </div>

           <div class="row mt-3">
            <div class="col-lg-4 add-buildings-inputs">
                 <label for="">المساحه الكليه (متر)</label>
                 <input name="building_size" type="number" min="1" placeholder=" المساحه">
            </div>

            <div class="col-lg-4 add-buildings-inputs">
                <label for="">السعر (دينار)</label>
                <input name="building_price" type="number" min="1" placeholder="السعر">
           </div>


           <div class="col-lg-4 add-buildings-inputs">
            <label for="">عدد الغرف</label>
            <input name="rooms_num" type="number" min="1" placeholder="العدد">
           </div>
           </div>

           <div class="row mt-3">
            <div class="col-lg-4 add-buildings-inputs">
                 <label for="">الحمامات</label>
                 <input name="bathroom_num" type="number" min="1" placeholder=" العدد">
            </div>

            <div class="col-lg-4 add-buildings-inputs">
                <label for="">الدور</label>
                <input name="floor" type="number" min="1" placeholder="العدد">
           </div>


           <div class="col-lg-4 add-buildings-inputs">
            <label for="">عدد الادوار المتاحه</label>
            <input name="floor_num" type="number" min="1" placeholder="العدد">
           </div>
           </div>

           <div class="row mt-3">
            <div class="col-lg-12 add-buildings-inputs">
                 <label for="">ملاحظات</label>
                 <input name="notes" type="text" placeholder="ملاحظات">
            </div>

           <div class="row mt-3">

            <div class="col-lg-4 add-buildings-inputs">
                <label for="">نوع العقار</label>
                <select name="building_selling_status" id="">
                     <option hidden class="option-title">نوع العقار</option>
                     <option value="rent">إيجار</option>
                     <option value="sell">بيع</option>
                </select>
            </div>

            <div class="col-lg-4 add-buildings-inputs">
                <label for="">حاله العقار</label>
                <select name="building_avilability_status" id="">
                     <option hidden class="option-title">حاله العقار</option>
                     <option value="bussy">مشغول</option>
                     <option value="empty">خالي</option>
                </select>
            </div>


            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">القسم</label>
                <select name="category_id" id="" required>
                     <option hidden class="option-title" value="">نوع القسم</option>
                     @foreach($categories as $category)
                       <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                     @endforeach
                </select>
            </div>

            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">اسم المالك</label>
                <select name="owner_id" id="">
                     <option hidden class="option-title">اسم المالك</option>
                     @foreach($owners as $owner)
                       <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                     @endforeach
                </select>
            </div>


            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">اسم المشتري او المستاجر</label>
                <select name="tenant_id" id="" required>
                     <option hidden class="option-title"  value="">اسم المشتري او المستاجر</option>
                     @foreach($tenants as $tenant)
                       <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                     @endforeach
                </select>
            </div>

            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">حاله الانترنت</label>
                <select name="wifi_status" id="">
                     <option hidden class="option-title">حاله الانترنت</option>
                     <option value="yes">يوجد</option>
                     <option value="no">لا يوجد</option>
                </select>
            </div>


            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">حاله الجراج</label>
                <select name="parking_status" id="">
                     <option hidden class="option-title">حاله الجراج</option>
                     <option value="yes">يوجد</option>
                     <option value="no">لا يوجد</option>
                </select>
            </div>


            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">حاله العقار</label>
                <select name="status" id="">
                    <option hidden class="option-title">حاله العقار</option>
                    <option value="active">مفعل</option>
                    <option value="inactive">غير مفعل</option>
                </select>
            </div>


            <div class="form-group col-lg-4 add-buildings-inputs">
                <label for="">صوره الغلاف</label>
                <label for="cover-count" class="custom-file-upload">
                  <input  type="file" id="coverImg" class="input-file" name="building_cover_img"  onchange="showFileCount(this, 'cover-count')">
                  <span class="custom-file-upload-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                      <path d="M8.9001 7.13318V8.64429C8.9001 8.84468 8.8205 9.03685 8.6788 9.17855C8.53711 9.32024 8.34493 9.39985 8.14454 9.39985H2.85565C2.65527 9.39985 2.46309 9.32024 2.32139 9.17855C2.1797 9.03685 2.1001 8.84468 2.1001 8.64429V7.13318" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7.38911 4.48874L5.50022 2.59985L3.61133 4.48874" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M5.5 2.59985V7.13319" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <span class="custom-file-upload-text"> حمل الصور </span>
                </label>
                <span style="display: none;" id="cover-count" class="cover-count">لايوجد ملفات تم رفعها</span>

                 <div class="row" id="preview_img"></div>
              </div>
           </div>


           <div class="row mt-3">

            <div class="col-lg-6 add-buildings-inputs">
                <label for="">باقي الصور</label>
                <label for="image-file" class="custom-file-upload">
                  <input type="file" id="image-file" class="input-file" name="multi_img[]" multiple onchange="showFileCount(this, 'file-count')">
                  <span class="custom-file-upload-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                      <path d="M8.9001 7.13318V8.64429C8.9001 8.84468 8.8205 9.03685 8.6788 9.17855C8.53711 9.32024 8.34493 9.39985 8.14454 9.39985H2.85565C2.65527 9.39985 2.46309 9.32024 2.32139 9.17855C2.1797 9.03685 2.1001 8.84468 2.1001 8.64429V7.13318" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7.38911 4.48874L5.50022 2.59985L3.61133 4.48874" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M5.5 2.59985V7.13319" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <span class="custom-file-upload-text"> حمل الصور </span>
                </label>
                <span style="display: none;" id="file-count" class="file-count">لايوجد ملفات تم رفعها</span>
            </div>


            <div class="col-lg-6 add-buildings-inputs">
                <label for=""> الفيديو</label>
                <label for="video-file" class="custom-file-upload">
                  <input type="file" id="video-file" class="input-file" name="multi_vid[]" multiple onchange="showFileCount(this, 'video-count')">
                  <span class="custom-file-upload-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M2.5 3.32783C2.5 2.87063 2.87079 2.5 3.32783 2.5H16.6722C17.1293 2.5 17.5 2.87079 17.5 3.32783V16.6722C17.5 17.1293 17.1292 17.5 16.6722 17.5H3.32783C2.87063 17.5 2.5 17.1292 2.5 16.6722V3.32783ZM4.16667 4.16667V15.8333H15.8333V4.16667H4.16667ZM8.85158 7.01216L12.9173 9.72267C13.0705 9.82475 13.1119 10.0317 13.0097 10.1849C12.9853 10.2215 12.9539 10.2529 12.9173 10.2773L8.85158 12.9878C8.69842 13.09 8.49142 13.0486 8.38933 12.8954C8.35283 12.8407 8.33333 12.7763 8.33333 12.7105V7.28951C8.33333 7.10541 8.48258 6.95617 8.66667 6.95617C8.7325 6.95617 8.79683 6.97565 8.85158 7.01216Z" fill="#489EB5"/>
                    </svg>
                  </span>
                  <span class="custom-file-upload-text"> حمل الفيديو </span>
                </label>
                <span style="display: none;" id="video-count" class="video-count">لايوجد فيديوهات تم رفعها</span>
              </div>

            </div>



              <hr style="color: #ACACAC; margin:auto; width:93%">



           <div class="row mt-3">

                <div class="form-group col-lg-4 add-buildings-inputs">
                    <label for="">قيمه العقد</label>
                    <input name="contract_price" type="number" min="1" class="form-control" placeholder="القيمه">
                </div>

                <div class="form-group col-lg-4 add-buildings-inputs">
                    <label for=""> يوم تحصيل قيمة العقد</label>
                    <label style="width: 100%;">
                      <input name="contract_date" class="form-control" type="date" id="myDateInput"  style="width: 100%;"   placeholder="اضغط للاختيار" >
                    </label>
                </div>

                {{-- id="myDateInput" --}}


                <div class="form-group col-lg-4 add-buildings-inputs">
                    <label for="">مده العقد</label>
                    <input name="contract_longtime" type="text" class="form-control" placeholder=" مده العقد ">
                </div>

           </div>


           <div class="row mt-3">
               <div class="form-group col-lg-12 add-buildings-inputs">
                <label for="">صوره العقد</label>
                <label for="contract-file" class="custom-file-upload">
                  <input name="contract_img" type="file" id="contract-file" class="contract-file form-control"  onchange="showFileCount(this, 'contract-count')">
                  <span class="custom-file-upload-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="12" viewBox="0 0 11 12" fill="none">
                      <path d="M8.9001 7.13318V8.64429C8.9001 8.84468 8.8205 9.03685 8.6788 9.17855C8.53711 9.32024 8.34493 9.39985 8.14454 9.39985H2.85565C2.65527 9.39985 2.46309 9.32024 2.32139 9.17855C2.1797 9.03685 2.1001 8.84468 2.1001 8.64429V7.13318" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M7.38911 4.48874L5.50022 2.59985L3.61133 4.48874" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M5.5 2.59985V7.13319" stroke="#489EB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <span class="custom-file-upload-text"> حمل الصور </span>
                </label>
                <span style="display: none;" id="contract-count" class="contract-count">لايوجد ملفات تم رفعها</span>
              </div>


           </div>


      </div>


      <div class="row mt-3">
        <div class="add-permision-item-button">
            <input type="submit" value="حفظ">
        </div>
      </div>


    </form>

    <!--end add building-->
  </div>







  <script>
    function showFileCount(input, countElementId) {
    const countElement = document.getElementById(countElementId);
    if (input.files && input.files.length > 0) {
      countElement.textContent = input.files.length + ' ملفات تم اختيارها';
      countElement.style.display = 'inline-block';
    } else {
      countElement.textContent = 'لا يوجد ملفات ';
      countElement.style.display = 'none';
    }
  }

</script>

<script>
flatpickr('#myDateInput', {
dateFormat: 'Y/m/d', // Set your desired date format here

});
</script>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                building_cover_img: {
                    required : true,
                },
                building_title: {
                    required : true,
                },
                building_location: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                contract_price: {
                    required : true,
                },
                contract_date: {
                    required : true,
                },
                contract_longtime: {
                    required : true,
                },
                tenant_id: {
                    required : true,
                },
            },
            messages :{
                building_cover_img: {
                    required : 'صوره العقار مطلوبه',
                },
                building_title: {
                    required : 'اسم العقار مطلوب',
                },
                building_location: {
                    required : 'عنوان العقار مطلوب',
                },
                category_id: {
                    required : 'اسم القسم مطلوب',
                },
                contract_price: {
                    required : ' قيمه العقد مطلوب',
                },
                contract_date: {
                    required : ' تاريخ التعاقد مطلوب',
                },
                contract_longtime: {
                    required : ' مده التعاقد مطلوب',
                },
                tenant_id: {
                    required : 'اسم المشتري او المستاجر مطلوب',
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


<script>

    $(document).ready(function(){
     $('#coverImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });

    </script>



@endsection
