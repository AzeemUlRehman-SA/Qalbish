@extends('customer.main')
@section('title','Referrals')
@push('css')
    <style>
        .mb-20 {
            margin-bottom: 20px;
        }

        /*.btn-height {*/
            /*height: 40px;*/
        /*}*/
        @media screen and (max-width: 650px)
        {
            .responsiveTable
            {
                overflow-x: scroll;
            }

        }
        @media screen and (max-width: 450px)
        {
            .qr-copy
            {
                width: 100% !important;
            }
            .input-group-addon
            {
                width: 100% !important;
                margin-top: 10px;
            }
            .buttonMain
            {
                width: 100%;
            }
        }
    </style>
@endpush
@section('content')
    <div class="m-content">
        <!--Begin::Section-->
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Referrals
                        </h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <span>
                                    <span><strong>No of Referrals: {{ $referrals->count() }}</strong> </span>
                                </span>

                        </li>
                    </ul>
                </div>
            </div>

            <div class="m-portlet__body">

                <div class="col-md-12 col-lg-12 col-sm-12 mb-20">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="form-group qr-code-input m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control qr-copy"
                                           value="{{config('app.url')}}/register/{{auth()->user()->referral_code}}"
                                           id="copy-input-box">
                                    <span class="input-group-addon"><button type="button"
                                                                            class="btn buttonMain hvr-bounce-to-right btn-height  btn-copy"
                                                                            data-clipboard-action="copy"
                                                                            data-clipboard-target="#copy-input-box"><i
                                                class="fa fa-clone fa-fw"></i> copy referral link</button></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 mb-20">
                    <div class="panel panel-primary">
                        <div class="panel-body" style="margin-left: 400px;">
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="{{config('app.url')}}/register/{{auth()->user()->referral_code}}" data-a2a-title="Join me on Qalbish and get 15% off your first order!">
                                {{--<a class="a2a_dd" href="https://www.addtoany.com/share"></a>--}}
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_linkedin"></a>
                            </div>
                            <script>
                                var a2a_config = a2a_config || {};
                                a2a_config.onclick = 1;
                            </script>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->



                        </div>
                    </div>
                </div>

{{--              <div class="responsiveTable">--}}
{{--                  <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">--}}
{{--                      <thead>--}}
{{--                      <tr>--}}

{{--                          <th> Sr NO.</th>--}}
{{--                          <th> Name</th>--}}
{{--                          <th> Email</th>--}}
{{--                          <th> Phone Number</th>--}}
{{--                          <th> Status</th>--}}
{{--                      </tr>--}}
{{--                      </thead>--}}
{{--                      <tbody>--}}
{{--                      @if(!empty($referrals))--}}

{{--                          {{ dd($referrals) }}--}}
{{--                          @foreach($referrals as $key=>$referral)--}}
{{--                              <tr>--}}
{{--                                  <td>{{$loop->iteration}}</td>--}}
{{--                                  <td>{{$referral_user[$key]->fullName()}}</td>--}}
{{--                                  <td>{{$referral->referral_register_email}}</td>--}}
{{--                                  <td>{{$referral->referral_register_phone_no}}</td>--}}
{{--                                  <td>{{ucfirst($referral->status)}}</td>--}}
{{--                              </tr>--}}
{{--                          @endforeach--}}
{{--                      @endif--}}
{{--                      </tbody>--}}
{{--                  </table>--}}
{{--              </div>--}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        $(document).ready(function () {
            new Clipboard('.btn-copy');
        });
        // $("#m_table_1").dataTable();
    </script>
@endpush
