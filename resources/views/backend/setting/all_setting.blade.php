@extends('admin.admin_dashboard')


@section('admin')


<div class="page-content">

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-striped table-bordered" style="width:100%">
                    <thead>
<tr>
    <th>رقم التسلسل</th>
    <th>اسم الشركه</th>
    <th>الموقع</th>
    <th>البريد الالكتروني</th>
    <th>الهاتف</th>
    <th>لوجو</th>
    <th>فايف ايقون</th>
    <th>العمليات</th>
</tr>
</thead>
<tbody>
@foreach($settings as $key => $item)
<tr>
    <td> {{ $key+1 }} </td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->location }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->phone }}</td>
    <td>
        <img src="{{ asset($item->logo) }}" alt="logo" width="60" height="60">
    </td>
    <td>
        <img src="{{ asset($item->favicon) }}" alt="favicon" width="60" height="60">
    </td>
    <td><a href="{{ route('edit.settings',$item->id) }}" class="btn" style="background-color:#489EB5;color:#FFF;">تعديل</a></td>
</tr>
@endforeach


</tbody>
</table>
            </div>
        </div>
    </div>



</div>

@endsection





