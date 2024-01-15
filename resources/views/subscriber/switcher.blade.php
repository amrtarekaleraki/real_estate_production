<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        // $settings = App\Models\Setting::latest()->get();
        $settings = App\Models\Setting::join('users', 'settings.added_by', '=', 'users.id')
                    ->where('users.role', 'admin')
                    ->select('settings.*') // Select the columns you need from the settings table
                    ->get();
    @endphp

    @foreach ($settings as $item)
      <link rel="icon" href="{{ asset($item->favicon)}}" type="image/png" />
    @endforeach
    <!--plugins-->
    <link
      href="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}"
      rel="stylesheet"
    />
    <link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link
      href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css')}}"
      rel="stylesheet"
    />
	<link href="{{ asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('adminbackend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('adminbackend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('adminbackend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/app.css')}}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/icons.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <title>لوحه تحكم المشتركين</title>
  </head>

  <body>
    <!--wrapper-->
    <div class="wrapper">
            <!--sidebar wrapper -->
            <div class="sidebar-wrapper" data-simplebar="true">
              <div class="sidebar-header">

                <div>

                @php
                    // $settings = App\Models\Setting::latest()->get();
                    $settings = App\Models\Setting::join('users', 'settings.added_by', '=', 'users.id')
                    ->where('users.role', 'admin')
                    ->select('settings.*') // Select the columns you need from the settings table
                    ->get();
                @endphp

                @foreach ($settings as $item)
                  <img src="{{ asset($item->logo) }}" class="logo-icon" alt="logo icon" />
                @endforeach

                </div>
                <!-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div> -->
              </div>
              <!--navigation-->
              <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('subscriber.dashboard') }}">
                        <div class="parent-icon">
                            <img src="{{ asset('adminbackend/assets/images/new/home-icon.png') }}" alt="">
                        </div>
                        <div class="menu-title">الرئيسيه</div>
                    </a>
                </li>

                <li>
                  <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                      <img src="{{ asset('adminbackend/assets/images/new/manage-buildings-icon.png')}}" alt="">
                    </div>
                    <div class="menu-title">إداره العقارات</div>
                  </a>
                  <ul>
                    <li>
                        <a href={{ route('subscriber.all.building') }}><i class="bx bx-left-arrow-alt"></i>جميع العقارات</a>
                    </li>
                    <li>
                        <a href={{ route('subscriber.add.building') }}><i class="bx bx-left-arrow-alt"></i>إضافه عقار</a>
                    </li>
                  </ul>
                </li>


                <li>
                    <a class="has-arrow">
                        <div class="parent-icon">
                            <img src="{{ asset('adminbackend/assets/images/new/subscribers-icon.png') }}"
                                alt="">
                        </div>
                        <div class="menu-title">المستأجرين و الملاك</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('subscriber.all.owner') }}"><i class="bx bx-left-arrow-alt"></i>جميع المستأجرين و الملاك</a>
                        </li>
                        <li>
                            <a href="{{ route('subscriber.all.tenant') }}"><i class="bx bx-left-arrow-alt"></i>جميع المستأجرين  </a>
                        </li>
                        <li>
                            <a href="{{ route('subscriber.only.owner') }}"><i class="bx bx-left-arrow-alt"></i>جميع الملاك</a>
                        </li>
                        <li>
                            <a href="{{ route('subscriber.add.owner') }}"><i class="bx bx-left-arrow-alt"></i>إضافه مستأجر او مالك</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a class="has-arrow">
                        <div class="parent-icon">
                            <img src="{{ asset('adminbackend/assets/images/new/reports-icon.png') }}" alt="">
                        </div>
                        <div class="menu-title">التقارير و الاحصائيات</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('subscriber.all.report') }}"><i class="bx bx-left-arrow-alt"></i>جميع التقارير و الاحصائيات</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('subscriber.all.settings') }}">
                        <div class="parent-icon">
                            <img src="{{ asset('adminbackend/assets/images/new/settings-icon.png') }}"
                                alt="">
                        </div>
                        <div class="menu-title">الاعدادات</div>
                    </a>
                </li>


                <li>
              </ul>
              <!--end navigation-->
            </div>
            <!--end sidebar wrapper -->

                     <!--start header -->
                     <header>
                      <div class="topbar d-flex align-items-center">
                        <nav class="navbar navbar-expand">
                          <div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>

                          <div class="top-menu ms-auto">
                            <ul class="navbar-nav align-items-center">
                              <!-- <li class="nav-item mobile-search-icon">
                                              <a class="nav-link" href="#">	<i class='bx bx-search'></i>
                                              </a>
                                          </li> -->
                              <li class="nav-item dropdown dropdown-large">

                                  <a id="pageToggle" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" onclick="togglePage()">
                                    <img src="{{ asset('adminbackend/assets/images/new/switch.png')}}" alt="">
                                  </a>

                                <div class="dropdown-menu dropdown-menu-end dropmenu-notifications">
                                  <div class="header-notifications-list">
                                  </div>
                                </div>
                              </li>


                              <li class="nav-item dropdown dropdown-large">
                                {{-- <a
                                  class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                  href="#"
                                  role="button"
                                  data-bs-toggle="dropdown"
                                  aria-expanded="false"
                                >
                                  <span class="alert-count">8</span>
                                  <!-- <i class="bx bx-comment"></i> -->
                                  <img src="{{ asset('adminbackend/assets/images/new/notification.png')}}" alt="">
                                </a> --}}
                                <div
                                  class="dropdown-menu dropdown-menu-end dropmenu-messages"
                                >
                                  <a href="javascript:;">
                                    <div class="msg-header">
                                      <p class="msg-header-title">الرسائل</p>
                                      <p class="msg-header-clear ms-auto">قراءه الكل</p>
                                    </div>
                                  </a>
                                  <div class="header-message-list">
                                    <a class="dropdown-item" href="javascript:;">
                                      <div class="d-flex align-items-center">
                                        <div class="user-online">
                                          <img
                                            src="{{ asset('adminbackend/assets/images/avatars/avatar-1.png')}}"
                                            class="msg-avatar"
                                            alt="user avatar"
                                          />
                                        </div>
                                        <div class="flex-grow-1">
                                          <h6 class="msg-name">
                                            Daisy Anderson
                                            <span class="msg-time float-end"
                                              >منذ 5 ثواني</span
                                            >
                                          </h6>
                                          <p class="msg-info">The standard chunk of lorem</p>
                                        </div>
                                      </div>
                                    </a>
                                  </div>
                                  <a href="javascript:;">
                                    <div class="text-center msg-footer">كل الرسائل</div>
                                  </a>
                                </div>
                              </li>
                            </ul>
                          </div>

                          @php
                             $id = Auth::user()->id;
                             $SubscriberData = App\Models\User::find($id);
                          @endphp

                          <div class="user-box dropdown">
                            <a
                              class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                              href="#"
                              role="button"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                            <img src="{{ (!empty($SubscriberData->photo)) ? url('upload/subscriber_images/'.$SubscriberData->photo):url('upload/no_image.jpg') }}" class="user-img" alt="user avatar">
                              <div class="user-info ps-3 header-user-name">
                                <p class="user-name mb-0">
                                    {{ Auth::user()->name}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                        <path d="M8.99978 10.3785L12.7121 6.66626L13.7728 7.72692L8.99978 12.4999L4.22681 7.72692L5.28747 6.66626L8.99978 10.3785Z" fill="black"/>
                                    </svg>
                                </p>
                                <p class="designattion mb-0">{{ Auth::user()->role === "subscriber" ? 'مشترك' :''}}</p>
                              </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                <a class="dropdown-item" href="{{ route('subscriber.profile') }}">
                                  <div class="d-flex header-user-info">
                                    <i class="bx bx-user icon-info"></i>
                                    <span class="header-info">المعلومات الشخصيه</span>
                                  </div>
                                </a>
                              </li>

                              <li>
                                <a class="dropdown-item" href="{{ route('subscriber.change.password') }}">
                                    <div class="d-flex header-user-info">
                                        <i class="bx bx-cog icon-info"></i>
                                        <span class="header-info">تغيير كلمه السر</span>
                                    </div>
                                </a>
                            </li>

                              <li>
                                <a class="dropdown-item" href="{{ route('subscriber.logout') }}">
                                  <div class="d-flex header-user-info">
                                    <i class="bx bx-log-out-circle icon-logout"></i>
                                    <span class="header-logout">تسجيل الخروج</span>
                                  </div>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </nav>
                      </div>
                    </header>
                    <!--end header -->
      <!--end header -->

      <!--start page wrapper -->
      <div class="page-wrapper">
        <div class="page-content">

          <!-- ///////////////// start switcher//////////////// -->

        <div class="col">
            <div class="switcher-parent">
                @foreach ($categories as $item)
                    <a class="category-link" href="#" data-category-id="{{ $item->id }}">
                        <p>{{ $item->category_name }}</p>
                    </a>
                @endforeach
            </div>
        </div>


       <!-- ////////////// end switcher///////////////// -->

          <h6 class="mb-2 mt-5 text-uppercase table-title">السكني</h6>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>اسم العقار</th>
                            <th>العنوان</th>
                            <th>الحاله</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody id="buildings-table-body">
                        <!-- Building data will be dynamically loaded here -->
                    </tbody>
                </table>

              </div>
            </div>
          </div>


		  <!-- table end  -->








        </div>
      </div>
      <!--end page wrapper -->




      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
        $(document).ready(function() {
            // Function to fetch buildings by category ID
            function fetchBuildingsByCategory(categoryId) {
                // AJAX request to get buildings based on the category ID
                $.ajax({
                    url: '/subscriber/fetch-buildings/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        var buildingsTableBody = $('#buildings-table-body');
                        buildingsTableBody.empty();

                        // Loop through the retrieved buildings and populate the table rows
                        $.each(response.buildings, function(index, item) {
                            var imageUrl = '{{ asset(':imgPath') }}'.replace(':imgPath', item.building_cover_img);

                            var row = '<tr>' +
                                '<td>' +
                                '<img src="' + imageUrl + '" width="40" height="35">' +
                                item.building_title +
                                '</td>' +
                                '<td>' + item.building_location + '</td>' +
                                '<td>' + (item.building_avilability_status === 'empty' ? 'خالي' : 'غير خالي') + '</td>' +
                                '<td>' +
                                '<div class="operations">' +
                                '<a href="{{ route('subscriber.show.building', ':id') }}">'.replace(':id', item.id) +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">' +
                                '<path d="M8.50028 2C12.095 2 15.0857 4.58651 15.7127 8C15.0857 11.4135 12.095 14 8.50028 14C4.9055 14 1.91485 11.4135 1.28784 8C1.91485 4.58651 4.9055 2 8.50028 2ZM8.50028 12.6667C11.324 12.6667 13.7403 10.7013 14.3519 8C13.7403 5.29869 11.324 3.33333 8.50028 3.33333C5.67648 3.33333 3.26023 5.29869 2.6486 8C3.26023 10.7013 5.67648 12.6667 8.50028 12.6667ZM8.50028 11C6.8434 11 5.50026 9.65687 5.50026 8C5.50026 6.34315 6.8434 5 8.50028 5C10.1571 5 11.5003 6.34315 11.5003 8C11.5003 9.65687 10.1571 11 8.50028 11ZM8.50028 9.66667C9.42075 9.66667 10.1669 8.92047 10.1669 8C10.1669 7.07953 9.42075 6.33333 8.50028 6.33333C7.57982 6.33333 6.83359 7.07953 6.83359 8C6.83359 8.92047 7.57982 9.66667 8.50028 9.66667Z" fill="#ACACAC"/>' +
                                '</svg>' +
                                '</a>' +
                                // ... (other operations)
                                '</div>' +
                                '</td>' +
                                '</tr>';

                            buildingsTableBody.append(row);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

             // Fetch data for the first category when the page loads
        var firstCategoryLink = $('.category-link').first();
        var firstCategoryId = firstCategoryLink.data('category-id');
        firstCategoryLink.addClass('active'); // Add 'active' class to the first category link
        fetchBuildingsByCategory(firstCategoryId);

        // Click event handler for category links
        $('.category-link').click(function(event) {
            event.preventDefault();
            $('.category-link').removeClass('active'); // Remove 'active' class from all category links
            $(this).addClass('active'); // Add 'active' class to the clicked category link
            var categoryId = $(this).data('category-id');
            fetchBuildingsByCategory(categoryId);

            // Update the content of the h6 tag with the name of the active category
            var activeCategoryName = $(this).text();
            $('.table-title').text(activeCategoryName);
        });
    });
    </script>









 <!-- Bootstrap JS -->
 <script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
 <!--plugins-->
 <script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/apexcharts-bundle/js/apex-custom.js') }}"></script>
 <!-- Vector map JavaScript -->
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-in-mill.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-au-mill.js') }}"></script>
 <script src="{{ asset('adminbackend/assets/plugins/vectormap/jvectormap.custom.js') }}"></script>


 <script>
     $(function() {
         $(".knob").knob();
     });
 </script>

 <script>
     $(document).ready(function() {
         $("#example").DataTable();
     });
 </script>
 <script>
     $(document).ready(function() {
         var table = $("#example2").DataTable({
             lengthChange: false,
             buttons: ["copy", "excel", "pdf", "print"],
         });

         table
             .buttons()
             .container()
             .appendTo("#example2_wrapper .col-md-6:eq(0)");
     });
 </script>

 <script src="{{ asset('adminbackend/assets/js/index.js') }}"></script>

 <!--app JS-->
 <script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>


 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>



    <script>
        let currentPage = 1; // Initial page

  function togglePage() {
    const pageToggle = document.getElementById('pageToggle');

    if (currentPage === 1) {
      pageToggle.href = '{{ route('subscriber.dashboard') }}'; // Set the first page URL
      currentPage = 2;
    } else {
      pageToggle.href = '{{ route('subscriber.switcher') }}'; // Set the second page URL
      currentPage = 1;
    }
  }
      </script>

    <script>
      $(document).ready(function() {
      $('.switcher-parent a').click(function() {
        // Remove 'active' class from all paragraphs
        $('.switcher-parent a').removeClass('active');
        // Add 'active' class to the clicked paragraph
        $(this).addClass('active');
      });
    });
    </script>

  </body>
</html>
