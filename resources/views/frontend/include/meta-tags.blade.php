@if(Route::currentRouteName() == 'service.items' || Route::currentRouteName() == 'category.blogs' ||  Route::currentRouteName() == 'package.show' || Route::currentRouteName() == 'blog.show')
    <title>Qalbish | @yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
@elseif(is_null($meta_information))
    <title>Qalbish | @yield('title')</title>
    <meta name="description"
          content="We are the first luxury spa in Pakistan to offer Certified Ayurvedic treatments for the mind, body and soul in the comfort and privacy of your own home. Indulge yourself in a range of luxury spa services for all your beauty, wellness and therapeutic needs; our services are supplemented with a wide range of premium as well as Ayurvedic (chemical free) products. Book your appointment now through our website, app, and whatsapp or by phone.">
    <meta name="keywords" content="Qalbish">
@else
    <title>Qalbish | {{$meta_information->title}}</title>
    <meta name="description" content="{{ $meta_information->description }}">
    <meta name="keywords" content="{{ $meta_information->keywords }}">
@endif


