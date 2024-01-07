@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <div class="all-files">

				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
					<div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">جميع الصلاحيات مع الادوار</div>
				</div>
				<!--end breadcrumb-->

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>#</th>
				<th>اسم الدور</th>
				<th>الصلحيات</th>
				<th>العمليات</th>
			</tr>
		</thead>
		<tbody>
	        @foreach($roles as $key => $item)
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td>{{ $item->name }}</td>
                    <td>
                            @foreach($item->permissions as $perm)
                            <span class="badge rounded-pill bg-primary"> {{ $perm->name }}</span>
                            @endforeach
                    </td>

                    <td>
                        <a href="{{ route('admin.edit.roles',$item->id) }}" class="btn" style="background-color:#489EB5;color:#FFF;">تعديل</a>
                        <a href="{{ route('admin.delete.roles',$item->id) }}" class="btn btn-danger" id="delete" >حذف</a>
                    </td>
                </tr>
			@endforeach
		</tbody>
	</table>
						</div>
					</div>
				</div>



			</div>

</div>



@endsection
