@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3" style="border-left: 0;">تعديل صلاحيه</div>
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">

<div class="col-lg-10">
	<div class="card">
		<div class="card-body">

		<form id="myForm" method="post" action="{{ route('update.permission') }}"  >
			@csrf
		 <input type="hidden" name="id" value="{{ $permission->id }}">

			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">اسم الصلاحيه</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">
					<input type="text" name="name" class="form-control" value="{{ $permission->name }}"   />
				</div>
			</div>


			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">المجموعه</h6>
				</div>
				<div class="form-group col-sm-9 text-secondary">

                    <select name="group_name" class="form-select mb-3" aria-label="Default select example" required>
                        <option selected="" hidden>اختر المجموعه</option>
                        <option value="اداره العقارات" {{ $permission->group_name == 'اداره العقارات' ? 'selected': ''}}>اداره العقارات</option>
                        <option value="المشتركين" {{ $permission->group_name == 'المشتركين' ? 'selected': ''}}>المشتركين</option>
                        <option value="المستاجرين والملاك" {{ $permission->group_name == 'المستاجرين والملاك' ? 'selected': ''}}>المستاجرين والملاك</option>
                        <option value="الصلاحيات و الادوار" {{ $permission->group_name == 'الصلاحيات و الادوار' ? 'selected': ''}}>الصلاحيات و الادوار</option>
                        <option value="المشرفين" {{ $permission->group_name == 'المشرفين' ? 'selected': ''}}>المشرفين</option>
                        <option value="الاعدادات" {{ $permission->group_name == 'الاعدادات' ? 'selected': ''}}>الاعدادات</option>
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
