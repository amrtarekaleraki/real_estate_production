@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">

    <div class="all-files">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;"> المشتركين</div>

        <div class="ms-auto">
            <div class="btn-group">
                @if(Auth::user()->can('اضافه مشترك'))
           <a href="{{ route('admin.add.subscriber') }}" class="btn btn-primary">إضافه مشترك</a>
           @endif


            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="exports d-flex mb-3" style="gap: 10px;">
                    {{-- <a href="{{ route('export.subscribers.pdf') }}" class="btn btn-info">تصدير</a> --}}
                    <a href="{{ route('export.subscribers.pdf') }}" class="btn" style="border-radius: 4px;background: #57B0E2;color:#FFF;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M0.833496 12.0837C0.833496 10.1433 1.85374 8.44124 3.38705 7.48466C3.80407 4.20366 6.60588 1.66699 10.0002 1.66699C13.3944 1.66699 16.1962 4.20366 16.6132 7.48466C18.1466 8.44124 19.1668 10.1433 19.1668 12.0837C19.1668 14.935 16.9637 17.2717 14.1668 17.4846L5.8335 17.5003C3.03665 17.2717 0.833496 14.935 0.833496 12.0837ZM14.0404 15.8227C15.9849 15.6747 17.5002 14.0471 17.5002 12.0837C17.5002 10.7728 16.8238 9.58049 15.7311 8.89874L15.0597 8.47983L14.9599 7.69481C14.6447 5.21535 12.5242 3.33366 10.0002 3.33366C7.47613 3.33366 5.35555 5.21535 5.04041 7.69481L4.94063 8.47983L4.26923 8.89874C3.17646 9.58049 2.50016 10.7728 2.50016 12.0837C2.50016 14.0471 4.01544 15.6747 5.95991 15.8227L6.10433 15.8337H13.896L14.0404 15.8227ZM10.8335 10.8337V14.167H9.16683V10.8337H6.66683L10.0002 6.66699L13.3335 10.8337H10.8335Z" fill="white"/>
                            </svg>
                            تصدير
                    </a>
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
<a href="{{ route('admin.edit.subscriber',$item->id) }}" class="btn" style="background-color:#489EB5;color:#FFF;">تعديل</a>
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
