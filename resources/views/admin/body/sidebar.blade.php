<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>

        @php
            $settings = App\Models\Setting::latest()->get();
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
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon">
                        <img src="{{ asset('adminbackend/assets/images/new/home-icon.png') }}" alt="">
                    </div>
                    <div class="menu-title">الرئيسيه</div>
                </a>
            </li>


        @if(Auth::user()->can('قائمه اداره العقارات'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <img src="{{ asset('adminbackend/assets/images/new/manage-buildings-icon.png') }}"
                            alt="">
                    </div>
                    <div class="menu-title">إداره العقارات</div>
                </a>
                <ul>
                    @if(Auth::user()->can('الاقسام'))
                        <li>
                            <a href="{{ route('all.category') }}"><i class="bx bx-left-arrow-alt"></i>الأقسام</a>
                        </li>
                    @endif
                    @if(Auth::user()->can('جميع العقارات'))
                        <li>
                            <a href="{{ route('all.building') }}"><i class="bx bx-left-arrow-alt"></i>جميع العقارات</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


        @if(Auth::user()->can('قائمه المشتركين'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon">
                        <img src="{{ asset('adminbackend/assets/images/new/subscribers2-icon.png') }}"
                            alt="">
                    </div>
                    <div class="menu-title">المشتركين</div>
                </a>
                <ul>
                    @if(Auth::user()->can('جميع المشتركين'))
                        <li>
                            <a href="{{ route('admin.all.subscriber') }}"><i class="bx bx-left-arrow-alt"></i>جميع المشتركين</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif



        @if(Auth::user()->can('قائمه المستاجرين والملاك'))
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
                        <a href="{{ route('admin.all.owner') }}"><i class="bx bx-left-arrow-alt"></i>كل المستأجرين والملاك بالسيستم</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.all.tenant') }}"><i class="bx bx-left-arrow-alt"></i>جميع المستأجرين خاص بالادمن</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.all.only.owners') }}"><i class="bx bx-left-arrow-alt"></i> جميع الملاك خاص بالادمن   </a>
                    </li>

                </ul>
            </li>
        @endif


        @if(Auth::user()->can('قائمه الصلاحيات و الادوار'))

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <img src="{{ asset('adminbackend/assets/images/new/permissions-icon.png') }}"
                            alt="">
                    </div>
                    <div class="menu-title">الصلاحيات و الادوار</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('all.permisions') }}"><i class="bx bx-left-arrow-alt"></i>جميع الصلاحيات</a>
                    </li>
                    <li>
                        <a href="{{ route('all.roles') }}"><i class="bx bx-left-arrow-alt"></i>جميع الادوار</a>
                    </li>
                    <li>
                        <a href="{{ route('add.roles.permission') }}"><i class="bx bx-left-arrow-alt"></i>ربط الصلاحيات بالادوار</a>
                    </li>
                    <li>
                        <a href="{{ route('all.roles.permission') }}"><i class="bx bx-left-arrow-alt"></i>جميع الصلاحيات مع الادوار</a>
                    </li>
                </ul>
            </li>
        @endif


        @if(Auth::user()->can('قائمه المشرفين'))
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                            <img src="{{ asset('adminbackend/assets/images/new/roler-icon.png') }}" alt="">
                        </div>
                        <div class="menu-title">المشرفين</div>
                    </a>
                    <ul>
                        <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>جميع المشرفين</a></li>
                    </ul>
                </li>
        @endif


        {{-- <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon">
                    <img src="{{ asset('adminbackend/assets/images/new/reports-icon.png') }}" alt="">
                </div>
                <div class="menu-title">تقارير و إحصائيات</div>
            </a>
            <ul>
                <li>
                    <a href="icons-line-icons.html"><i class="bx bx-left-arrow-alt"></i>Line Icons</a>
                </li>
                <li>
                    <a href="icons-boxicons.html"><i class="bx bx-left-arrow-alt"></i>Boxicons</a>
                </li>
                <li>
                    <a href="icons-feather-icons.html"><i class="bx bx-left-arrow-alt"></i>Feather Icons</a>
                </li>

            </ul>
        </li> --}}

        @if(Auth::user()->can('قائمه الاعدادات'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon">
                        <img src="{{ asset('adminbackend/assets/images/new/settings-icon.png') }}"
                            alt="">
                    </div>
                    <div class="menu-title">الاعدادات</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('all.settings') }}"><i class="bx bx-left-arrow-alt"></i>جميع الاعدادات</a>
                    </li>
                </ul>
            </li>
        @endif

        <li>
    </ul>
    <!--end navigation-->
</div>
