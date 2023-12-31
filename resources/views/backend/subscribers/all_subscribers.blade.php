@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3" style="border-left:none;">كل المشتركين</div>

        <div class="ms-auto">
            <div class="btn-group">
                @if(Auth::user()->can('اضافه مشترك'))
           <a href="{{ route('admin.add.subscriber') }}" class="btn btn-primary">إضافه مشترك</a>
           @endif


            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="exports d-flex mb-3" style="gap: 10px;">
                    <a href="{{ route('export.subscribers.pdf') }}" class="btn btn-info">PDF</a>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
<tr>
    <th>رقم التسلسل</th>
    <th>اسم المشترك</th>
    <th>نهايه الاشتراك</th>
    <th>الحاله</th>
    <th>العمليات</th>
</tr>
</thead>
<tbody>
@foreach($subscribers as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->subscribe_time }}</td>

    {{-- @if($item->status == 1)
    <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
    @else
    <a href="{{ route('product.active',$item->id) }}" class="btn btn-primary" title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
    @endif --}}
    <td>

        @if(Auth::user()->can('تغيير حاله المشترك'))


        @if($item->status === 'active')

                <div class="toggle-btn">
                    <a href="{{ route('subscriber.inactive',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>

        @else
                <div class="toggle-btn">
                    <a href="{{ route('subscriber.active',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>
        @endif

        @endif

    </td>



    <td>

        @if(Auth::user()->can('تعديل مشترك'))
<a href="{{ route('admin.edit.subscriber',$item->id) }}" class="btn btn-info">تعديل</a>
@endif

@if(Auth::user()->can('حذف مشترك'))
<a href="{{ route('admin.delete.subscriber',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
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
