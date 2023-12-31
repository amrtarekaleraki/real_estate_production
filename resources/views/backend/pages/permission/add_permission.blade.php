@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3" style="border-left: 0;">إضافه صلاحيه</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

		<form id="myForm" method="post" action="{{ route('store.permission') }}"  >
			@csrf

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">اسم الصلاحيه</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control"   />
				</div>
			</div>


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">المجموعه</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					{{-- <select name="group_name" class="form-select mb-3" aria-label="Default select example">
					<option selected="" hidden>اختر المجموعه</option>
					<option value="buildings">اداره العقارات</option>
					<option value="subscribers">المشتركين</option>
					<option value="owners">المستاجرين والملاك</option>
					<option value="roles">الصلاحيات و الادوار</option>
					<option value="moderators">المشرفين</option>
					<option value="reports">تقارير</option>
					<option value="settings">الاعدادات</option>
				</select> --}}

                <select name="group_name" class="form-select mb-3" aria-label="Default select example" required>
					<option selected="" hidden>اختر المجموعه</option>
					<option value="اداره العقارات">اداره العقارات</option>
					<option value="المشتركين">المشتركين</option>
					<option value="المستاجرين والملاك">المستاجرين والملاك</option>
					<option value="الصلاحيات و الادوار">الصلاحيات و الادوار</option>
					<option value="المشرفين">المشرفين</option>
					<option value="الاعدادات">الاعدادات</option>
				</select>

				</div>
			</div>




			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 text-secondary">
					<input type="submit" class="btn btn-primary px-4" value="حفظ" />
				</div>
			</div>
		</div>

		</form>



	</div>




							</div>
						</div>
					</div>
				</div>
			</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                group_name: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'اسم الصلاحيه مطلوب',
                },
                group_name: {
                    required : 'اسم المجموعه مطلوب',
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
