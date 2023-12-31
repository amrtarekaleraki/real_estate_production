@extends('subscriber.subscriber_dashboard')

@section('subscriber')


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3" style="border-left:none;">كل المستأجرين و الملاك</div>

        <div class="ms-auto">
            <div class="btn-group">
           <a href="{{ route('subscriber.add.owner') }}" class="btn btn-primary">إضافه مستأجر او مالك</a>


            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="exports d-flex mb-3" style="gap: 10px;">
                    <a href="{{ route('export.subscribers.owners.pdf') }}" class="btn btn-info">PDF</a>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
<tr>
    <th>رقم التسلسل</th>
    <th>اسم المستأجر او المالك</th>
    <th>النوع</th>
    <th>الحاله</th>
    <th>العمليات</th>
</tr>
</thead>
<tbody>
@foreach($owners as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->role === "tenant" ? 'مستأجر' : 'مالك' }}</td>
    <td>
        @if($item->status === 'active')

                <div class="toggle-btn">
                    <a href="{{ route('subscriber.owner.inactive',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>

        @else
                <div class="toggle-btn">
                    <a href="{{ route('subscriber.owner.active',$item->id) }}" id="toggle_{{ $item->id }}" class="checkbox {{ $item->status === 'active' ? 'checked' : '' }}">
                        <span class="label">
                            <div class="ball"></div>
                        </span>
                    </a>
                </div>
        @endif
    </td>



    <td>
<a href="{{ route('subscriber.edit.owner',$item->id) }}" class="btn btn-info">تعديل</a>
<a href="{{ route('subscriber.delete.owner',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
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
