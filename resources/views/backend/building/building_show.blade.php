@extends('admin.admin_dashboard')

@section('admin')



<div class="page-content">


    <!-- start buildings -->


        <div class="buildings-details">



                    <div class="buildings-details-cover">

                        <img src="{{ asset($buildings->building_cover_img) }}">

                        <div class="buildings-details-cover-info-card">
                          <div class="dotts-icon-buildings-details">
                            <div class="dotts-icon" role="group">
                              <button id="btnGroupDrop1" type="button" class="single-file-header-left-sec-button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="4" height="16" viewBox="0 0 4 16" fill="none">
                                    <path d="M2 0.5C1.3125 0.5 0.75 1.0625 0.75 1.75C0.75 2.4375 1.3125 3 2 3C2.6875 3 3.25 2.4375 3.25 1.75C3.25 1.0625 2.6875 0.5 2 0.5ZM2 13C1.3125 13 0.75 13.5625 0.75 14.25C0.75 14.9375 1.3125 15.5 2 15.5C2.6875 15.5 3.25 14.9375 3.25 14.25C3.25 13.5625 2.6875 13 2 13ZM2 6.75C1.3125 6.75 0.75 7.3125 0.75 8C0.75 8.6875 1.3125 9.25 2 9.25C2.6875 9.25 3.25 8.6875 3.25 8C3.25 7.3125 2.6875 6.75 2 6.75Z" fill="#707070"/>
                                  </svg>
                              </button>
                              {{-- <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#">حذف</a></li>
                                <li><a class="dropdown-item" href="#">تعديل</a></li>
                              </ul> --}}
                            </div>
                          </div>
                            <div class="card-info-content">
                              <img src="{{ asset($buildings->Owner->photo) }}">
                              <h3>{{ $buildings->Owner->name }}</h3>
                              {{-- <span>AGENT</span> --}}
                              <div class="d-flex justify-content-center gap-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none" style="margin-top:5px;">
                                    <path d="M3.96324 4.73123C4.5095 5.6918 5.3082 6.4905 6.26877 7.03673L6.78473 6.31439C6.95629 6.07429 7.2801 6.00009 7.5391 6.14155C8.35973 6.58984 9.26664 6.86226 10.2127 6.93716C10.5161 6.96119 10.75 7.21436 10.75 7.51868V10.122C10.75 10.4211 10.5238 10.6717 10.2263 10.7022C9.91717 10.734 9.60532 10.75 9.29167 10.75C4.29809 10.75 0.25 6.7019 0.25 1.70833C0.25 1.39466 0.265995 1.08283 0.297769 0.773693C0.328342 0.476187 0.578965 0.25 0.878046 0.25H3.48133C3.78564 0.25 4.03883 0.48394 4.06284 0.787302C4.13772 1.73335 4.41016 2.64029 4.85845 3.46092C4.99991 3.7199 4.92571 4.04373 4.68561 4.21525L3.96324 4.73123ZM2.49248 4.34803L3.60078 3.55639C3.28652 2.878 3.07116 2.15857 2.96091 1.41667H1.42196C1.41843 1.51369 1.41667 1.61092 1.41667 1.70833C1.41667 6.05755 4.94245 9.58333 9.29167 9.58333C9.38908 9.58333 9.48632 9.58158 9.58333 9.57802V8.03907C8.84145 7.92882 8.12202 7.71346 7.44361 7.39922L6.65197 8.50755C6.33172 8.38312 6.02243 8.23671 5.72598 8.07022L5.69209 8.05092C4.54899 7.40091 3.59911 6.45101 2.94908 5.30791L2.9298 5.27402C2.76329 4.97757 2.6169 4.66828 2.49248 4.34803Z" fill="black"/>
                                    </svg>
                                <p>{{ $buildings->Owner->phone }}</p>
                              </div>

                                @if($buildings->Owner->owner_building_num > 0)
                                    <p class="wealth-count">{{ $buildings->Owner->owner_building_num }} عقار</p>
                                @endif
                            </div>
                        </div>


                    </div>

                    <div class="buildings-details-title">
                        <p>{{ $buildings->building_title}}</p>
                    </div>

                    <div class="buildings-details-location-price">
                        <div class="buildings-details-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M9.99963 17.4161L14.1244 13.2913C16.4025 11.0133 16.4025 7.31977 14.1244 5.04171C11.8464 2.76365 8.1529 2.76365 5.87484 5.04171C3.59678 7.31977 3.59678 11.0133 5.87484 13.2913L9.99963 17.4161ZM9.99963 19.7731L4.69633 14.4698C1.7674 11.5408 1.7674 6.79214 4.69633 3.8632C7.62527 0.934271 12.374 0.934271 15.303 3.8632C18.2319 6.79214 18.2319 11.5408 15.303 14.4698L9.99963 19.7731ZM9.99963 10.8332C10.9201 10.8332 11.6663 10.087 11.6663 9.1665C11.6663 8.24603 10.9201 7.49984 9.99963 7.49984C9.07913 7.49984 8.33297 8.24603 8.33297 9.1665C8.33297 10.087 9.07913 10.8332 9.99963 10.8332ZM9.99963 12.4998C8.15868 12.4998 6.6663 11.0074 6.6663 9.1665C6.6663 7.32555 8.15868 5.83317 9.99963 5.83317C11.8406 5.83317 13.333 7.32555 13.333 9.1665C13.333 11.0074 11.8406 12.4998 9.99963 12.4998Z" fill="#1B1B1B"/>
                            </svg>
                            <p> {{ $buildings->building_location}} </p>
                        </div>
                        <div class="buildings-details-price">
                            <p>السعر: <span>${{ $buildings->building_price}}</span></p>
                        </div>
                    </div>

                    <div class="buildings-details-features">
                        <h3>المميزات</h3>
                        <div class="buildings-details-features-icons">
                             <div class="icon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                       <path d="M22.0001 11.0004V20.0004H20.0001V17.0004H4.00012V20.0004H2.00012V4.00037H4.00012V14.0004H12.0001V7.00037H18.0001C20.2092 7.00037 22.0001 8.79123 22.0001 11.0004ZM20.0001 14.0004V11.0004C20.0001 9.8958 19.1047 9.00037 18.0001 9.00037H14.0001V14.0004H20.0001ZM8.00012 11.0004C8.5524 11.0004 9.00012 10.5527 9.00012 10.0004C9.00012 9.44809 8.5524 9.00037 8.00012 9.00037C7.44784 9.00037 7.00012 9.44809 7.00012 10.0004C7.00012 10.5527 7.44784 11.0004 8.00012 11.0004ZM8.00012 13.0004C6.34327 13.0004 5.00012 11.6573 5.00012 10.0004C5.00012 8.34352 6.34327 7.00037 8.00012 7.00037C9.65697 7.00037 11.0001 8.34352 11.0001 10.0004C11.0001 11.6573 9.65697 13.0004 8.00012 13.0004Z" fill="#489EB5"/>
                                    </svg>
                                    <p>{{ $buildings->rooms_num}} غرف</p>
                             </div>
                             <div class="icon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <g clip-path="url(#clip0_368_3284)">
                                    <path d="M11.0001 15.9345C7.33076 15.4456 4.50012 12.3037 4.50012 8.50061C4.50012 4.35847 7.85798 1.00061 12.0001 1.00061C16.1422 1.00061 19.5001 4.35847 19.5001 8.50061C19.5001 12.3037 16.6695 15.4456 13.0001 15.9345V18.0006H18.0001V20.0006H13.0001V24.0006H11.0001V20.0006H6.00012V18.0006H11.0001V15.9345ZM12.0001 14.0006C15.0377 14.0006 17.5001 11.5382 17.5001 8.50061C17.5001 5.46304 15.0377 3.00061 12.0001 3.00061C8.96255 3.00061 6.50012 5.46304 6.50012 8.50061C6.50012 11.5382 8.96255 14.0006 12.0001 14.0006Z" fill="#489EB5"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_368_3284">
                                    <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                    </defs>
                                    </svg>
                                    <p>{{ $buildings->bathroom_num}} حمام</p>
                             </div>
                             <div class="icon3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M17.9999 10.9984V7.99841L21.9999 11.9984L17.9999 15.9984V12.9984H12.9999V17.9984H15.9999L11.9999 21.9984L7.99988 17.9984H10.9999V12.9984H5.99988V15.9984L1.99988 11.9984L5.99988 7.99841V10.9984H10.9999V5.99841H7.99988L11.9999 1.99841L15.9999 5.99841H12.9999V10.9984H17.9999Z" fill="#489EB5"/>
                                  </svg>
                                  <p>{{ $buildings->building_size}} متر</p>
                             </div>

                             {{-- <div class="icon4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M18.998 1C19.5503 1 19.998 1.44772 19.998 2V22C19.998 22.5523 19.5503 23 18.998 23H4.99805C4.44576 23 3.99805 22.5523 3.99805 22V2C3.99805 1.44772 4.44576 1 4.99805 1H18.998ZM17.998 12H5.99805V21H17.998V12ZM9.99805 14V18H7.99805V14H9.99805ZM17.998 3H5.99805V10H17.998V3ZM9.99805 5V8H7.99805V5H9.99805Z" fill="#489EB5"/>
                                    </svg>
                                    <p>مطبخ</p>
                             </div> --}}

                             @if($buildings->wifi_status === 'yes')
                                <div class="icon5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M0.689453 6.99659C3.78027 4.49704 7.71526 3 11.9999 3C16.2845 3 20.2195 4.49704 23.3104 6.99659L22.0536 8.55252C19.3062 6.3307 15.8085 5 11.9999 5C8.19133 5 4.69356 6.3307 1.94617 8.55252L0.689453 6.99659ZM3.83124 10.8864C6.0635 9.08119 8.90544 8 11.9999 8C15.0944 8 17.9363 9.08119 20.1686 10.8864L18.9118 12.4424C17.023 10.9149 14.6183 10 11.9999 10C9.38151 10 6.97679 10.9149 5.08796 12.4424L3.83124 10.8864ZM6.97304 14.7763C8.34673 13.6653 10.0956 13 11.9999 13C13.9042 13 15.6531 13.6653 17.0268 14.7763L15.7701 16.3322C14.7398 15.499 13.4281 15 11.9999 15C10.5717 15 9.26002 15.499 8.22975 16.3322L6.97304 14.7763ZM10.1148 18.6661C10.63 18.2495 11.2858 18 11.9999 18C12.714 18 13.3698 18.2495 13.885 18.6661L11.9999 21L10.1148 18.6661Z" fill="#489EB5"/>
                                    </svg>
                                    <p>wifi</p>
                                </div>
                             @endif

                             @if($buildings->parking_status === 'yes')
                                <div class="icon6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM5 5V19H19V5H5ZM9 7H12.5C14.433 7 16 8.567 16 10.5C16 12.433 14.433 14 12.5 14H11V17H9V7ZM11 9V12H12.5C13.3284 12 14 11.3284 14 10.5C14 9.67157 13.3284 9 12.5 9H11Z" fill="#489EB5"/>
                                    </svg>
                                    <p>موقف سيارات</p>
                                </div>
                             @endif

                        </div>
                    </div>

                    <div class="buildings-details-description">
                          <h3>الوصف</h3>
                          <p>{!! $buildings->building_desc !!}</p>
                    </div>

                    <div class="buildings-details-photos">
                          <h3>جميع الصور</h3>
                          <div class="buildings-details-photos-all">

                                <div class="row">
                                    @foreach($multiImgs as $key => $img)
                                        <div class="col-lg-4">
                                            <img src="{{ asset($img->photo_name) }}">
                                        </div>
                                    @endforeach
                                </div>

                          </div>
                    </div>


                    <div class="buildings-details-photos">
                        <h3>جميع الفيديوهات</h3>
                        <div class="buildings-details-photos-all">

                              <div class="row">
                                  @foreach($multiVideos as $key => $video)
                                      <div class="col-lg-4">
                                          <video src="{{ asset($video->video_name) }}" controls width="300"></video>
                                      </div>
                                  @endforeach
                              </div>

                        </div>
                  </div>



                  <div class="buildings-details-photos">
                    <h3> أرشيف العقار</h3>
                    <div class="buildings-details-photos-all">

                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
            <tr>
                <th>رقم التسلسل</th>
                <th>اسم المستاجر </th>
                <th>تاريخ التعاقد </th>
                <th>قيمه التعاقد </th>
                <th>مده التعاقد </th>
                <th>صوره العقد </th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($histories as $key => $item)
            <tr>
                <td> {{ $key + 1 }} </td>
                <td> {{ $item->Owner->name }} </td>
                <td>{{ $item->contract_date}}</td>
                <td>{{ $item->contract_price}}</td>
                <td>{{ $item->contract_long}}</td>
                <td>
                    <a href="{{ asset($item->contract_img)}}" download="صوره العقد">
                        <img src="{{ asset($item->contract_img)}}" style="width: 100px; height:50px;">
                    </a>
                </td>
                <td>
            <a href="{{ route('building.history.delete',$item->id) }}" class="btn btn-danger" id="delete">حذف</a>
                </td>
            </tr>
            @endforeach


            </tbody>
            </table>
                        </div>

                    </div>
              </div>



        </div>


    <!--end buildings-->









  </div>



@endsection
