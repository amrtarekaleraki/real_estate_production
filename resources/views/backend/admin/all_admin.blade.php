@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">
    <div class="all-files">
            <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">المشرفين</div>

        <div class="ms-auto">
            <div class="btn-group">
           <a href="{{ route('add.admin') }}" class="btn btn-primary">إضافه مشرف</a>


            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
<tr>
    <th>رقم التسلسل</th>
    <th>اسم المشرف</th>
    <th>الدور</th>
    <th>الحاله</th>
    <th>العمليات</th>
</tr>
</thead>
<tbody>
@foreach($alladminuser as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->name }}</td>
    <td>
        @foreach($item->roles as $role)
          <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
        @endforeach
    </td>
    <td>
        @if($item->status === 'active')

                <div class="toggle-btn">
                    <a href="{{ route('admin.inactive',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}" title="مفعل">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>

        @else
                <div class="toggle-btn">
                    <a href="{{ route('admin.active',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}" title="غير مفعل">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>
        @endif
    </td>



    <td>
<a href="{{ route('edit.admin.role',$item->id) }}" class="btn btn-info">تعديل</a>
<a href="{{ route('delete.admin.role',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
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



<script>
    $(document).ready(function() {
        $('.checkbox').click(function(e) {
            e.preventDefault(); // Prevent default link behavior

            var $checkbox = $(this);
            var itemId = $checkbox.attr('id').split('_')[1]; // Extract item ID

            // Simulate checkbox behavior
            $checkbox.toggleClass('checked');

            // Redirect to the appropriate route based on the checkbox state
            var route = $checkbox.hasClass('checked') ? "{{ route('subscriber.inactive', ':id') }}" : "{{ route('subscriber.active', ':id') }}";
            route = route.replace(':id', itemId); // Replace placeholder with item ID
            window.location.href = route;
        });
    });
</script>


@endsection
