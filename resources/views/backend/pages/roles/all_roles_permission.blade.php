@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3" style="border-left: 0;">جميع الصلاحيات مع الادوار</div>
				</div>
				<!--end breadcrumb-->

				<hr/>
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
                        <a href="{{ route('admin.edit.roles',$item->id) }}" class="btn btn-info">تعديل</a>
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




@endsection
