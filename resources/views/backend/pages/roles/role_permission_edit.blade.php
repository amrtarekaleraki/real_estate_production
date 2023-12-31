@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">

    <!-- start permisions -->

     <div class="container">

        <div class="col-lg-12">
            <div class="all-files-title">
                <h2>ربط الصلاحيات بالادوار</h2>
            </div>
        </div>

    <div class="all-files">


        <form id="myForm" method="post" action="{{ route('admin.roles.update',$role->id) }}"  >
                @csrf

            <div class="row mb-3 p-3">
                <div class="col-lg-3">
                  <h2 class="mb-0">اسم الدور</h2>
                </div>
                <div class="form-group col-lg-9 text-secondary">
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}" disabled>
                </div>



			</div>


			{{-- <hr> --}}


            <div class="row p-3">

                <div class="col-lg-4">
                        <div class="d-flex gap-2 p-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultAll">
                            <label class="form-check-label add-permision-item-heading" for="flexCheckDefaultAll">كل الصلاحيات</label>
                        </div>
                </div>

                <hr>

                @foreach($permission_groups as $group)
                        <div class="col-lg-4">

                            @php
                               $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                            @endphp

                            <div class="add-permision-item">
                                <div class="d-flex gap-2 p-2">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label add-permision-item-heading" for="flexCheckDefault">{{ $group->group_name }}</label>
                                </div>
                                <hr>

                                    @foreach($permissions as $permission)
                                        <div class="d-flex gap-2 add-permision-item-data">
                                            <input class="form-check-input" name="permission[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox" value="{{$permission->id}}" id="flexCheckDefault{{$permission->id}}">
                                            <label class="form-check-label" for="flexCheckDefault{{$permission->id}}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach


                            </div>
                        </div>
                @endforeach



            </div>


            <div class="add-permision-item-button">
                <input type="submit" value="حفظ">
            </div>

        </form>

    </div>


     </div>



</div>




<script type="text/javascript">
	$('#flexCheckDefaultAll').click(function(){
		if ($(this).is(':checked')) {
			$('input[type = checkbox]').prop('checked',true);
		}else{
			$('input[type = checkbox]').prop('checked',false);
		}
	});
</script>


@endsection
