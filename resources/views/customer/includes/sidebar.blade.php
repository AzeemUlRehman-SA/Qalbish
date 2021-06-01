<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
        class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark"
         m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

            <li class="m-menu__item "
                aria-haspopup="true"><a href="{{ route('index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-home"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Home</span>
											</span></span></a></li>
            <li class="m-menu__item {{ (request()->is('customer/dashboard')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('customer.dashboard.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-dashboard"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('customer/profile') || request()->is('customer/edit') || request()->is('customer/edit/*') || request()->is('customer/update/profile/*') || request()->is('customer/update') || request()->is('customer/update/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('customer.profile.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-profile-1"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Profile</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('customer/referrals')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('customer.user.referral') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-user-settings"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Referrals</span>
											</span></span></a></li>


            <li class="m-menu__item  {{ (request()->is('customer/order-history') || request()->is('customer/order/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('customer.order.history') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-time"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Order History</span>
											</span></span></a></li>

        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>
