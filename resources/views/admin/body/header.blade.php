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

                        @php
                             $buildings = App\Models\Building::latest()->get();
                        @endphp

                        @if($buildings->count() > 0)
                            <a id="pageToggle" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                            href="{{ route('admin.switcher') }}">
                                <img src="{{ asset('adminbackend/assets/images/new/switch.png') }}"
                                    alt="">
                            </a>
                        @endif

                        <div class="dropdown-menu dropdown-menu-end dropmenu-notifications">
                            <div class="header-notifications-list">
                            </div>
                        </div>
                    </li>









                    <li class="nav-item dropdown dropdown-large">

                        @if(Auth::user()->can('الاشعارات'))
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                       $ncount = Auth::user()->unreadNotifications()->count()
                                @endphp
                                @if($ncount > 0)
                                    <span class="alert-count" id="notificationCount">
                                        {{ $ncount }}
                                    </span>
                                @endif
                                <img src="{{ asset('adminbackend/assets/images/new/notification.png') }}"
                                    alt="">
                            </a>
                        @endif

                        <div class="dropdown-menu dropdown-menu-end dropmenu-messages">
                            <div href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">الرسائل</p>
                                    <a href="" class="msg-header-clear ms-auto" onclick="markAllAsRead()">قراءه الكل</a>
                                </div>
                            </div>
                            <div class="header-message-list">

                                @php
                                  $user = Auth::user();
                                @endphp

                            @forelse($user->unreadNotifications as $notification)
                                <a class="dropdown-item" href="javascript:;" data-id="{{ $notification->id }}" onclick="markAsRead(this)">
                                    <div class="d-flex" style="justify-content: space-between;">

                                        <div class="d-flex" style="align-items: center;">
                                            <div class="notify bg-light-warning text-warning">
                                                <i class="bx bx-send" style="rotate: 180deg;"></i>
                                            </div>
                                            <div>
                                                <p style="margin-bottom:0px;">{{ $notification->data['message'] }}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h6 class="msg-name">
                                                <span class="msg-time float-end">
                                                    {{ Carbon\Carbon::parse($notification->created_at)->locale('ar')->diffForHumans() }}
                                                </span>
                                            </h6>
                                        </div>



                                    </div>
                                </a>
                            @empty

                            @endforelse

                            </div>
                            {{-- <a href="javascript:;">
                                <div class="text-center msg-footer">كل الرسائل</div>
                            </a> --}}
                        </div>
                    </li>



                </ul>
            </div>

            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::find($id);
            @endphp

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo):url('upload/no_image.jpg') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3 header-user-name">
                        <p class="user-name mb-0">
                            {{ Auth::user()->name}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                <path d="M8.99978 10.3785L12.7121 6.66626L13.7728 7.72692L8.99978 12.4999L4.22681 7.72692L5.28747 6.66626L8.99978 10.3785Z" fill="black"/>
                            </svg>
                        </p>
                        <p class="designattion mb-0">{{ Auth::user()->role}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <div class="d-flex header-user-info">
                                <i class="bx bx-user icon-info"></i>
                                <span class="header-info">المعلومات الشخصيه</span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.change.password') }}">
                            <div class="d-flex header-user-info">
                                <i class="bx bx-cog icon-info"></i>
                                <span class="header-info">تغيير كلمه السر</span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
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

    <script>
        function markAsRead(element) {
            var id = $(element).data('id');

            $.ajax({
                url: '/notification/read',
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        $(element).remove();

                    // Update notification count
                    var count = $('#notificationCount').text();

                    if(count > 0) {
                        count--;
                        $('#notificationCount').text(count);

                        // Hide the span if the count is 0
                        if(count == 0) {
                            $('#notificationCount').hide();
                        }
                    }

                    /////

                    }
                }
            });
        }
    </script>


   <script>
       function markAllAsRead() {
            $.ajax({
                url: '/notification/read-all',
                method: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if(response.success) {
                        // Remove all notifications and update count
                        $('.dropdown-item').remove();
                        $('#notificationCount').text(0).hide();
                    }
                }
            });
        }
   </script>

</header>
