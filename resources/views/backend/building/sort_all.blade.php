@extends('admin.admin_dashboard')

@section('admin')



<div class="page-content">


    <!-- start buildings -->
     <div class="container">
        <div class="buildings">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">

                                <div class="col-lg-9 col-xl-10">
                                    <form class="float-lg-end">
                                        <div class="row row-cols-lg-auto g-2 gap-5">
                                            <div class="col-12">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    {{-- <button type="button" class="btn btn-white">القسم</button> --}}
                                                    <button id="selected-category-button" type="button" class="btn btn-white">
                                                        {{ $chosenCategory ?? 'القسم' }}
                                                    </button>
                                                    <div class="btn-group" role="group">
                                                      <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class='bx bx-chevron-down'></i>
                                                      </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            @php
                                                                $categories = App\Models\Category::latest()->get();
                                                            @endphp
                                                            <li><a class="dropdown-item" style="text-align: right;" href="{{ route('all.building') }}">الكل</a></li>
                                                            {{-- @foreach ($categories as $item)
                                                            <li><a class="dropdown-item" style="text-align: right;" href="{{ route('all.sort',$item->id) }}">{{ $item->category_name }}</a></li>
                                                            @endforeach --}}
                                                            @foreach ($categories as $item)
                                                                <li>
                                                                    <a
                                                                        class="dropdown-item category-item"
                                                                        style="text-align: right;"
                                                                        href="{{ route('all.sort',$item->id) }}"
                                                                        data-category-name="{{ $item->category_name }}"
                                                                    >
                                                                        {{ $item->category_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <button type="button" class="btn btn-white">النوع</button>
                                                    <div class="btn-group" role="group">
                                                      <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class='bx bx-chevron-down'></i>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <li><a class="dropdown-item" style="text-align: right;" href="{{ route('all.building') }}">الكل</a></li>
                                                        <li><a class="dropdown-item"  style="text-align: right;" href="{{ route('sort.rent') }}">إيجار</a></li>
                                                        <li><a class="dropdown-item"  style="text-align: right;" href="{{ route('sort.buy') }}">بيع</a></li>
                                                      </ul>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-3 col-xl-2">
                                    @if(Auth::user()->can('اضافه عقار'))
                                       <a href="{{ route('add.building') }}" class="btn btn-primary mb-3 mb-lg-0 building-add-button">إضافه عقار</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3">

                @if ($buildings->count() > 0)


            @foreach($buildings as $key => $item)
                <div class="col-lg-4">
                    <div class="building">
                        <div class="building-img">
                            <img src="{{ asset($item->building_cover_img) }}" alt="">
                        </div>
                        <div class="building-info">
                            <h2>{{ $item->building_title}}</h2>
                            <span>{{ $item->building_price }}$</span>
                        </div>
                        <div class="building-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <g clip-path="url(#clip0_368_2842)">
                                <path d="M7.96326 12.3844L10.8506 9.49707C12.4452 7.90247 12.4452 5.31703 10.8506 3.72239C9.25598 2.12775 6.67054 2.12775 5.0759 3.72239C3.48126 5.31703 3.48126 7.90247 5.0759 9.49707L7.96326 12.3844ZM7.96326 14.0343L4.25095 10.3221C2.20069 8.27177 2.20069 4.94768 4.25095 2.89743C6.3012 0.847178 9.62529 0.847178 11.6756 2.89743C13.7258 4.94768 13.7258 8.27177 11.6756 10.3221L7.96326 14.0343ZM7.96326 7.77641C8.60761 7.77641 9.12992 7.25409 9.12992 6.60974C9.12992 5.96541 8.60761 5.44307 7.96326 5.44307C7.31891 5.44307 6.79659 5.96541 6.79659 6.60974C6.79659 7.25409 7.31891 7.77641 7.96326 7.77641ZM7.96326 8.94307C6.67459 8.94307 5.62992 7.89838 5.62992 6.60974C5.62992 5.32108 6.67459 4.27641 7.96326 4.27641C9.2519 4.27641 10.2966 5.32108 10.2966 6.60974C10.2966 7.89838 9.2519 8.94307 7.96326 8.94307Z" fill="#ACACAC"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_368_2842">
                                <rect width="14" height="14" fill="white" transform="translate(0.963501 0.193237)"/>
                                </clipPath>
                                </defs>
                                </svg>
                            <p>{{ $item->building_location }}</p>
                        </div>
                        <div class="building-details">
                            <div class="building-icon-details">

                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path d="M13.7969 6.61007V11.8601H12.6302V10.1101H3.29692V11.8601H2.13025V2.52673H3.29692V8.36007H7.96358V4.27673H11.4636C12.7522 4.27673 13.7969 5.3214 13.7969 6.61007ZM12.6302 8.36007V6.61007C12.6302 5.96573 12.1079 5.4434 11.4636 5.4434H9.13025V8.36007H12.6302ZM5.63025 6.61007C5.95241 6.61007 6.21358 6.34891 6.21358 6.02673C6.21358 5.70457 5.95241 5.4434 5.63025 5.4434C5.30809 5.4434 5.04692 5.70457 5.04692 6.02673C5.04692 6.34891 5.30809 6.61007 5.63025 6.61007ZM5.63025 7.77673C4.66375 7.77673 3.88025 6.99326 3.88025 6.02673C3.88025 5.06024 4.66375 4.27673 5.63025 4.27673C6.59675 4.27673 7.38025 5.06024 7.38025 6.02673C7.38025 6.99326 6.59675 7.77673 5.63025 7.77673Z" fill="#2D9CDB" fill-opacity="0.4"/>
                                </svg>{{ $item->rooms_num }}

                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <g clip-path="url(#clip0_368_2859)">
                                        <path d="M7.38029 9.4883C5.23983 9.20311 3.58862 7.37033 3.58862 5.15186C3.58862 2.73561 5.54737 0.776855 7.96362 0.776855C10.3798 0.776855 12.3386 2.73561 12.3386 5.15186C12.3386 7.37033 10.6874 9.20311 8.54696 9.4883V10.6935H11.4636V11.8602H8.54696V14.1935H7.38029V11.8602H4.46362V10.6935H7.38029V9.4883ZM7.96362 8.36019C9.73556 8.36019 11.172 6.92379 11.172 5.15186C11.172 3.37994 9.73556 1.94352 7.96362 1.94352C6.19171 1.94352 4.75529 3.37994 4.75529 5.15186C4.75529 6.92379 6.19171 8.36019 7.96362 8.36019Z" fill="#2D9CDB" fill-opacity="0.4"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_368_2859">
                                        <rect width="14" height="14" fill="white" transform="translate(0.963501 0.193237)"/>
                                        </clipPath>
                                        </defs>
                                        </svg> {{ $item->bathroom_num }}

                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                            <path d="M11.4635 6.60901V4.85901L13.7968 7.19234L11.4635 9.52568V7.77568H8.54679V10.6923H10.2968L7.96346 13.0257L5.63013 10.6923H7.38013V7.77568H4.46346V9.52568L2.13013 7.19234L4.46346 4.85901V6.60901H7.38013V3.69234H5.63013L7.96346 1.35901L10.2968 3.69234H8.54679V6.60901H11.4635Z" fill="#2D9CDB" fill-opacity="0.4"/>
                                            </svg> {{ $item->building_size }}

                            </div>
                            <div class="building-icon-operations">

                                   <a href="{{ route('show.building',$item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                        <g clip-path="url(#clip0_368_2850)">
                                        <path d="M8.96366 2.19324C12.5584 2.19324 15.5491 4.77974 16.1761 8.19324C15.5491 11.6067 12.5584 14.1932 8.96366 14.1932C5.36887 14.1932 2.37823 11.6067 1.75122 8.19324C2.37823 4.77974 5.36887 2.19324 8.96366 2.19324ZM8.96366 12.8599C11.7874 12.8599 14.2037 10.8946 14.8153 8.19324C14.2037 5.49192 11.7874 3.52657 8.96366 3.52657C6.13986 3.52657 3.72361 5.49192 3.11198 8.19324C3.72361 10.8946 6.13986 12.8599 8.96366 12.8599ZM8.96366 11.1932C7.30678 11.1932 5.96363 9.8501 5.96363 8.19324C5.96363 6.53638 7.30678 5.19324 8.96366 5.19324C10.6205 5.19324 11.9637 6.53638 11.9637 8.19324C11.9637 9.8501 10.6205 11.1932 8.96366 11.1932ZM8.96366 9.8599C9.88413 9.8599 10.6303 9.1137 10.6303 8.19324C10.6303 7.27277 9.88413 6.52657 8.96366 6.52657C8.04319 6.52657 7.29697 7.27277 7.29697 8.19324C7.29697 9.1137 8.04319 9.8599 8.96366 9.8599Z" fill="#ACACAC"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_368_2850">
                                        <rect width="16" height="16" fill="white" transform="translate(0.963501 0.193237)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                   </a>

                                   @if(Auth::user()->can('تعديل عقار'))
                                    <a href="{{ route('edit.building',$item->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                            <path d="M5.23964 10.7866L12.001 4.02519L11.0582 3.08238L4.29683 9.84381V10.7866H5.23964ZM5.79193 12.1199H2.9635V9.29155L10.5868 1.66817C10.8472 1.40781 11.2693 1.40781 11.5296 1.66817L13.4153 3.55378C13.6756 3.81413 13.6756 4.23624 13.4153 4.49659L5.79193 12.1199ZM2.9635 13.4533H14.9635V14.7866H2.9635V13.4533Z" fill="#2D9CDB"/>
                                            </svg>
                                    </a>
                                    @endif


                                    @if(Auth::user()->can('حذف عقار'))
                                    <a href="{{ route('delete.building',$item->id) }}" id="delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                            <path d="M12.2969 4.19328H15.6302V5.52661H14.2969V14.1933C14.2969 14.5615 13.9984 14.8599 13.6302 14.8599H4.29687C3.92869 14.8599 3.63021 14.5615 3.63021 14.1933V5.52661H2.29688V4.19328H5.63021V2.19328C5.63021 1.82509 5.92869 1.52661 6.29687 1.52661H11.6302C11.9984 1.52661 12.2969 1.82509 12.2969 2.19328V4.19328ZM12.9635 5.52661H4.96354V13.5266H12.9635V5.52661ZM6.96354 7.52661H8.29687V11.5266H6.96354V7.52661ZM9.63021 7.52661H10.9635V11.5266H9.63021V7.52661ZM6.96354 2.85994V4.19328H10.9635V2.85994H6.96354Z" fill="#F94144"/>
                                            </svg>
                                    </a>
                                    @endif
                            </div>
                        </div>

                    </div>
                </div>

            @endforeach

            @else
            <div class="col-lg-4">
                    <h2>لا يوجد بيانات في هذا القسم</h2>
            </div>

            @endif



            </div>
        </div>
     </div>

    <!--end buildings-->



  </div>


@endsection
