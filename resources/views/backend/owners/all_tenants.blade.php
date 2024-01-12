@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">

    <div class="all-files">


    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">كل المستأجرين </div>

        <div class="ms-auto">
            <div class="btn-group">
                @if(Auth::user()->can('اضافه مستاجر او مالك'))
           <a href="{{ route('admin.add.owner') }}" class="btn btn-primary">إضافه مستأجر</a>
              @endif

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
    <th>اسم المستأجر </th>
    <th>النوع</th>
    <th>الحاله</th>
    <th>رقم الهاتف</th>
    <th>تمت الاضافه بواسطه</th>
    <th>العمليات</th>
</tr>
</thead>
<tbody>
@foreach($tenants as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->role === "tenant" ? 'مستأجر' : 'مالك' }}</td>
    <td>
@if(Auth::user()->can('تغيير حاله مستاجر او مالك'))

        @if($item->status === 'active')

                <div class="toggle-btn">
                    <a href="{{ route('admin.owner.inactive',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>

        @else
                <div class="toggle-btn">
                    <a href="{{ route('admin.owner.active',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>
        @endif
        @endif
    </td>

    <td>{{ $item->phone }}</td>

    <td>{{ $item->User->name }}</td>



    <td>
        @if(Auth::user()->can('تعديل مستاجر او مالك'))
<a href="{{ route('admin.edit.owner',$item->id) }}" class="btn" style="background-color:#489EB5;color:#FFF;">تعديل</a>
@endif

@if(Auth::user()->can('حذف مستاجر او مالك'))
<a href="{{ route('admin.delete.owner',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
@endif
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
