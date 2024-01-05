@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">

    <div class="all-files">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">الاقسام</div>

        <div class="ms-auto">
            <div class="btn-group">
           {{-- <a href="{{ route('add.category') }}" class="btn btn-primary">إضافه قسم</a> --}}


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
    <th>اسم القسم</th>
    {{-- <th>العمليات</th> --}}
</tr>
</thead>
<tbody>
@foreach($categories as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->category_name }}</td>
    {{-- <td>
<a href="{{ route('edit.category',$item->id) }}" class="btn btn-info">تعديل</a>
<a href="{{ route('delete.category',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
    </td> --}}
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
