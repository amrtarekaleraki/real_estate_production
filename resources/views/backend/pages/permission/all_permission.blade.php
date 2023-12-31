@extends('admin.admin_dashboard')
@section('admin')



<div class="page-content">

    <!-- start permisions -->

     <div class="container">

        <div class="all-files">

            <div class="row p-3">


                <div class="col-lg-12">
                    <div class="all-files-title">
                        <h2>الصلاحيات</h2>
                        <div class="all-files-title-button">
                            <a href="{{ route('add.permission') }}" class="mb-3 mb-lg-0 building-add-button">إضافه صلاحيه</a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <table class="table mb-0">
                        <thead class="table-background-th">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">المجموعه</th>
                                <th scope="col">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($permissions as $key => $item)
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->group_name }}</td>

                                    <td>
                                        <a href="{{ route('edit.permission',$item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="M4.27614 10.593L11.0375 3.83158L10.0947 2.88878L3.33333 9.65021V10.593H4.27614ZM4.82843 11.9263H2V9.09794L9.62333 1.47456C9.88373 1.21421 10.3058 1.21421 10.5661 1.47456L12.4518 3.36018C12.7121 3.62053 12.7121 4.04264 12.4518 4.30299L4.82843 11.9263ZM2 13.2597H14V14.593H2V13.2597Z" fill="#2D9CDB"/>
                                              </svg>
                                        </a>
                                        <a href="{{ route('delete.permission',$item->id) }}" id="delete" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <path d="M11.3335 3.99967H14.6668V5.33301H13.3335V13.9997C13.3335 14.3679 13.035 14.6663 12.6668 14.6663H3.3335C2.96531 14.6663 2.66683 14.3679 2.66683 13.9997V5.33301H1.3335V3.99967H4.66683V1.99967C4.66683 1.63149 4.96531 1.33301 5.3335 1.33301H10.6668C11.035 1.33301 11.3335 1.63149 11.3335 1.99967V3.99967ZM12.0002 5.33301H4.00016V13.333H12.0002V5.33301ZM6.00016 7.33301H7.3335V11.333H6.00016V7.33301ZM8.66683 7.33301H10.0002V11.333H8.66683V7.33301ZM6.00016 2.66634V3.99967H10.0002V2.66634H6.00016Z" fill="#F94144"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
			                @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>


     </div>

    <!--end permissions-->









  </div>



@endsection
