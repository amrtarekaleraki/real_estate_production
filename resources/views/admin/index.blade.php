@extends('admin.admin_dashboard')

@section('admin')


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<style>
    .chart-bar-design
    {
        background:#FFF;
        box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.08);
        height: 100%;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="page-content">

    @if(Auth::user()->can('اجمالي التقارير'))
    {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 page-content-update"> --}}
    <div class="row page-content-update">

      <div class="col">
        <div class="card radius-10 card2">
          <div class="card-body">
            <div class=" icon-circle-1 mb-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M12 3V5H3V3H12ZM16 19V21H3V19H16ZM22 11V13H3V11H22Z"
                    fill="white"
                  />
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


      <div class="col">
        <div class="card radius-10 card3">
          <div class="card-body">
            <div class="icon-circle-2 mb-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M21.5 20H23.5V22H1.5V20H3.5V3C3.5 2.44772 3.94772 2 4.5 2H20.5C21.0523 2 21.5 2.44772 21.5 3V20ZM19.5 20V4H5.5V20H19.5ZM8.5 11H11.5V13H8.5V11ZM8.5 7H11.5V9H8.5V7ZM8.5 15H11.5V17H8.5V15ZM13.5 15H16.5V17H13.5V15ZM13.5 11H16.5V13H13.5V11ZM13.5 7H16.5V9H13.5V7Z"
                    fill="white"
                  />
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

      <div class="col">
        <div class="card radius-10 card1">
          <div class="card-body">
            <div class="icon-circle-3 mb-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="25"
                  height="24"
                  viewBox="0 0 25 24"
                  fill="none"
                >
                  <path
                    d="M5.5 3V19H21.5V21H3.5V3H5.5ZM20.7929 6.29289L22.2071 7.70711L16.5 13.4142L13.5 10.415L9.20711 14.7071L7.79289 13.2929L13.5 7.58579L16.5 10.585L20.7929 6.29289Z"
                    fill="white"
                  />
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


    </div>
    @endif

    <!--end row-->

    <!-- ///////////////// start switcher//////////////// -->


    {{-- <div class="col">
      <div class="switcher-parent">
        @php
            $categories = App\Models\Category::latest()->get();
        @endphp

        @foreach ($categories as $item)
            <a  href="#!"><p>{{ $item->category_name }}</p></a>
        @endforeach

        <a class="active" href="#!"><p>سكني</p></a>
        <a href="#!"><p>تجاري</p></a>
        <a href="#!"><p>أراضي</p></a>
        <a href="#!"><p>إستثماري</p></a>
      </div>
 </div> --}}

 <!-- ////////////// end switcher///////////////// -->

    <h6 class="mb-2 mt-5 text-uppercase table-title">جدول العقارات</h6>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
            <div class="exports d-flex mb-3" style="gap: 10px;">
                <a href="{{ route('export.building.pdf') }}" class="btn" style="border-radius: 4px;background: #57B0E2;color:#FFF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0.833496 12.0837C0.833496 10.1433 1.85374 8.44124 3.38705 7.48466C3.80407 4.20366 6.60588 1.66699 10.0002 1.66699C13.3944 1.66699 16.1962 4.20366 16.6132 7.48466C18.1466 8.44124 19.1668 10.1433 19.1668 12.0837C19.1668 14.935 16.9637 17.2717 14.1668 17.4846L5.8335 17.5003C3.03665 17.2717 0.833496 14.935 0.833496 12.0837ZM14.0404 15.8227C15.9849 15.6747 17.5002 14.0471 17.5002 12.0837C17.5002 10.7728 16.8238 9.58049 15.7311 8.89874L15.0597 8.47983L14.9599 7.69481C14.6447 5.21535 12.5242 3.33366 10.0002 3.33366C7.47613 3.33366 5.35555 5.21535 5.04041 7.69481L4.94063 8.47983L4.26923 8.89874C3.17646 9.58049 2.50016 10.7728 2.50016 12.0837C2.50016 14.0471 4.01544 15.6747 5.95991 15.8227L6.10433 15.8337H13.896L14.0404 15.8227ZM10.8335 10.8337V14.167H9.16683V10.8337H6.66683L10.0002 6.66699L13.3335 10.8337H10.8335Z" fill="white"/>
                        </svg>
                        تصدير pdf
                </a>
                <a href="{{ route('export.building.excel') }}" class="btn" style="border-radius: 4px;background: #57B0E2;color:#FFF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M0.833496 12.0837C0.833496 10.1433 1.85374 8.44124 3.38705 7.48466C3.80407 4.20366 6.60588 1.66699 10.0002 1.66699C13.3944 1.66699 16.1962 4.20366 16.6132 7.48466C18.1466 8.44124 19.1668 10.1433 19.1668 12.0837C19.1668 14.935 16.9637 17.2717 14.1668 17.4846L5.8335 17.5003C3.03665 17.2717 0.833496 14.935 0.833496 12.0837ZM14.0404 15.8227C15.9849 15.6747 17.5002 14.0471 17.5002 12.0837C17.5002 10.7728 16.8238 9.58049 15.7311 8.89874L15.0597 8.47983L14.9599 7.69481C14.6447 5.21535 12.5242 3.33366 10.0002 3.33366C7.47613 3.33366 5.35555 5.21535 5.04041 7.69481L4.94063 8.47983L4.26923 8.89874C3.17646 9.58049 2.50016 10.7728 2.50016 12.0837C2.50016 14.0471 4.01544 15.6747 5.95991 15.8227L6.10433 15.8337H13.896L14.0404 15.8227ZM10.8335 10.8337V14.167H9.16683V10.8337H6.66683L10.0002 6.66699L13.3335 10.8337H10.8335Z" fill="white"/>
                        </svg>
                          تصدير اكسيل
                </a>
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
                <td>{{ $item->contract_price }}kwd</td>
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







    @if(Auth::user()->can('الرسوم البيانيه'))
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card page-content-update" style="background:#FFF;box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.08);height: 100%;">
                    <h2 class="p-2" style="color:#1B1B1B;font-family:Cairo;font-size:23px;font-style:normal;font-weight: 700;line-height: 120%; text-align:center;">العقارات</h2>
                    <div class="card-body">
                        <div id="chart888"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="chart-bar-design page-content-update">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <!--end row-->
        <div class="row mt-4">
            <div class="col-lg-12 page-content-update">
                <h2 style="font-family:Cairo;font-size: 23px;font-style: normal;font-weight: 500;line-height: 120%;color:#1B1B1B);">إحصائيه الايجارات</h2>
                <div id="chart999"></div>
            </div>
        </div>
     </div>
     @endif


     <!-- end charts -->



  </div>



  <script>
    // JavaScript for generating the chart
    document.addEventListener("DOMContentLoaded", function() {
        const monthlyData = @json($monthlyData);

        // Extracting labels and data for 'rent' and 'sell' from the fetched data
        const labels = monthlyData.map(item => item.month);
        const rentData = monthlyData.map(item => item.rent);
        const sellData = monthlyData.map(item => item.sell);

        // Create the Chart.js chart using dynamically fetched data
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'البيع',
                        data: sellData,
                        backgroundColor: '#3498db',
                        borderWidth: 1
                    },
                    {
                        label: 'الإيجار',
                        data: rentData,
                        backgroundColor: '#9b59b6',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#333',
                            fontSize: 12,
                        }
                    }]
                },
                title:{
                    display:true,
                    text:'الايجارات و المبيعات',
                    fontSize :23,
                    fontFamily:'Cairo',
                    fontWeight:'700',
                    fontStyle:'normal',
                    fontColor:'#1B1B1B',
                }
            }
        });
    });
</script>



<script>
        var options = {
        series: [{{ $estsmari_chart }}, {{ $tgari_chart }}, {{ $aradi_chart }}, {{$sakani_chart}}],
        chart: {
            foreColor: '#9ba7b2',
            height: 330,
            type: 'pie',
        },
        colors: ["#EFF4FB", "#6AD2FF", "#4318FF", "#FED64A"],
        labels: ['الاستثماري', 'التجاري', 'الاراضي', 'السكني'],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 360
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector("#chart888"), options);
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
	var chart = new ApexCharts(document.querySelector("#chart999"), options);
	chart.render();
</script>


@endsection
