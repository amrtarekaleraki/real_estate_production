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

                        {{-- <a id="pageToggle" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                        href="{{ route('subscriber.switcher') }}">
                            <img src="{{ asset('adminbackend/assets/images/new/switch.png') }}"
                                alt="">
                        </a> --}}

                        @php
                        $user_id   = Auth::user()->id;
                        $buildings = App\Models\Building::where('added_by',$user_id)->latest()->get();
                        @endphp

                        @if($buildings->count() > 0)
                            <a id="pageToggle" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                            href="{{ route('subscriber.switcher') }}">
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
                        {{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="alert-count">8</span>
                            <!-- <i class="bx bx-comment"></i> -->
                            <img src="{{ asset('adminbackend/assets/images/new/notification.png') }}"
                                alt="">
                        </a> --}}
                        <div class="dropdown-menu dropdown-menu-end dropmenu-messages">
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
                                            <img src="{{ asset('adminbackend/assets/images/avatars/avatar-1.png') }}"
                                                class="msg-avatar" alt="user avatar" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">
                                                Daisy Anderson
                                                <span class="msg-time float-end">منذ 5 ثواني</span>
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
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ (!empty($SubscriberData->photo)) ? url('upload/subscriber_images/'.$SubscriberData->photo):url('upload/no_image.jpg') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3 header-user-name">
                        <p class="user-name mb-0">{{ Auth::user()->name}}</p>
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
