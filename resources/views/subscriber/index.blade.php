@extends('subscriber.subscriber_dashboard')

@section('subscriber')


<style>
    .chart-bar-design
    {
        background-color: rgb(240, 240, 240);
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 page-content-update">
      <div class="col">
        <div class="card radius-10 card2">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h5 class="mb-0 text-white">${{ $sellingContractPrice }}</h5>
              <div class="ms-auto icon-circle-1">
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
            </div>
            <div
              class="progress my-3 bg-light-transparent"
              style="height: 3px"
            >
              <div
                class="progress-bar bg-white"
                role="progressbar"
                style="width: 55%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <div class="d-flex align-items-center text-white">
              <p class="mb-0">إجمالي المبيعات</p>
              <p class="mb-0 ms-auto">
                {{-- +5.2%<span><i class="bx bx-up-arrow-alt"></i></span> --}}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card radius-10 card3">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h5 class="mb-0 text-white">${{ $rentingContractPrice }}</h5>
              <div class="ms-auto icon-circle-2">
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
            </div>
            <div
              class="progress my-3 bg-light-transparent"
              style="height: 3px"
            >
              <div
                class="progress-bar bg-white"
                role="progressbar"
                style="width: 55%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <div class="d-flex align-items-center text-white">
              <p class="mb-0">إجمالي الايجارات</p>
              <p class="mb-0 ms-auto">
                {{-- +2.2%<span><i class="bx bx-up-arrow-alt"></i></span> --}}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card radius-10 card1">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <h5 class="mb-0 text-white">${{ $monthContractPrice }}</h5>
              <div class="ms-auto icon-circle-3">
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
            </div>
            <div
              class="progress my-3 bg-light-transparent"
              style="height: 3px"
            >
              <div
                class="progress-bar bg-white"
                role="progressbar"
                style="width: 55%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
            <div class="d-flex align-items-center text-white">
              <p class="mb-0">إجمالي الشهر</p>
              <p class="mb-0 ms-auto">
                {{-- +1.2%<span><i class="bx bx-up-arrow-alt"></i></span> --}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--end row-->


    <h6 class="mb-2 mt-5 text-uppercase table-title">العقارات</h6>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
            <div class="exports d-flex mb-3" style="gap: 10px;">
                <a href="{{ route('export.subscribers.building.pdf') }}" class="btn btn-info">PDF</a>
            </div>
          <table id="example" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>اسم العقار</th>
                <th>العنوان</th>
                <th>الحاله</th>
                <th>العمليات</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($buildings as $key => $item)
              <tr>
                <td>
                  <img src="{{ asset($item->building_cover_img)}}" width="40" height="35">
                 {{ $item->building_title }}

                </td>
                <td>{{ $item->building_location }}</td>
                <td>{{ $item->building_avilability_status === 'empty' ? 'خالي' : "غير خالي" }}</td>
                <td>
                    <div class="operations">
                         <a href="{{ route('subscriber.show.building',$item->id) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                              <path d="M8.50028 2C12.095 2 15.0857 4.58651 15.7127 8C15.0857 11.4135 12.095 14 8.50028 14C4.9055 14 1.91485 11.4135 1.28784 8C1.91485 4.58651 4.9055 2 8.50028 2ZM8.50028 12.6667C11.324 12.6667 13.7403 10.7013 14.3519 8C13.7403 5.29869 11.324 3.33333 8.50028 3.33333C5.67648 3.33333 3.26023 5.29869 2.6486 8C3.26023 10.7013 5.67648 12.6667 8.50028 12.6667ZM8.50028 11C6.8434 11 5.50026 9.65687 5.50026 8C5.50026 6.34315 6.8434 5 8.50028 5C10.1571 5 11.5003 6.34315 11.5003 8C11.5003 9.65687 10.1571 11 8.50028 11ZM8.50028 9.66667C9.42075 9.66667 10.1669 8.92047 10.1669 8C10.1669 7.07953 9.42075 6.33333 8.50028 6.33333C7.57982 6.33333 6.83359 7.07953 6.83359 8C6.83359 8.92047 7.57982 9.66667 8.50028 9.66667Z" fill="#ACACAC"/>
                           </svg>
                         </a>


                          <a href="{{ route('subscriber.edit.building',$item->id) }}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                  <path d="M4.77614 10.593L11.5375 3.83158L10.5947 2.88878L3.83333 9.65021V10.593H4.77614ZM5.32843 11.9263H2.5V9.09794L10.1233 1.47456C10.3837 1.21421 10.8058 1.21421 11.0661 1.47456L12.9518 3.36018C13.2121 3.62053 13.2121 4.04264 12.9518 4.30299L5.32843 11.9263ZM2.5 13.2597H14.5V14.593H2.5V13.2597Z" fill="#2D9CDB"/>
                                  </svg>
                          </a>


                           <a href="{{ route('subscriber.delete.building',$item->id) }}" id="delete">
                              <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                  <path d="M11.8335 3.99967H15.1668V5.33301H13.8335V13.9997C13.8335 14.3679 13.535 14.6663 13.1668 14.6663H3.8335C3.46531 14.6663 3.16683 14.3679 3.16683 13.9997V5.33301H1.8335V3.99967H5.16683V1.99967C5.16683 1.63149 5.46531 1.33301 5.8335 1.33301H11.1668C11.535 1.33301 11.8335 1.63149 11.8335 1.99967V3.99967ZM12.5002 5.33301H4.50016V13.333H12.5002V5.33301ZM6.50016 7.33301H7.8335V11.333H6.50016V7.33301ZM9.16683 7.33301H10.5002V11.333H9.16683V7.33301ZM6.50016 2.66634V3.99967H10.5002V2.66634H6.50016Z" fill="#F94144"/>
                                  </svg>
                           </a>

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


     <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 chart-bar-design">

                <canvas id="myChart"></canvas>

            </div>
        </div>
        <!--end row-->
     </div>


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
                }
            }
        });
    });
</script>





  {{-- <script>
    // JavaScript for generating the grouped bar chart
    document.addEventListener("DOMContentLoaded", function() {
      // Data for the chart (replace this with your data)
      const data = {
        labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
        datasets: [
          {
            label: 'البيع',
            data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
            backgroundColor: '#3498db',
            borderWidth: 1
          },
          {
            label: 'الايجار',
            data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
            backgroundColor: '#e74c3c',
            borderWidth: 1
          }
        ]
      };

      // Get the canvas element
      const ctx = document.getElementById('myChart').getContext('2d');

        // Create the chart
        new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontColor: '#333',
                fontSize: 12
              }
            }]
          }
        }
      });
    });
  </script> --}}





@endsection
