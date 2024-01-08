@extends('admin.admin_dashboard')

@section('admin')


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<div class="page-content">


    <div class="container">
        <div class="row gap-5">

            <div class="col-lg-5 page-content-update">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card radius-10 card1">
                          <div class="card-body">
                            <div class="icon-circle-3 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
                                    <path d="M20 18H22V20H0V18H2V1C2 0.44772 2.44772 0 3 0H19C19.5523 0 20 0.44772 20 1V18ZM18 18V2H4V18H18ZM7 9H10V11H7V9ZM7 5H10V7H7V5ZM7 13H10V15H7V13ZM12 13H15V15H12V13ZM12 9H15V11H12V9ZM12 5H15V7H12V5Z" fill="white"/>
                                </svg>
                              </div>
                            <div class="d-flex align-items-center mb-2">
                              <h5 class="mb-0 text-white">{{ $sellingContractPrice }}kwd</h5>
                            </div>

                            <div class="d-flex align-items-center text-white gap-3">
                              <p class="mb-0">إجمالي المبيعات</p>
                              <p class="mb-0 card-percentage">
                                {{ $sell_percentage }}%<span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M9.00007 10.4356L12.5947 14.0303L13.6554 12.9697L9.00007 8.31435L4.34473 12.9697L5.40538 14.0303L9.00007 10.4356ZM4.50006 5.25H13.5001V6.75H4.50006V5.25Z" fill="#09BC30"/>
                                    </svg></span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="col-lg-6">
                        <div class="card radius-10 card4">
                          <div class="card-body">
                            <div class="icon-circle-4 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12.0049 22.0029C6.48204 22.0029 2.00488 17.5258 2.00488 12.0029C2.00488 6.48008 6.48204 2.00293 12.0049 2.00293C17.5277 2.00293 22.0049 6.48008 22.0049 12.0029C22.0049 17.5258 17.5277 22.0029 12.0049 22.0029ZM12.0049 20.0029C16.4232 20.0029 20.0049 16.4212 20.0049 12.0029C20.0049 7.58465 16.4232 4.00293 12.0049 4.00293C7.5866 4.00293 4.00488 7.58465 4.00488 12.0029C4.00488 16.4212 7.5866 20.0029 12.0049 20.0029ZM9.00488 13.0029H8.00488V11.0029H9.00488V10.0029C9.00488 8.06993 10.5719 6.50293 12.5049 6.50293C13.9741 6.50293 15.2319 7.40823 15.7509 8.69143L13.7644 9.18804C13.4971 8.77572 13.0329 8.50293 12.5049 8.50293C11.6765 8.50293 11.0049 9.1745 11.0049 10.0029V11.0029H14.0049V13.0029H11.0049V15.0029H16.0049V17.0029H8.00488V15.0029H9.00488V13.0029Z" fill="white"/>
                                </svg>
                              </div>
                            <div class="d-flex align-items-center mb-2">
                              <h5 class="mb-0 text-white">{{ $total_num_buildings }}</h5>
                            </div>

                            <div class="d-flex align-items-center text-white gap-3">
                              <p class="mb-0">عدد العقارات</p>
                              <p class="mb-0 card-percentage">
                                {{ $building_percentage }}%<span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M9.00007 10.4356L12.5947 14.0303L13.6554 12.9697L9.00007 8.31435L4.34473 12.9697L5.40538 14.0303L9.00007 10.4356ZM4.50006 5.25H13.5001V6.75H4.50006V5.25Z" fill="#09BC30"/>
                                    </svg></span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>

                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card radius-10 card2">
                          <div class="card-body">
                            <div class=" icon-circle-1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <circle cx="20" cy="20" r="20" fill="#BF83FF"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22 16C22 18.2091 20.2091 20 18 20C15.7909 20 14 18.2091 14 16C14 13.7909 15.7909 12 18 12C20.2091 12 22 13.7909 22 16ZM18 21C14.134 21 11 23.2386 11 26C11 27.1046 11.8954 28 13 28H23C24.1046 28 25 27.1046 25 26C25 23.2386 21.866 21 18 21ZM26 14C26.5523 14 27 14.4477 27 15V16H28C28.5523 16 29 16.4477 29 17C29 17.5523 28.5523 18 28 18H27V19C27 19.5523 26.5523 20 26 20C25.4477 20 25 19.5523 25 19V18H24C23.4477 18 23 17.5523 23 17C23 16.4477 23.4477 16 24 16H25V15C25 14.4477 25.4477 14 26 14Z" fill="white"/>
                                </svg>
                              </div>



                              <div class="d-flex align-items-center mb-2">
                              <h5 class="mb-0 text-white">{{ $monthContractPrice }}kwd</h5>
                            </div>

                            <div class="d-flex align-items-center text-white gap-3">
                              <p class="mb-0">إجمالي الشهر</p>
                              <p class="mb-0 card-percentage">
                                {{ $month_percentage }}%<span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M9.00007 10.4356L12.5947 14.0303L13.6554 12.9697L9.00007 8.31435L4.34473 12.9697L5.40538 14.0303L9.00007 10.4356ZM4.50006 5.25H13.5001V6.75H4.50006V5.25Z" fill="#09BC30"/>
                                    </svg></span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="col-lg-6">
                        <div class="card radius-10 card3">
                          <div class="card-body">
                            <div class="icon-circle-2 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
                                    <circle cx="20.5" cy="20" r="20" fill="#3CD856"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.1261 13.2653L21.8263 13.7367C21.3222 13.8087 20.9103 14.049 20.6162 14.3811L12.9167 22.0806C12.1357 22.8616 12.1357 24.1279 12.9167 24.909L15.7452 27.7374C16.5263 28.5185 17.7925 28.5185 18.5736 27.7374L26.273 20.038C26.6051 19.7439 26.8454 19.332 26.9174 18.8279L27.3888 15.528C27.5775 14.2081 26.446 13.0767 25.1261 13.2653ZM22.8162 17.8379C23.2067 18.2284 23.8399 18.2285 24.2305 17.8379C24.621 17.4474 24.6209 16.8142 24.2305 16.4237C23.84 16.0332 23.2068 16.0332 22.8162 16.4237C22.4257 16.8142 22.4257 17.4474 22.8162 17.8379Z" fill="white"/>
                                </svg>
                              </div>
                            <div class="d-flex align-items-center mb-2">
                              <h5 class="mb-0 text-white">{{ $rentingContractPrice }}kwd</h5>
                            </div>

                            <div class="d-flex align-items-center text-white gap-3">
                              <p class="mb-0">إجمالي الايجارات</p>
                              <p class="mb-0 card-percentage">
                                {{ $rent_percentage }}%<span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M9.00007 10.4356L12.5947 14.0303L13.6554 12.9697L9.00007 8.31435L4.34473 12.9697L5.40538 14.0303L9.00007 10.4356ZM4.50006 5.25H13.5001V6.75H4.50006V5.25Z" fill="#09BC30"/>
                                    </svg></span>
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>

            <div class="col-lg-6 page-content-update">
                <div id="chart555"></div>
            </div>

        </div>
        <!--end row-->
     </div>
     <!-- end charts first row -->



     <div class="container mt-5">
        <div class="row gap-5">
              <div class="col-lg-5 page-content-update">
                  <h2 style="font-family:Cairo;font-size: 23px;font-style: normal;font-weight: 500;line-height: 120%;color:#1B1B1B);">إحصائيه الايجارات</h2>
                  <div id="chart222"></div>
              </div>

              <div class="col-lg-6 page-content-update">
                   <h2 style="font-family:Cairo;font-size: 23px;font-style: normal;font-weight: 500;line-height: 120%;color:#1B1B1B);">إحصائيه المبيعات</h2>
                   <div id="chart"></div>
              </div>
        </div>
     </div>




    <div class="d-flex" style="justify-content: space-between;">
        <h6 class="mb-2 mt-5 text-uppercase table-title">التقارير</h6>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.add.owner') }}" class="mb-2 mt-5 btn" style="border-radius: 4px;background: #57B0E2;color:#FFF;">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <path d="M9.6665 9.16699V4.16699H11.3332V9.16699H16.3332V10.8337H11.3332V15.8337H9.6665V10.8337H4.6665V9.16699H9.6665Z" fill="white"/>
            </svg>
                إضافه مستاجر
        </a>
        <a href="{{ route('admin.all.owner') }}" class="mb-2 mt-5 btn" style="border-radius: 4px;border: 1px solid #489EB5;color:#489EB5;">
                 جميع المستاجرين
        </a>
    </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
            <div class="exports d-flex mb-3" style="gap: 10px;">
                <a href="{{ route('export.building.pdf') }}" class="btn" style="border-radius: 4px;background: #57B0E2;color:#FFF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0.833496 12.0837C0.833496 10.1433 1.85374 8.44124 3.38705 7.48466C3.80407 4.20366 6.60588 1.66699 10.0002 1.66699C13.3944 1.66699 16.1962 4.20366 16.6132 7.48466C18.1466 8.44124 19.1668 10.1433 19.1668 12.0837C19.1668 14.935 16.9637 17.2717 14.1668 17.4846L5.8335 17.5003C3.03665 17.2717 0.833496 14.935 0.833496 12.0837ZM14.0404 15.8227C15.9849 15.6747 17.5002 14.0471 17.5002 12.0837C17.5002 10.7728 16.8238 9.58049 15.7311 8.89874L15.0597 8.47983L14.9599 7.69481C14.6447 5.21535 12.5242 3.33366 10.0002 3.33366C7.47613 3.33366 5.35555 5.21535 5.04041 7.69481L4.94063 8.47983L4.26923 8.89874C3.17646 9.58049 2.50016 10.7728 2.50016 12.0837C2.50016 14.0471 4.01544 15.6747 5.95991 15.8227L6.10433 15.8337H13.896L14.0404 15.8227ZM10.8335 10.8337V14.167H9.16683V10.8337H6.66683L10.0002 6.66699L13.3335 10.8337H10.8335Z" fill="white"/>
                        </svg>
                        تصدير
                </a>
                {{-- <a href="" class="btn btn-primary">Excel</a> --}}
            </div>
          <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr style="font-family: Cairo;font-size: 18px;font-style: normal;font-weight: 600;line-height: 120%;color:#1B1B1B;">
                <th>اسم العقار</th>
                <th>قيمه العقد</th>
                <th>تاريخ التحصيل</th>
                <th>العنوان</th>
                <th>صوره العقد</th>
                <th>الحاله</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($buildings as $key => $item)
              <tr>
                <td style="text-align: right;">
                  <img src="{{ asset($item->building_cover_img)}}" width="40" height="35">
                 {{ $item->building_title }}
                </td>
                <td>${{ $item->contract_price }}</td>
                <td>{{ $item->contract_date }}</td>
                <td>{{ $item->building_location }}</td>
                <td>
                    <a href="{{ asset($item->contract_img)}}" download="صوره العقد">
                        <img src="{{ asset('adminbackend/assets/images/new/contract-photo.png') }}" style="width: 31px; height:31px;">
                    </a>
                </td>
                <td>{{ $item->building_avilability_status === 'empty' ? 'خالي' : "غير خالي" }}</td>
                <td>
                    <div class="operations">
                         <a href="{{ route('show.building',$item->id) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                              <path d="M8.50028 2C12.095 2 15.0857 4.58651 15.7127 8C15.0857 11.4135 12.095 14 8.50028 14C4.9055 14 1.91485 11.4135 1.28784 8C1.91485 4.58651 4.9055 2 8.50028 2ZM8.50028 12.6667C11.324 12.6667 13.7403 10.7013 14.3519 8C13.7403 5.29869 11.324 3.33333 8.50028 3.33333C5.67648 3.33333 3.26023 5.29869 2.6486 8C3.26023 10.7013 5.67648 12.6667 8.50028 12.6667ZM8.50028 11C6.8434 11 5.50026 9.65687 5.50026 8C5.50026 6.34315 6.8434 5 8.50028 5C10.1571 5 11.5003 6.34315 11.5003 8C11.5003 9.65687 10.1571 11 8.50028 11ZM8.50028 9.66667C9.42075 9.66667 10.1669 8.92047 10.1669 8C10.1669 7.07953 9.42075 6.33333 8.50028 6.33333C7.57982 6.33333 6.83359 7.07953 6.83359 8C6.83359 8.92047 7.57982 9.66667 8.50028 9.66667Z" fill="#ACACAC"/>
                           </svg>
                         </a>

                            @if(Auth::user()->can('تعديل عقار'))
                                <a href="{{ route('edit.building',$item->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M4.77614 10.593L11.5375 3.83158L10.5947 2.88878L3.83333 9.65021V10.593H4.77614ZM5.32843 11.9263H2.5V9.09794L10.1233 1.47456C10.3837 1.21421 10.8058 1.21421 11.0661 1.47456L12.9518 3.36018C13.2121 3.62053 13.2121 4.04264 12.9518 4.30299L5.32843 11.9263ZM2.5 13.2597H14.5V14.593H2.5V13.2597Z" fill="#2D9CDB"/>
                                        </svg>
                                </a>
                            @endif


                            @if(Auth::user()->can('حذف عقار'))
                                <a href="{{ route('delete.building',$item->id) }}" id="delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M11.8335 3.99967H15.1668V5.33301H13.8335V13.9997C13.8335 14.3679 13.535 14.6663 13.1668 14.6663H3.8335C3.46531 14.6663 3.16683 14.3679 3.16683 13.9997V5.33301H1.8335V3.99967H5.16683V1.99967C5.16683 1.63149 5.46531 1.33301 5.8335 1.33301H11.1668C11.535 1.33301 11.8335 1.63149 11.8335 1.99967V3.99967ZM12.5002 5.33301H4.50016V13.333H12.5002V5.33301ZM6.50016 7.33301H7.8335V11.333H6.50016V7.33301ZM9.16683 7.33301H10.5002V11.333H9.16683V7.33301ZM6.50016 2.66634V3.99967H10.5002V2.66634H6.50016Z" fill="#F94144"/>
                                        </svg>
                                </a>
                            @endif

                    </div>
                </td>
              </tr>

              @endforeach







            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- table end  -->


  </div>





