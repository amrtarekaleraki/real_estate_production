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
                    <img src="{{ asset('adminbackend/assets/images/new/manage-buildings-icon.png') }}"
                        alt="">
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
