@extends('subscriber.subscriber_dashboard')

@section('subscriber')


<div class="page-content">

    <div class="all-files">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 p-2">
        <div class="breadcrumb-title pe-3" style="border-left:none; font-family: Cairo;font-size: 23px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">الاعدادات</div>

        <div class="ms-auto">
            <div class="btn-group">
            @if ($settings->count() > 0)
            @else
               <a href="{{ route('subscriber.add.settings') }}" class="btn btn-primary">إضافه الاعدادات</a>
            @endif

            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if (isset($settings))
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>اسم الشركه</th>
                            <th>العنوان</th>
                            <th>الايميل</th>
                            <th>رقم الهاتف</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $key => $item)
                                <tr style="vertical-align: middle;">
                                    <td>{{ $item->name }}</td>
                                    {{-- <td><a href="{{ $item->location }}" style="color: #1B1B1B;">{{ $item->location }}</a></td> --}}
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>

                                    <td>
                                    <a href="{{ route('subscriber.edit.settings',$item->id) }}" class="btn" style="background-color:#489EB5;color:#FFF;">تعديل</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>



</div>

</div>



@endsection