<script>
    var options = {
            series: [{
                name: 'series1',
                data: [31, 40, 68, 31, 92, 55, 100],
            }],
            chart: {
                foreColor: '#9ba7b2',
                height: 360,
                type: 'area',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: true
                },
            },
            colors: ["#F17800"],
            title: {
                text: 'Area Chart',
                align: 'left',
                style: {
                    fontSize: "16px",
                    color: '#666'
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            fill:{
                type:'solid',
                colors:['#FED64A']
            },
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>


<script>
	var options = {
          series: [{{ $sell_buildings }}, {{ $all_buildings }}, {{ $active_buildings }}, {{ $rent_buildings }}],
          chart: {
			  foreColor: '#9ba7b2',
          height: 350,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: '22px',
              },
              value: {
                fontSize: '16px',
              },
              total: {
                show: true,
                label: '',
                formatter: function (w) {
                  // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                //   return 249
                }
              }
            }
          }
        },
		colors: ["#165DFF", "#30C9C9", "#F7BA1E", "#66B949"],
        labels: ['العقارات المباعه', 'الكل', 'العقارات المفعله', 'العقارات المستاجره'],
            // Add this to set the title
        title:{
            text:'ملخص المبيعات',
            align:'center',
            style:{
                color:'#1B1B1B',
                fontSize:'23px',
                fontFamily:'Cairo',
                fontWeight:'500',
            }
         }
        };

        var chart = new ApexCharts(document.querySelector("#chart555"), options);
        chart.render();
</script>


<script>
        var options = {
        series: [{
            name: 'series1',
            data: [31, 40, 68, 31, 92, 55, 100]
        }],
        chart: {
            foreColor: '#9ba7b2',
            height: 360,
            type: 'area',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: true
            },
        },
        colors: ["#0d6efd", '#f41127'],
        title: {
            text: 'Area Chart',
            align: 'left',
            style: {
                fontSize: "16px",
                color: '#666'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };
    var chart = new ApexCharts(document.querySelector("#chart222"), options);
    chart.render();
</script>



@endsection
