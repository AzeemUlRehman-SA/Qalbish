@extends('layouts.master')
@section('title','Packages')
@push('css')
    <style rel="stylesheet">
        .menuItemsCssClass input {
            width: 7%;
            float: left;
            margin-bottom: 15px;
        }

        .menuItemsCssClass span {
            padding-left: 20px;
            /*padding-top: 10px;*/
            display: block;
            margin-bottom: 15px;
        }

        .disabledDiv {
            pointer-events: none;
            opacity: 1.4;
        }

        .card-header a {
            text-decoration: none;
        }

        .accordion .card:first-of-type {
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-header {
            background: #ff6c2b !important;
        }

        .mb-0 {
            color: #fff !important;
        }

        .orderModal .modal-header {
            background: #ff6c2b !important;
        }

        .orderModal .modal-title {
            color: #fff !important;
        }
    </style>
@endpush
@section('content')


    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add {{ __('Package') }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <form class="m-form" method="post" action="{{ route('admin.packages.store') }}"
                              enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="m-form__section m-form__section--first">


                                    <div class="form-group row">


                                        <div class="col-md-6">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Name') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name" value="{{ old('name') }}"
                                                   autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="slug"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Slug') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="slug" type="text"
                                                   class="form-control @error('slug') is-invalid @enderror"
                                                   name="slug" value="{{ old('slug') }}"
                                                   autocomplete="slug" autofocus>

                                            @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="service_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Category') }}
                                                <span class="mandatorySign">*</span></label>

                                            <select id="service_id"
                                                    class="form-control services @error('service_id') is-invalid @enderror"
                                                    name="service_id" autocomplete="service_id">
                                                <option value="">Select an option</option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{$category->id}}">{{ ucfirst($category->name)}}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('service_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="service_category_id"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Service') }}
                                                <span class="mandatorySign">*</span></label>

                                            <select id="service_category_id"
                                                    class="form-control service_category @error('service_category_id') is-invalid @enderror js-example-basic-multiple"
                                                    name="service_category_id[]" autocomplete="service_category_id"
                                                    multiple="multiple">

                                            </select>

                                            @error('service_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
{{--                                            <div id="log"></div>--}}
                                        </div>


                                    </div>
                                    <div class="form-group" id="sub_categories_checkbox">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 disabledDiv">
                                            <label for="net_price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Net Price') }}</label>
                                            <input id="net_price" type="number"
                                                   class="form-control @error('net_price') is-invalid @enderror"
                                                   name="net_price" value="0"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   autocomplete="net_price" autofocus>

                                            @error('net_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="price"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Price') }} <span
                                                    class="mandatorySign">*</span></label>
                                            <input id="price" type="text"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price" value="{{ old('price') }}"
                                                   min="0" onkeypress="return event.charCode >= 48"
                                                   autocomplete="price" autofocus>

                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label for="image"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Image') }}</label>
                                            <input value="{{old('image')}}" type="file"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   onchange="readURL(this)"
                                                   name="image" style="padding: 9px; cursor: pointer">
                                            <img width="300" height="200" class="img-thumbnail" style="display:none;"
                                                 id="img" src="#"
                                                 alt="your image"/>

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="is_available"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                                            <select id="is_available"
                                                    class="form-control @error('is_available') is-invalid @enderror"
                                                    name="is_available" autocomplete="is_available">
                                                <option value="0">Non-Active</option>
                                                <option value="1" selected>Active</option>
                                            </select>

                                            @error('is_available')
                                            <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="meta_title"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Title') }} </label>

                                            <input id="meta_title" type="text"
                                                   class="form-control @error('meta_title') is-invalid @enderror"
                                                   name="meta_title"
                                                   value="{{ old('meta_title') }}" autocomplete="meta_title">

                                            @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="meta_keywords"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Keywords') }}</label>

                                            <input id="meta_keywords" type="text"
                                                   class="form-control @error('meta_keywords') is-invalid @enderror"
                                                   name="meta_keywords"
                                                   value="{{ old('meta_keywords') }}" autocomplete="meta_keywords">

                                            @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="meta_description"
                                                   class="col-md-4 col-form-label text-md-left">{{ __('Meta Description') }}</label>

                                            <textarea id="meta_description"
                                                      class="form-control @error('meta_description') is-invalid @enderror"
                                                      name="meta_description"
                                                      value="{{ old('meta_description') }}"
                                                      autocomplete="meta_description"></textarea>

                                            @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit text-md-right">
                                <div class="m-form__actions m-form__actions">
                                    <a href="{{ route('admin.packages.index') }}" class="btn btn-info">Back</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('.js-example-basic-multiple').select2();
    </script>
    <script>

        $('.services').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '.service_category';
            var service_id = $(this).val();
            var request = "service_id=" + service_id;

            if (service_id !== '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.serviceCategory') }}",
                    data: request,
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            $.each(response.data.service_category, function (i, obj) {
                                html += '<option value="' + obj.id + '" id="selectedCategory' + obj.id + '">' + obj.name + '</option>';
                            });
                            $(node_to_modify).html(html);
                            $(node_to_modify).prepend("<option value='' disabled>Select Service</option>");
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {
                $(node_to_modify).html("<option value=''disabled>Select Service</option>");
            }
        });

        var $topo = $('#service_category_id');

        var valArray = ($topo.val()) ? $topo.val() : [];

        $topo.change(function () {
            var val = $(this).val(),
                numVals = (val) ? val.length : 0,
                changes;
            if (numVals != valArray.length) {
                var longerSet, shortSet;
                (numVals > valArray.length) ? longerSet = val : longerSet = valArray;
                (numVals > valArray.length) ? shortSet = valArray : shortSet = val;
                //create array of values that changed - either added or removed
                changes = $.grep(longerSet, function (n) {
                    return $.inArray(n, shortSet) == -1;
                });

                logChanges(changes, (numVals > valArray.length) ? 'selected' : 'removed');

            } else {
                // if change event occurs and previous array length same as new value array : items are removed and added at same time
                logChanges(valArray, 'removed');
                logChanges(val, 'selected');
            }
            valArray = (val) ? val : [];
        });
        var newValue = '';
        var oldUnselectValue = ''

        function logChanges(array, type) {

            $.each(array, function (i, item) {

                $('#log').html(item + ' was ' + type + '<br>');
                if (type == 'removed') {
                    newValue = '';
                    oldUnselectValue = item;
                } else {
                    newValue = item;
                }

            });
        }

        var net_price_value = 0;
        var total_add_on_value = 0;
        var total_add_on_value_per_subcategory = 0;

        $('.service_category').change(function () {
            form = $(this).closest('form');
            node = $(this);
            node_to_modify = '#sub_categories_checkbox';

            var lastSelectedTitle = $('#selectedCategory' + newValue + '').text();
            var service_id = newValue;
            if (service_id !== '') {
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax.packageServiceSubCategory') }}",
                    data: {'service_id': newValue, "_token": "{{ csrf_token() }}",},
                    dataType: "json",
                    cache: true,
                    success: function (response) {
                        if (response.status == "success") {
                            var html = "";
                            html += '<div class="">';
                            html += '<input type="hidden" value="0" name="total_service_value' + newValue + '" id="total_service_value' + newValue + '">';
                            html += '<div class="mb-4 accordion md-accordion" id="accordionEx' + newValue + '" role="tablist" aria-multiselectable="true">';

                            html += '<div class="card">';
                            html += '<div class="card-header" role="tab" id="headingOne' + newValue + '">';
                            html += '<a data-toggle="collapse" data-parent="#accordionEx' + newValue + '" href="#collapseOne' + newValue + '" aria-expanded="true"aria-controls="collapseOne' + newValue + '">';
                            html += '<div class="form-group row" style="margin-bottom: 0;"><div class="col-md-6 text-left"><h5 class="mb-0" style="color: #000;">' + lastSelectedTitle + ' </h5></div>';

                            html += '<div class="col-md-6 text-right" style="color: #fff;"> <span>Rs: </span><span id="total_service_value_menu' + newValue + '">0</span> &nbsp;<i class="fas fa-angle-down rotate-icon" style="float: right;"></i></div><div class="clearfix"></div>';
                            html += '</div>'
                            html += '</a>';
                            html += '</div>'

                            html += '<div id="collapseOne' + newValue + '" class="collapse show" role="tabpanel"aria-labelledby="headingOne' + newValue + '" data-parent="#accordionEx">';
                            html += '<div class="card-body">'

                            if (response.data.service_category.length > 0) {
                                html += '<div class="col-md-7 float-left text-right"><span><b>Rs:</b> </span></div>';
                                html += '<div class="clearfix"></div>';

                                $.each(response.data.service_category, function (i, obj) {
                                    html += '<div class="col-md-12 menuItemsCssClass menu-items' + obj.id + '">';
                                    html += '<div class="col-md-5 float-left"><input type="checkbox" id="service_sub_category_id' + obj.id + '" class="form-control services service_sub_category" name="service_sub_category_id[' + newValue + '][]" onchange="subCategoryAddon(' + obj.id + ' ,' + newValue + ',' + obj.price + ')" autocomplete="service_sub_category_id" value="' + obj.id + '"><span id="service_sub_category_item_name' + obj.id + '">' + obj.name + '</span></div>';
                                    html += '<div class="col-md-2 float-left text-right"><span id="menu-items-price' + newValue + '">' + obj.price + '</span></div>';
                                    html += '<div id="hidden_menu_items' + obj.id + '"></div>'

                                    html += '<div class="clearfix"></div>';
                                    html += '<div><input type="hidden" id="total_value__per_subcatgory_addons' + obj.id + '" value="0"></div>';
                                    html += '</div> <hr>';
                                });
                                html += '<div><input type="hidden" id="total_value_addons' + newValue + '" value="0"></div>';


                            }

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            $(node_to_modify).append(html);
                        }
                    },
                    error: function () {
                        toastr['error']("Something Went Wrong.");
                    }
                });
            } else {

                var netPrice = parseInt($('#net_price').val());
                var total_service_value = parseInt($('#total_service_value' + oldUnselectValue + '').val());
                netPrice = netPrice - total_service_value;
                $('#net_price').val(netPrice);
                $('#total_service_value' + oldUnselectValue + '').val(0);
                $('#total_service_value_menu' + oldUnselectValue + '').text(0);
                $('#accordionEx' + oldUnselectValue + '').remove();

            }
        });

        function subCategoryAddon(id, value, price) {
            var item_name = $('#service_sub_category_item_name' + id + '').text();


            checkedSubCategory = '#service_sub_category_id' + id + '';
            var service_id = id;
            var request = "service_id=" + service_id;
            if ($(checkedSubCategory).is(':checked')) {

                var hiddenHtml = '';

                hiddenHtml += '<input type="hidden" name="service_sub_category_name[' + value + '][' + id + ']" value="' + item_name + '" id="service_sub_category_name[' + value + '][' + id + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_price[' + value + '][' + id + ']" value="' + price + '" id="service_sub_category_price[' + value + '][' + id + ']">';
                hiddenHtml += '<input type="hidden" value="' + (price) + '" id="total_menu_items_price' + value + '' + id + '">';


                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + value + '').val());

                netPrice = netPrice + (price);
                total_service_price = total_service_price + (price);
                $('#net_price').val(netPrice);

                $('#total_service_value' + value + '').val(total_service_price);
                $('#total_service_value_menu' + value + '').text(total_service_price);

                if (service_id !== '') {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('ajax.serviceSubCategoryAddon') }}",
                        data: request,
                        dataType: "json",
                        cache: true,
                        success: function (response) {
                            if (response.status == "success") {
                                var html = "";
                                if (response.data.service_sub_category_addon.length > 0) {
                                    html += '<div class="col-md-12 menuItemsCssClass2">';
                                    html += '<label for="service_sub_category_addon_id" id="remove_add_on' + id + '" class="col-md-4 col-form-label text-md-left"><strong>Add Ons</strong></label>';
                                    html += '<div class="col-md-12 menu-items-addons' + id + '">'
                                    $.each(response.data.service_sub_category_addon, function (i, obj) {
                                        html += '<div class="col-md-5 float-left"><input type="checkbox" id="service_sub_category_addon_id' + obj.id + '" onchange="subCategoryAddonPrice(' + obj.id + ' ,' + value + ',' + obj.price + ' ,' + id + ')" class="form-control services service_sub_category_addon" name="service_sub_category_addon_id[' + value + '][' + id + '][]" autocomplete="service_sub_category_addon_id" value="' + obj.id + '"><span id="service_sub_category_items_addon_name' + obj.id + '">' + obj.name + '</span></div>';
                                        html += '<div class="col-md-2 float-left text-right"><span id="menu-items-addon-price' + obj.id + '">' + obj.price + '</span></div>';
                                        html += '<div id="hidden_addons' + id + '"></div>'

                                        html += '<div class="clearfix"></div>';

                                    });
                                    html += '</div></div>'
                                    $('.menu-items' + id + '').append(html);

                                }
                                $('#hidden_menu_items' + id + '').append(hiddenHtml);
                            }
                        },
                        error: function () {
                            toastr['error']("Something Went Wrong.");
                        }
                    });
                } else {

                }
            } else {

                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + value + '').val());

                let total_menu_items_price = parseInt($('#total_menu_items_price' + value + id).val());
                netPrice = netPrice - total_menu_items_price;
                total_service_price = total_service_price - total_menu_items_price;

                $('#net_price').val(netPrice);
                $('#total_service_value' + value + '').val(total_service_price);
                $('#total_service_value_menu' + value + '').text(total_service_price);

                $('#hidden_menu_items' + id + '').empty();
                $('.menu-items-addons' + id + '').remove();
                $('#remove_add_on' + id + '').remove();

            }

        }

        function subCategoryAddonPrice(addOnId, divId, addOnPrice, subCategoryId) {
            var item_name = $('#service_sub_category_items_addon_name' + addOnId + '').text();

            checkedSubCategory = '#service_sub_category_addon_id' + addOnId + '';
            if ($(checkedSubCategory).is(':checked')) {

                var hiddenHtml = '';

                hiddenHtml += '<input type="hidden" name="service_sub_category_addons_name[' + divId + '][' + subCategoryId + '][' + addOnId + ']" value="' + item_name + '" id="service_sub_category_addons_name[' + divId + '][' + subCategoryId + '][' + addOnId + ']">';
                hiddenHtml += '<input type="hidden" name="service_sub_category_addons_price[' + divId + '][' + subCategoryId + '][' + addOnId + ']" value="' + addOnPrice + '" id="service_sub_category_addons_price[' + divId + '][' + subCategoryId + '][' + addOnId + ']">';

                $('#hidden_addons' + subCategoryId + '').append(hiddenHtml);


                total_add_on_value = parseInt($('#total_value_addons' + divId + '').val()) + addOnPrice;
                total_add_on_value_per_subcategory = parseInt($('#total_value__per_subcatgory_addons' + subCategoryId + '').val()) + addOnPrice;
                net_price_value = parseInt($('#net_price').val()) + addOnPrice;

                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + divId + '').val());


                netPrice = netPrice + (addOnPrice);
                total_service_price = total_service_price + (addOnPrice);

                $('#net_price').val(netPrice);
                $('#total_service_value' + divId + '').val(total_service_price);
                $('#total_service_value_menu' + divId + '').text(total_service_price);


                $('#total_value_addons' + divId + '').val(total_add_on_value);
                $('#total_value__per_subcatgory_addons' + subCategoryId + '').val(total_add_on_value_per_subcategory);

                let totalMenuItemsPrice = $('#total_menu_items_price' + divId + subCategoryId).val();
                let totalMenuItemsPriceUpdated = parseInt(totalMenuItemsPrice) + (addOnPrice);
                $('#total_menu_items_price' + divId + subCategoryId).val(totalMenuItemsPriceUpdated);

            } else {

                $('#hidden_addons' + subCategoryId + '').empty();
                total_add_on_value = parseInt($('#total_value_addons' + divId + '').val()) - addOnPrice;
                total_add_on_value_per_subcategory = parseInt($('#total_value__per_subcatgory_addons' + subCategoryId + '').val()) - addOnPrice;
                net_price_value = parseInt($('#net_price').val()) - addOnPrice;
                var netPrice = parseInt($('#net_price').val());
                var total_service_price = parseInt($('#total_service_value' + divId + '').val());
                netPrice = netPrice - (addOnPrice);
                total_service_price = total_service_price - (addOnPrice);

                $('#net_price').val(netPrice);
                $('#total_service_value' + divId + '').val(total_service_price);
                $('#total_service_value_menu' + divId + '').text(total_service_price);


                $('#total_value_addons' + divId + '').val(total_add_on_value);
                $('#total_value__per_subcatgory_addons' + subCategoryId + '').val(total_add_on_value_per_subcategory);

                let totalMenuItemsPrice = $('#total_menu_items_price' + divId + subCategoryId).val();
                let totalMenuItemsPriceUpdated = parseInt(totalMenuItemsPrice) - (addOnPrice);
                $('#total_menu_items_price' + divId + subCategoryId).val(totalMenuItemsPriceUpdated);
            }

        }
    </script>

@endpush

@push('js')
    <script>
        $('#name').focusout(function () {

            var name = $(this).val();
            name = name.replace(/\s+/g, '-').toLowerCase();

            $('#slug').val(name);
        })
    </script>
@endpush

