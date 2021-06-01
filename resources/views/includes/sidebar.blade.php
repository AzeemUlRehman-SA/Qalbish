<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
        class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            <li class="m-menu__item  "
                aria-haspopup="true"><a href="{{ route('index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-home"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Home</span>
											</span></span></a></li>


            <li class="m-menu__item {{ (request()->is('admin/dashboard')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.dashboard.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-dashboard"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span>
											</span></span></a></li>
            <li class="m-menu__item  {{ (request()->is('admin/order-history') || request()->is('admin/order-history/*') || request()->is('admin/order') || request()->is('admin/order/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.get.order.history') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-time"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Order History</span>
											</span></span></a></li>


            <li class="m-menu__item {{ (request()->is('admin/users') || request()->is('admin/users/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.users.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-user-add"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Users</span>
											</span></span></a></li>
            <li class="m-menu__item {{ (request()->is('admin/user-referrals') || request()->is('admin/user-referrals/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.user.referral.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-user-settings"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Referrals</span>
											</span></span></a></li>


            {{--            <li class="m-menu__item {{ (request()->is('admin/driver') || request()->is('admin/driver/*')) ? 'activeMenu' : '' }} "--}}
            {{--                aria-haspopup="true"><a href="{{ route('admin.get.employee.user') }}" class="m-menu__link "><i--}}
            {{--                        class="m-menu__link-icon flaticon-users"></i><span--}}
            {{--                        class="m-menu__link-title"> <span--}}
            {{--                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Assign Driver</span>--}}
            {{--											</span></span></a></li>--}}

            <li class="m-menu__item  {{ (request()->is('admin/cities') || request()->is('admin/cities/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.cities.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-location"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Cities</span>
											</span></span></a></li>

            <li class="m-menu__item {{ (request()->is('admin/areas') || request()->is('admin/areas/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.areas.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-location"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Area</span>
											</span></span></a></li>


            <li class="m-menu__item m-menu__item--submenu {{ (request()->is('admin/services') || request()->is('admin/services/*') || request()->is('admin/category') || request()->is('admin/category/*') || request()->is('admin/menu-items') || request()->is('admin/menu-items/*') || request()->is('admin/addons') || request()->is('admin/addons/*')) ? 'activeMenu m-menu__item--open' : '' }} "
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i
                        class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-text">
												Services
											</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu" style="">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  {{ (request()->is('admin/category') || request()->is('admin/category/*')) ? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a href="{{ route('admin.category.index') }}"
                                                                         class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-line-graph"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Categories</span>
											</span></span></a></li>

                        <li class="m-menu__item  {{ (request()->is('admin/services') || request()->is('admin/services/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a href="{{ route('admin.services.index') }}"
                                                                         class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-line-graph"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Services</span>
											</span></span></a></li>

                        <li class="m-menu__item  {{ (request()->is('admin/menu-items') || request()->is('admin/menu-items/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a href="{{ route('admin.menu-items.index') }}"
                                                                         class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-line-graph"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Menu Items</span>
											</span></span></a></li>

                        <li class="m-menu__item  {{ (request()->is('admin/addons') || request()->is('admin/addons/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a href="{{ route('admin.addons.index') }}"
                                                                         class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-feed"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">AddOns</span>
											</span></span></a></li>

                    </ul>
                </div>
            </li>


            <li class="m-menu__item  {{ (request()->is('admin/packages') || request()->is('admin/packages/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.packages.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-open-box"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Packages</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('admin/discounts') || request()->is('admin/first-order-discount') || request()->is('admin/first-order-discount/*') || request()->is('admin/memberships-discount') || request()->is('admin/memberships-discount/*') || request()->is('admin/referral-discount') || request()->is('admin/referral-discount/*') || request()->is('admin/coupons') || request()->is('admin/coupons/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.discount.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-gift"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Discounts</span>
											</span></span></a></li>


            <li class="m-menu__item m-menu__item--submenu {{ (request()->is('admin/special-offers') || request()->is('admin/special-offers/*') || request()->is('admin/category-blogs') ||  request()->is('admin/category-blogs/*')) ? 'activeMenu m-menu__item--open' : '' }} "
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i
                        class="m-menu__link-icon flaticon-questions-circular-button"></i>
                    <span class="m-menu__link-text">
												Special Offers
											</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu" style="">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  {{ (request()->is('admin/special-offers') || request()->is('admin/special-offers/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a
                                href="{{ route('admin.special-offers.index') }}"
                                class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-questions-circular-button"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Special Offers</span>
											</span></span></a></li>

                        <li class="m-menu__item  {{ (request()->is('admin/category-blogs') || request()->is('admin/category-blogs/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a
                                href="{{ route('admin.category-blogs.index') }}" class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-questions-circular-button"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Special Offers Category</span>
											</span></span></a></li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item m-menu__item--submenu {{ (request()->is('admin/memberships') || request()->is('admin/memberships/*') || request()->is('admin/membership-details') || request()->is('admin/membership-details/*')) ? 'activeMenu m-menu__item--open' : '' }} "
                aria-haspopup="true" data-menu-submenu-toggle="hover">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i
                        class="m-menu__link-icon flaticon-file-2"></i>
                    <span class="m-menu__link-text">
												Membership Info
											</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu" style="">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item {{ (request()->is('admin/membership-details') || request()->is('admin/membership-details/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a
                                href="{{ route('admin.membership-details.index') }}" class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-customer"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span
                                            class="m-menu__link-text">Membership Details</span>
											</span></span></a></li>

                        <li class="m-menu__item {{ (request()->is('admin/memberships') || request()->is('admin/memberships/*'))? 'activeSubMenuItem' : ''}}"
                            aria-haspopup="true" data-redirect="true"><a href="{{ route('admin.memberships.index') }}"
                                                                         class="m-menu__link "><i
                                    class="m-menu__link-icon flaticon-customer"></i><span
                                    class="m-menu__link-title"> <span
                                        class="m-menu__link-wrap"> <span class="m-menu__link-text">Membership</span>
											</span></span></a></li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item {{ (request()->is('admin/contacts') || request()->is('admin/contacts/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.contacts.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-bell"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Email Messages</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('admin/testimonial') || request()->is('admin/testimonial/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.testimonial.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-chat"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Testimonials</span>
											</span></span></a></li>


            <li class="m-menu__item  {{ (request()->is('admin/aboutus') || request()->is('admin/aboutus/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.aboutus.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-doc"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">About Us</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('admin/privacypolicy') || request()->is('admin/privacypolicy/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.privacypolicy.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-book"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Privacy Policy</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('admin/managing-parteners') || request()->is('admin/managing-parteners/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.managing-parteners.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-customer"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Managing Partners</span>
											</span></span></a></li>


            <li class="m-menu__item  {{ (request()->is('admin/settings') || request()->is('admin/settings/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.settings.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-settings"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Settings</span>
											</span></span></a></li>

            <li class="m-menu__item  {{ (request()->is('admin/meta-tags') || request()->is('admin/meta-tags/*')) ? 'activeMenu' : '' }} "
                aria-haspopup="true"><a href="{{ route('admin.meta-tags.index') }}" class="m-menu__link "><i
                        class="m-menu__link-icon flaticon-information"></i><span
                        class="m-menu__link-title"> <span
                            class="m-menu__link-wrap"> <span class="m-menu__link-text">Meta Tags (SEO)</span>
											</span></span></a></li>


        </ul>

    </div>

    <!-- END: Aside Menu -->
</div>
